<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Оформление заказа</title>

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">


    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/styleOrdering.css">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Oswald:wght@300&display=swap" rel="stylesheet">

    <!-- Include Bootstrap Datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
    

    <!-- ICONS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  </head>
<body>
<?php
  include("pages/head-footer/header.php");
?>
<div class="container">
  <div class="dispFlex">
    <a class="backBasket mr-3" href='basket.php' title="назад">
      <img src="img/icon/back.svg">
    </a>
    <p class='headingPage'>ВАШ ЗАКАЗ</p>    
  </div>

  <div class='product'>
    <div class='row'>
    <?php

    $selectId = $_POST['select'];
    $orderId = $_POST['orderClick'];
    $N = 1;
    include "db/dbConnect.php";
    if($selectId!=null){
      $N = count($selectId);
      for($i=0; $i < $N; $i++){
        $query = "SELECT * FROM basket WHERE id_basket = $selectId[$i]";
        $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
        if($result){
          $row = mysqli_fetch_row($result);
          $queryProd = "SELECT * FROM product WHERE id_product = $row[1]";
          $resultProd = mysqli_query($dbLink, $queryProd) or die("Ошибка БД1".mysqli_error($dbLink));
          $rowProd = mysqli_fetch_row($resultProd);
          $imgEncode = base64_encode($rowProd[3]);
          echo "
          <div class='col-lg-6 imgAndDescr row'>
            <p class='nameProd2'>$rowProd[1]</p>
            <div class='col-sm-6 mb-3 mb-sm-0 photoOrder'>
              <img src='data:image/jpg;base64, $imgEncode' alt='$rowProd[1]'>
            </div>
            <div class='nameAndDescr col-sm-6'>
              <p>$rowProd[1]</p>";
              /*если есть форма, начинка, украшение*/
              if($row[5]!=null && $row[6]!=null && $row[8]!=null){
                $queryFill = "SELECT * FROM filling WHERE id_filling = $row[6]";
                $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД2");
                $rowFill = mysqli_fetch_row($resultFill);

                $queryForm = "SELECT * FROM formcake WHERE id_formCake = $row[5]";
                $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД3");
                $rowForm = mysqli_fetch_row($resultForm);

                $queryDecor = "SELECT * FROM decoration WHERE id_decoration = $row[8]";  
                $resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД2");
                $rowDecor = mysqli_fetch_row($resultDecor);
                echo"    
                <p>Форма: $rowForm[1]</p>
                <p>Начинка: $rowFill[1]</p>
                <p>Вес: $row[3] кг</p>
                <p>Количество: $row[4]</p>
                <p>Украшение: $rowDecor[1]</p>";
              /*если есть форма, начинка и НЕТ украшение*/ 
              }elseif($row[5]!=null && $row[6]!=null && $row[8]==null){
                $queryFill = "SELECT * FROM filling WHERE id_filling = $row[6]";
                $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД2");
                $rowFill = mysqli_fetch_row($resultFill);

                $queryForm = "SELECT * FROM formcake WHERE id_formCake = $row[5]";
                $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД3");
                $rowForm = mysqli_fetch_row($resultForm);
                echo"    
                <p>Форма: $rowForm[1]</p>
                <p>Начинка: $rowFill[1]</p>
                <p>Вес: $row[3] кг</p>
                <p>Количество: $row[4]</p>";
              /*если НЕТ формы, НЕТ начинки, а украшение ЕСТЬ*/ 
              }elseif($row[5]==null && $row[6]==null && $row[8]!=null){
                $queryDecor = "SELECT * FROM decoration WHERE id_decoration = $row[8]";  
                $resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД2");
                $rowDecor = mysqli_fetch_row($resultDecor);
                if ($row[3]<1) {
          echo "<p>Вес: $row[3] г</p>"; 
                }else{
          echo "<p>Вес: $row[3] кг</p>";    
                }
                echo"
                <p>Количество: $row[4]</p>
                <p>Украшение: $rowDecor[1]</p>";
              /*если НЕТ формы, НЕТ начинки, НЕТ украшения*/ 
              }elseif($row[5]==null && $row[6]==null && $row[8]==null){
                if ($row[3]<1) {
          echo "<p>Вес: $row[3] г</p>"; 
                }else{
          echo "<p>Вес: $row[3] кг</p>";    
                }
                echo"
                <p>Количество: $row[4]</p>";
              }
              echo"
              <p>Цена: $row[7]р</p>
            </div>
          </div>";
          
        }
      }
    }else{
      $query = "SELECT * FROM basket WHERE id_basket = $orderId";
      $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
      if($result){
        $row = mysqli_fetch_row($result);
        $queryProd = "SELECT * FROM product WHERE id_product = $row[1]";
        $resultProd = mysqli_query($dbLink, $queryProd) or die("Ошибка БД1".mysqli_error($dbLink));
        $rowProd = mysqli_fetch_row($resultProd);
        $imgEncode = base64_encode($rowProd[3]);
        echo "
        <div class='col-lg-6 imgAndDescr row'>
          <p class='nameProd2'>$rowProd[1]</p>
          <div class='col-sm-6 mb-3 mb-sm-0 photoOrder'>
            <img src='data:image/jpg;base64, $imgEncode' alt='$rowProd[1]'>
          </div>
          <div class='nameAndDescr col-sm-6'>
            <p>$rowProd[1]</p>";
            /*если есть форма, начинка, украшение*/
            if($row[5]!=null && $row[6]!=null && $row[8]!=null){
              $queryFill = "SELECT * FROM filling WHERE id_filling = $row[6]";
              $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД2");
              $rowFill = mysqli_fetch_row($resultFill);

              $queryForm = "SELECT * FROM formcake WHERE id_formCake = $row[5]";
              $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД3");
              $rowForm = mysqli_fetch_row($resultForm);

              $queryDecor = "SELECT * FROM decoration WHERE id_decoration = $row[8]";  
              $resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД2");
              $rowDecor = mysqli_fetch_row($resultDecor);
              echo"    
              <p>Форма: $rowForm[1]</p>
              <p>Начинка: $rowFill[1]</p>
              <p>Вес: $row[3] кг</p>
              <p>Количество: $row[4]</p>
              <p>Украшение: $rowDecor[1]</p>";
            /*если есть форма, начинка и НЕТ украшение*/ 
            }elseif($row[5]!=null && $row[6]!=null && $row[8]==null){
              $queryFill = "SELECT * FROM filling WHERE id_filling = $row[6]";
              $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД2");
              $rowFill = mysqli_fetch_row($resultFill);

              $queryForm = "SELECT * FROM formcake WHERE id_formCake = $row[5]";
              $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД3");
              $rowForm = mysqli_fetch_row($resultForm);
              echo"    
              <p>Форма: $rowForm[1]</p>
              <p>Начинка: $rowFill[1]</p>
              <p>Вес: $row[3] кг</p>
              <p>Количество: $row[4]</p>";
            /*если НЕТ формы, НЕТ начинки, а украшение ЕСТЬ*/ 
            }elseif($row[5]==null && $row[6]==null && $row[8]!=null){
              $queryDecor = "SELECT * FROM decoration WHERE id_decoration = $row[8]";  
              $resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД2");
              $rowDecor = mysqli_fetch_row($resultDecor);
              if ($row[3]<1) {
        echo "<p>Вес: $row[3] г</p>"; 
                }else{
        echo "<p>Вес: $row[3] кг</p>";    
                }
              echo"
              <p>Количество: $row[4]</p>
              <p>Украшение: $rowDecor[1]</p>";
            /*если НЕТ формы, НЕТ начинки, НЕТ украшения*/ 
            }elseif($row[5]==null && $row[6]==null && $row[8]==null){
              if ($row[3]<1) {
        echo "<p>Вес: $row[3] г</p>"; 
                }else{
        echo "<p>Вес: $row[3] кг</p>";    
                }
              echo"
              <p>Количество: $row[4]</p>";
            }
            echo"
            <p>Цена: $row[7]р</p>
          </div>
        </div>";
        
      }      
    }

    mysqli_close($dbLink);  
    ?>
    </div>
  </div>

