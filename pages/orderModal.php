
<div class='modal-dialog modal-dialog-centered' role='document'>
  <div class='modal-content'>
    <div class='modal-header' >
      <button type='button' class='close' id="close1" data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>
    <form method='post' id='formOrder'>
      <div class='modal-body'>
        <p class="ourOrd">ВАШ ЗАКАЗ</p>
        <div class='row'>
          
            <?php
            include "../db/dbConnect.php";
            $id = $_POST['hiddenId'];
            $form = $_POST['form'];
            $filling = $_POST['filling'];
            $weight = $_POST['weight'];
            $col = $_POST['col'];
            $price = $_POST['summa'];

            $query = "SELECT * FROM product WHERE id_product = $id";
            $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
            if($result){
              $row = mysqli_fetch_row($result);
              if($row[5] == 1){
                /*если форма и начинка выбраны*/
                if ($form!=null && $filling!=null) {
                  $queryForm = "SELECT * FROM formcake WHERE id_formCake = $form";
                  $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД1");

                  $queryFill = "SELECT * FROM filling WHERE id_filling = $filling";
                  $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД2");

                  if($resultForm && $resultFill){
                    
                    $rowForm = mysqli_fetch_row($resultForm);
                    $rowFill = mysqli_fetch_row($resultFill);
                    $imgEncode = base64_encode($row[3]);
                    echo "
                    
                      <div class='col-6 col-md-4 mb-3 mb-sm-0 imgModalNextOrd'>
                        <img src='data:image/jpg;base64, $imgEncode' alt='$row[1]'>
                      </div>
                      <div class='col-6 col-md-3 deskrOrd'>
                        <p class='namePr'>$row[1]</p>
                        <p>Форма: $rowForm[1]</p>
                        <p>Начинка: $rowFill[1]</p>
                        <p>Вес: $weight кг.</p>
                        <p>Количество: $col шт.</p>
                        <p>Цена: $price р.</p>
                      </div>
                    
                    <input type='hidden' value='$row[1]' name='nameProduct'>
                    <input type='hidden' value='$rowForm[1]' name='formProduct'>
                    <input type='hidden' value='$rowFill[1]' name='fillProduct'>
                    <input type='hidden' value='$weight' name='weightProduct'>
                    <input type='hidden' value='$col' name='colProduct'>
                    <input type='hidden' value='$price' name='priceProduct'>";

                  }  
                /*если форма НЕ выбрана, а начинка выбрана*/
                }elseif($form==null && $filling!=null){
                  $queryFill = "SELECT * FROM filling WHERE id_filling = $filling";
                  $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД2");

                  $queryFormId = "SELECT id_form FROM product WHERE id_product = $id";
                  $resultFormId = mysqli_query($dbLink, $queryFormId) or die("Ошибка БД2");

                  if($resultFill && $resultFormId){
                    
                    $rowFill = mysqli_fetch_row($resultFill);
                    $rowFormId = mysqli_fetch_row($resultFormId);
                    $queryFormName = "SELECT form FROM formcake WHERE id_formCake = $rowFormId[0]";
                    $resultFormName = mysqli_query($dbLink, $queryFormName) or die("Ошибка БД2");
                    if($resultFormName){
                      $rowFormName = mysqli_fetch_row($resultFormName);
                      $imgEncode = base64_encode($row[3]);
                      echo "
                      
                        <div class='col-6 col-md-4 mb-3 mb-sm-0 imgModalNextOrd'>
                          <img src='data:image/jpg;base64, $imgEncode' alt='$row[1]'>
                        </div>
                        <div class='col-6 col-md-3 deskrOrd'>
                          <p class='namePr'>$row[1]</p>
                          <p>Форма: $rowFormName[0]</p>
                          <p>Начинка: $rowFill[1]</p>
                          <p>Вес: $weight кг.</p>
                          <p>Количество: $col шт.</p>
                          <p>Цена: $price р.</p>
                        </div>
                      
                      <input type='hidden' value='$row[1]' name='nameProduct'>
                      <input type='hidden' value='$rowFormName[0]' name='formProduct'>
                      <input type='hidden' value='$rowFill[1]' name='fillProduct'>
                      <input type='hidden' value='$weight' name='weightProduct'>
                      <input type='hidden' value='$col' name='colProduct'>
                      <input type='hidden' value='$price' name='priceProduct'>";
                    }
                  }
                    /*если форма выбрана, а начинка НЕТ*/
                }elseif($form!=null && $filling==null){
                  $queryForm = "SELECT * FROM formcake WHERE id_formCake = $form";
                  $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД1");

                  $queryFillId = "SELECT id_filling FROM product WHERE id_product = $id";
                  $resultFillId = mysqli_query($dbLink, $queryFillId) or die("Ошибка БД2");

                  if($resultFillId && $resultForm){
                    
                    $rowFillId = mysqli_fetch_row($resultFillId);
                    $rowForm = mysqli_fetch_row($resultForm);
                    $queryFillName = "SELECT * FROM filling WHERE id_filling = $rowFillId[0]";
                    $resultFillName = mysqli_query($dbLink, $queryFillName) or die("Ошибка БД2");
                    if($resultFillName){
                      $rowFillName = mysqli_fetch_row($resultFillName);
                      $imgEncode = base64_encode($row[3]);
                      echo "
                      
                        <div class='col-6 col-md-4 mb-3 mb-sm-0 imgModalNextOrd'>
                          <img src='data:image/jpg;base64, $imgEncode' alt='$row[1]'>
                        </div>
                        <div class='col-6 col-md-3 deskrOrd'>
                          <p class='namePr'>$row[1]</p>
                          <p>Форма: $rowForm[1]</p>
                          <p>Начинка: $rowFillName[1]</p>
                          <p>Вес: $weight кг.</p>
                          <p>Количество: $col шт.</p>
                          <p>Цена: $price р.</p>
                        </div>
                      
                      <input type='hidden' value='$row[1]' name='nameProduct'>
                      <input type='hidden' value='$rowForm[1]' name='formProduct'>
                      <input type='hidden' value='$rowFillName[1]' name='fillProduct'>
                      <input type='hidden' value='$weight' name='weightProduct'>
                      <input type='hidden' value='$col' name='colProduct'>
                      <input type='hidden' value='$price' name='priceProduct'>";
                    }
                  }
                   /*усли форма НЕ выбрана и начинка НЕ выбрана*/ 
                }elseif($form==null && $filling==null){
                  $queryFormFill = "SELECT * FROM product WHERE id_product = $id";
                  $resultFormFill = mysqli_query($dbLink, $queryFormFill) or die("Ошибка БД2");

                  if($resultFormFill){
                    
                    $rowFormFill = mysqli_fetch_row($resultFormFill);
                    
                    $queryFillName = "SELECT * FROM filling WHERE id_filling = $rowFormFill[7]";
                    $resultFillName = mysqli_query($dbLink, $queryFillName) or die("Ошибка БД2");
                    $queryFormName = "SELECT form FROM formcake WHERE id_formCake = $rowFormFill[6]";
                    $resultFormName = mysqli_query($dbLink, $queryFormName) or die("Ошибка БД2");

                    if($resultFillName && $resultFormName){
                      $rowFillName = mysqli_fetch_row($resultFillName);
                      $rowFormName = mysqli_fetch_row($resultFormName);
                      $imgEncode = base64_encode($row[3]);
                      echo "
                      
                        <div class='col-6 col-md-4 mb-3 mb-sm-0 imgModalNextOrd'>
                          <img src='data:image/jpg;base64, $imgEncode' alt='$row[1]'>
                        </div>
                        <div class='col-6 col-md-3 deskrOrd'>
                          <p class='namePr'>$row[1]</p>
                          <p>Форма: $rowFormName[0]</p>
                          <p>Начинка: $rowFillName[1]</p>
                          <p>Вес: $weight кг.</p>
                          <p>Количество: $col шт.</p>
                          <p>Цена: $price р.</p>
                        </div>
                      
                      <input type='hidden' value='$row[1]' name='nameProduct'>
                      <input type='hidden' value='$rowFormName[0]' name='formProduct'>
                      <input type='hidden' value='$rowFillName[1]' name='fillProduct'>
                      <input type='hidden' value='$weight' name='weightProduct'>
                      <input type='hidden' value='$col' name='colProduct'>
                      <input type='hidden' value='$price' name='priceProduct'>";
                    }
                  }
                    
                } 
                /*ЕСЛИ ЭТО НЕ ТОРТЫ*/ 
              }else{
                $imgEncode = base64_encode($row[3]);
                echo "
                
                  <div class='col-6 col-md-4 mb-3 mb-sm-0 imgModalNextOrd'>
                    <img src='data:image/jpg;base64, $imgEncode' alt='$row[1]'>
                  </div>
                    <div class='col-6 col-md-3 deskrOrd'>
                      <p class='namePr'>$row[1]</p>
                      <p>Вес: $row[8] г. / шт.</p>
                      <p>Количество: $col шт.</p>
                      <p>Цена: $price р.</p>
                    </div>
                
                <input type='hidden' value='$row[1]' name='nameProduct'>
                <input type='hidden' value='$row[8]' name='weightProduct'>
                <input type='hidden' value='$col' name='colProduct'>
                <input type='hidden' value='$price' name='priceProduct'>";
              }
                
            }
            