</div>
<div class='container'>
  <form method='post' class='formOrder'>
    <div class='row info'>
      <div class='col-sm-6 col-md-4 col-lg-3 method'>
        <p class='headingForm'>СПОСОБ ОПЛАТЫ</p>
        <div class='form-check form-checkCheck'>
          <input class='form-check-input customCheck' type='radio' name='payment' id='payment1' value='Наличными'>
          <label class='form-check-label' for='payment1'>Наличными при получении</label>
        </div>
        <div class='form-check form-checkCheck'>
          <input class='form-check-input customCheck' type='radio' name='payment' id='payment2' value='Картой'>
          <label class='form-check-label' for='payment2'>Картой при получении</label>
        </div>
        <hr>
        <p class='headingForm'>БОНУСЫ</p>
        <?php
        $idUser = $_SESSION['id_user'];
        include "db/dbConnect.php";
        $query = "SELECT * FROM users WHERE id_user = $idUser";
        $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
        if($result){
          $row = mysqli_fetch_row($result);
          echo"
            <p>На вашем счету <span>$row[5]</span> бонусов</p>
            <div class='form-check form-checkCheck'>
              <input class='form-check-input customCheck' type='checkbox' name='bonus' id='bonus' value='$row[5]'>
              <label class='form-check-label mb-3' for='bonus'>Использовать бонусы</label>
            </div>
            <div class='useBonusDisplNone' style='display:none;'>
              <p>Введите количество бонусов, которые хотите использовать: </p>
              <input type='number' min='0' class='form-control colBonuses' name='colBonus' value=''>
            </div>";
        }
        mysqli_close($dbLink);
        ?>
      </div>
      
      <div class='mt-3 mt-sm-0 col-sm-6 col-md-4 formUser'>
        <p class='headingForm'>ИНФОРМАЦИЯ О ПОЛУЧАТЕЛЕ</p>
        <?php
        $idUser = $_SESSION['id_user'];
        include "db/dbConnect.php";
        $query = "SELECT * FROM users WHERE id_user = $idUser";
        $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
        if($result){
          $row = mysqli_fetch_row($result);
          echo"
            <input type='text' class='inp form-control' name='nameUser' readonly value='$row[1]'>
            <input type='text' class='inp form-control' name='phoneUser' placeholder='$row[4]'>
          ";
        }
        mysqli_close($dbLink);
        ?>
        <input type='text' class='inp form-control' name='address' placeholder='улица, дом, квартира'>
        <p style="margin-bottom: 0px;">Выберите дату доставки:</p>
        <input type='date' id='datefield' class='inp form-control' name='deliveryData' min='2022-04-04'>
        <input type="hidden" id='datefieldHidden' name='orderData'>

        <p for="inputState" style="margin-bottom: 0px;">Выберите время доставки:</p>
        <select id="inputState" class="form-control" name="timeOrder">
          <option value="none"></option>
          <option>9.00-12.00</option>
          <option>12.00-15.00</option>
          <option>15.00-18.00</option>
          <option>18.00-20.00</option>
        </select>
      </div>
      
      <div class='mt-3 mt-md-0 col-md-4 col-lg-3 ourOrder'>
        <div>  
          <p class='headingForm'>ВАШ ЗАКАЗ</p>
          <div class='ourOrderRow'>
            <p>Сумма заказа: </p>
            <?php
            include "db/dbConnect.php";
            $sumWithoutBonus = 0;
            if($selectId!=null){
              $N = count($selectId);
              for($i=0; $i < $N; $i++){
                $query = "SELECT * FROM basket WHERE id_basket = $selectId[$i]";
                $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
                $row = mysqli_fetch_row($result);
                $sumWithoutBonus += $row[7];
                
              }
              foreach($selectId as $val){
                echo "<input type='hidden' name='idBasket[]' value='$val'>";
              }
              
            }else{
              $query = "SELECT * FROM basket WHERE id_basket = $orderId";
              $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
              $row = mysqli_fetch_row($result);
              $sumWithoutBonus = $row[7];
              echo "<input type='hidden' name='idBasket[]' value='$orderId'>";
            }
            echo"

            <p><span class='sumWithOutBonus'>$sumWithoutBonus</span> р</p>
            </div>
            <div class='ourOrderRow'>
              <p>Бонусы: </p>
              <p class='useBonus'>0</p>
            </div>
          </div>
          <div>
            <div class='ourOrderRow'>
              <p>Итого к оплате:</p>
              <p><span class='sumWithBonus'>$sumWithoutBonus</span> р.</p>
              <input type='hidden' id='summa' name='sumWithBonus' value='$sumWithoutBonus'>
              <input type='hidden' id='writtenOffBonuses' name='writtenOffBonuses' value='0'>
            </div>";
          mysqli_close($dbLink);
          ?>
          <span class="error"></span>
          <div class='butOrder'>
            <button type='button' class='buttonOrder'>ОФОРМИТЬ ЗАКАЗ</button>
          </div>
        </div>
      </div>  
    </div>
    
  </form>
</div>

<!-- МОДАЛЬНОЕ ОКНО ПОСЛЕ ЗАКАЗА -->
  <div class='modal fade' id='orderProduct' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          <button type='button' class='close' onClick='inBasket();'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body mx-auto'>
          <p>Благодарим за заказ! В течение получаса с вами свяжется наш менеджер. Ожидайте подтверждения заказа.</p>
          <p>Вам начислено <span class="colAccruedBonus"></span> бонусов.</p>
        </div>
                          
        <div class='modal-footer mx-auto'>
          <button type='button' class='btn' onClick='inBasket();'>ЗАКРЫТЬ</button>
        </div>
                
      </div>
    </div>
  </div>

<!-- МОДАЛЬНОЕ ОКНО С ОШИБКОЙ О БОНУСАХ -->
  <div class='modal fade' id='noUseBonuses' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          <button type='button' class='close'  data-dismiss='modal'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body mx-auto'>
          <p>Чтобы использовать бонусы необходимо, чтобы сумма заказа была больше количества бонусов (1 бонус = 1 рубль) или сумма заказа была больше 20р</p>
        </div>
                          
        <div class='modal-footer mx-auto'>
          <button type='button' class='btn'  data-dismiss='modal'>ЗАКРЫТЬ</button>
        </div>
                
      </div>
    </div>
  </div>