mysqli_close($dbLink);  
            ?>
          
          <div class='col-12 col-md-5 mt-3 mt-md-0'>
            <div class="ordUser">
              <p>Информация о получателе</p>
              <input type='text' class="inp form-control" name='nameUser' placeholder='Имя получателя'>
              <input type='text' class="inp form-control" name='phoneUser' placeholder='Номер телефона'>
              <input type='text' class="inp form-control" name='address' placeholder='улица, дом, квартира'>
            </div>
          </div>
        </div>
        <div class="row mt-3 mb-1">
          <div class="col-md-6 ordUser">
            <p >Дата доставки</p>
            <p style="margin-bottom: 0px;">Выберите дату доставки:</p>
            <input type="date" id='datefield' class="inp form-control" name="deliveryData" min='2022-04-04'>
            <input type="hidden" id='datefieldHidden' name="orderData">

            <p for="inputState" style="margin-bottom: 0px;">Выберите время доставки:</p>
            <select id="inputState" class="inp form-control" name="timeOrder">
              <option value="none"></option>
              <option>9.00-12.00</option>
              <option>12.00-15.00</option>
              <option>15.00-18.00</option>
              <option>18.00-20.00</option>
            </select>
          </div>
          <div class="col-md-6 ordUser">
            <p >Способ оплаты</p>
            <div class='form-check money'>
              <input class='form-check-input customCheck' type='radio' name='money' id='card' value='Картой'>
              <label class='form-check-label' for='card'>
               Картой при получении
              </label>
            </div>
            <div class='form-check money'>
              <input class='form-check-input customCheck' type='radio' name='money' id='money' value='Наличными'>
              <label class='form-check-label' for='money'>
                Наличными при получении
              </label>
            </div>
          </div>
        </div>
        <span class="error"></span>
      </div>
                  
      <div class='modal-footer mx-auto' >
        <button type='button' class='btn butOrderN' data-dismiss='modal'>ОФОРМИТЬ ЗАКАЗ</button>
      </div>
    </form>
  </div>