<?php
  include("pages/head-footer/footer.php");
?>


<script type="text/javascript">


$('.formOrder input[name=bonus]').on('change', function() {
  var sumWithOutBonus = $('.sumWithOutBonus').html();
  var sumWithBonus = $('.sumWithBonus').html();
 /* var useBonus = $('.useBonus').html();*/
  var writtenOffBonuses = $('#writtenOffBonuses').val();
  if ( $(this).prop('checked') === true ) {
    $('.useBonusDisplNone').css('display','block');
    $('.formOrder input[name=colBonus]').on('change', function(){
      var useBonuses = $('.colBonuses').val();
      var bonusesInBd = $('input[name=bonus]:checked', '.formOrder').val();
      if (Number(useBonuses) > Number(bonusesInBd)) {
        $("#noUseBonuses").modal('show');
        $("#noUseBonuses p").html('На Вашем счету нет такого количества бонусов.');
        useBonuses = 0;
        $('.useBonus').html(useBonuses);
        $('.colBonuses').val('0');
        sumWithBonus = sumWithOutBonus - useBonuses;
        $('.sumWithBonus').html(sumWithBonus);
        $('#summa').val(sumWithBonus);
        $('#writtenOffBonuses').val(useBonuses);
      }else if (Number(useBonuses) < 0) {
        $("#noUseBonuses").modal('show');
        $("#noUseBonuses p").html('Количество бонусов должно быть больше 0.');
        useBonuses = 0;
        $('.useBonus').html(useBonuses);
        $('.colBonuses').val('0');
        sumWithBonus = sumWithOutBonus - useBonuses;
        $('.sumWithBonus').html(sumWithBonus);
        $('#summa').val(sumWithBonus);
        $('#writtenOffBonuses').val(useBonuses);
      }else if(Number(useBonuses)<Number(sumWithOutBonus) && Number(sumWithOutBonus)>20){
        $('.useBonus').html(useBonuses);
        sumWithBonus = sumWithOutBonus - useBonuses;
        $('.sumWithBonus').html(sumWithBonus);
        $('#summa').val(sumWithBonus);
        $('#writtenOffBonuses').val(useBonuses);
      }else{
        $("#noUseBonuses").modal('show');
        $("#noUseBonuses p").html('Чтобы использовать бонусы необходимо, чтобы сумма заказа была больше количества бонусов (1 бонус = 1 рубль) и сумма заказа была больше 20р.');
        useBonuses = 0;
        $('.useBonus').html(useBonuses);
        $('.colBonuses').val('0');
        sumWithBonus = sumWithOutBonus - useBonuses;
        $('.sumWithBonus').html(sumWithBonus);
        $('#summa').val(sumWithBonus);
        $('#writtenOffBonuses').val(useBonuses);
      }
    });


  }else{
    $('.useBonusDisplNone').css('display','none');
    useBonuses = 0;
    $('.colBonuses').val('0');
    $('.useBonus').html('0');
    sumWithBonus = sumWithOutBonus - useBonuses;
    $('.sumWithBonus').html(sumWithBonus);
    $('#summa').val(sumWithBonus);
    $('#writtenOffBonuses').val(useBonuses);
  }
});

/*----- ОФОРМЛЕНИЕ ЗАКАЗА -----*/
  $('.buttonOrder').on('click',  function(){
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
    sendAjaxOrder('formOrder','pages/orderProduct.php');
    return false;     
  });

  function sendAjaxOrder(ajax_form, url) {
    $.ajax({
      url:     url, //url страницы (action_ajax_form.php)
      type:     "POST", //метод отправки
      dataType: "html", //формат данных
      data: $("."+ajax_form).serialize(),
      success: function(msg) { //Данные отправлены успешно
        var result = jQuery.parseJSON(msg);
        if (result.error == '') {
            $("#orderProduct").modal('show');
            $('.colAccruedBonus').html(result.success);
            $('.error').css('display', 'none');
          } else {
          $('.error').css('display', 'block');
            $('.error').html(result.error);
          }
      },
      error: function(msg) { // Данные не отправлены
        alert("данные не отправлены");
      }
    });
  } 
function inBasket(){
  location.href='basket.php';
}

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
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- библиотека jquery -->
<script src="libs/jquery-3.6.0.min.js"></script>
<!-- подключить библиотеку Bootstrap (js файл) -->
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap-datepicker.js"></script>
  </body>
</html>