</div>


<script type="text/javascript">
  $('.close').on('click', function(){
    location.reload();
  });
$('#close1').on('click', function(){
  $("#nextOrderModal").modal('hide');
});


$('.butOrderN').on('click',  function(){

  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth() + 1; //January is 0!
  var yyyy = today.getFullYear();

  if (dd < 10) {
     dd = '0' + dd;
  }
  if (mm < 10) {
     mm = '0' + mm;
  } 
      
  today = yyyy + '-' + mm + '-' + dd;
  document.getElementById("datefieldHidden").setAttribute("value", today);
  
  sendAjaxForm('formOrder', 'pages/orderProductUnauthorized.php');
  return false;     
});
 
function sendAjaxForm(ajax_form, url) {
  $.ajax({
    url:     url, //url страницы (action_ajax_form.php)
    type:     "POST", //метод отправки
    dataType: "html", //формат данных
    data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
    success: function(msg) { //Данные отправлены успешно
      var result = jQuery.parseJSON(msg);
        if (result.error == '') {
          $("#orderModal").modal('hide');
          $("#modalOk").modal('show');
          $('.error').css('display', 'none');
        } else {
          $('.error').css('display', 'block');
          $('.error').html(result.error);
        }
    },
    error: function(response) { // Данные не отправлены
      alert("данные не отправлены");
    }
  });
}

/*--- КАЛЕНДАРЬ С ВЫБОРОМ ДАТЫ ЗАКАЗА -----*/
var today = new Date();
  var month = new Date();
  var dd = today.getDate() + 3;
  var mm = today.getMonth() + 1; //January is 0!
  var yyyy = today.getFullYear();
  var mmM = today.getMonth() + 2; //January is 0!

  if (dd < 10) {
    dd = '0' + dd;
  }
  if (mm < 10 && mmM < 10) {
    mm = '0' + mm;
    mmM = '0' + mmM;
  } 
      
  today = yyyy + '-' + mm + '-' + dd;
  month = yyyy + '-' + mmM + '-' + dd;
  document.getElementById("datefield").setAttribute("min", today);
  document.getElementById("datefield").setAttribute("max", month);
/*-----------       -------------*/
</script>

