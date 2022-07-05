<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
  $idUser = $_SESSION['id_user'];
  include "../db/dbConnect.php";
  $query = "SELECT * FROM orders WHERE id_user = '$idUser' AND in_stock = '1' AND status_order = '5' ORDER BY data_order DESC";
  $result = mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
  if($result){
    $rows = mysqli_num_rows($result); //кол-во строк
    if ($rows>0) {
      for ($i = 0;$i < $rows; $i++){
        $row = mysqli_fetch_row($result);
        $queryAllOrders = "SELECT * FROM allorders WHERE id_order = $row[0]";
        $resultAllOrders = mysqli_query($dbLink, $queryAllOrders) or die("Ошибка".mysqli_error($dbLink));
        $rowsAllOrders = mysqli_num_rows($resultAllOrders); //кол-во строк


        /*ЕСЛИ В ЗАКАЗЕ БОЛЬШЕ ОДНОГО ТОВАРА*/
        if($rowsAllOrders>1){
          echo "
            <form method='post' class='mb-3'>
              <div class='dateAndDelete mb-3'>
                <p>Дата заказа: <span class='dataOrder'>$row[2]</span></p>
                <button type='button' class='delete' value='$row[0]' title='удалить заказ'><img src='img/icon/close.png' class='deleteOrder' alt='удалить'></button> 
              </div>
              <div class='row'>";
          for ($j = 0;$j < $rowsAllOrders; $j++){ 
            $rowAllOrders = mysqli_fetch_row($resultAllOrders);
            $queryBasket = "SELECT * FROM basket WHERE id_basket = $rowAllOrders[2]";
            $resultBasket = mysqli_query($dbLink, $queryBasket) or die("Ошибка".mysqli_error($dbLink));
            $rowAllBasket = mysqli_fetch_row($resultBasket);

            $queryProduct = "SELECT * FROM product WHERE id_product = $rowAllBasket[1]";
            $resultProduct = mysqli_query($dbLink, $queryProduct) or die("Ошибка БД2");
            $rowAllProduct = mysqli_fetch_row($resultProduct);
            $imgEncode = base64_encode($rowAllProduct[3]);
            echo "
                <div class='col-12 col-lg-6 orderRow'>
                  <img class='imgOrder' src='data:image/jpg;base64, $imgEncode' alt='$rowAllProduct[1]'>
                  <div class='descrOrder'>
                    <p>$rowAllProduct[1]</p>";
            /*если есть форма, начинка, украшение*/
            if($rowAllBasket[5]!=null && $rowAllBasket[6]!=null && $rowAllBasket[8]!=null){
              $queryFill = "SELECT * FROM filling WHERE id_filling = $rowAllBasket[6]";
              $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД2");
              $rowFill = mysqli_fetch_row($resultFill);

              $queryForm = "SELECT * FROM formcake WHERE id_formCake = $rowAllBasket[5]";
              $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД3");
              $rowForm = mysqli_fetch_row($resultForm);

              $queryDecor = "SELECT * FROM decoration WHERE id_decoration = $rowAllBasket[8]";  
              $resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД2");
              $rowDecor = mysqli_fetch_row($resultDecor);
            echo"  <p>Форма: $rowForm[1]</p>
                   <p>Начинка: $rowFill[1]</p>";
                  if ($rowAllBasket[3]<1) {
            echo   "<p>Вес: $rowAllBasket[3] г</p>";          
                  }
                  else{
            echo   "<p>Вес: $rowAllBasket[3] кг</p>";        
                  }
            echo   "<p>Количество: $rowAllBasket[4]</p>
                    <p>Украшение: $rowDecor[1]</p>";  
            /*если есть форма, начинка и НЕТ украшение*/ 
            }elseif($rowAllBasket[5]!=null && $rowAllBasket[6]!=null && $rowAllBasket[8]==null){
              $queryFill = "SELECT * FROM filling WHERE id_filling = $rowAllBasket[6]";
              $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД2");
              $rowFill = mysqli_fetch_row($resultFill);

              $queryForm = "SELECT * FROM formcake WHERE id_formCake = $rowAllBasket[5]";
              $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД3");
              $rowForm = mysqli_fetch_row($resultForm);
            echo"   <p>Форма: $rowForm[1]</p>
                    <p>Начинка: $rowFill[1]</p>";
                  if ($rowAllBasket[3]<1) {
            echo    "<p>Вес: $rowAllBasket[3] г</p>";          
                  }else{
            echo    "<p>Вес: $rowAllBasket[3] кг</p>";        
                  }
            echo    "<p>Количество: $rowAllBasket[4]</p>"; 
            /*если НЕТ формы, НЕТ начинки, а украшение ЕСТЬ*/ 
            }elseif($rowAllBasket[5]==null && $rowAllBasket[6]==null && $rowAllBasket[8]!=null){
              $queryDecor = "SELECT * FROM decoration WHERE id_decoration = $rowAllBasket[8]";  
              $resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД2");
              $rowDecor = mysqli_fetch_row($resultDecor);
            echo"   <p>Вес: $rowAllBasket[3] кг</p>
                    <p>Количество: $rowAllBasket[4]</p>
                    <p>Украшение: $rowDecor[1]</p>";  
            /*если НЕТ формы, НЕТ начинки, НЕТ украшения*/ 
            }elseif($rowAllBasket[5]==null && $rowAllBasket[6]==null && $rowAllBasket[8]==null){
                  if ($rowAllBasket[3]<1) {
            echo    "<p>Вес: $rowAllBasket[3] г</p>";          
                  }
                  else{
            echo    "<p>Вес: $rowAllBasket[3] кг</p>";        
                  }
            echo    "<p>Количество: $rowAllBasket[4]</p>"; 
            }
          echo"   <p>Цена: $rowAllBasket[7] р</p>
                  </div>
                </div>";
            
          }
          $queryUserName = "SELECT * FROM users WHERE id_user = $idUser";
          $resultUserName = mysqli_query($dbLink, $queryUserName) or die("Ошибка БД");
          $rowUserName = mysqli_fetch_row($resultUserName);
          echo "
                <div class='col-12 butMore'>
                  <button type='button' class='butMoreOrder' value='$row[0]'>Подробнее...</button>
                </div>
              </div>
              <div id='moreAboutOrder$row[0]' style='display:none;'>
                <hr>
                <div class='row'>
                  <div class='col-6 col-md-4 col-lg-2 mb-3 mb-lg-0'>
                    <p class='nameColumn'>Имя получателя</p>
                    <p class='nameRow'>$rowUserName[1]</p>
                  </div>
                  <div class='col-6 col-md-4 col-lg-2 mb-3 mb-lg-0'>
                    <p class='nameColumn'>Номер телефона</p>
                    <p class='nameRow'>$row[6]</p>
                  </div>
                  <div class='col-6 col-md-4 col-lg-2 mb-3 mb-lg-0'>
                    <p class='nameColumn'>Способ оплаты</p>
                    <p class='nameRow'>$row[7]</p>
                  </div>
                  <div class='col-6 col-md-4 col-lg-2 mb-3 mb-lg-0'>
                    <p class='nameColumn'>Адрес</p>
                    <p class='nameRow'>$row[4]</p>
                  </div>
                  <div class='col-6 col-md-4 col-lg-2 mb-3 mb-lg-0'>
                    <p class='nameColumn'>Дата и время</p>
                    <p class='nameRow'><span class='dataDelivery'>$row[3]<br>$row[10]</span></p>
                  </div>
                  <div class='col-6 col-md-4 col-lg-2 mb-2 mb-lg-0'>
                    <p class='nameColumn'>Статус заказа</p>
                    <p class='nameRow'><span class='statusOrder'>Заказ оплачен</span></p>
                      <input type='hidden' name='status' value='$row[8]'>
                  </div>
                </div>
                <hr>
              </div>";

        echo "
                <div class='butUpdate row mt-3'>
                  <p class='col'>Общая стоимость: $row[5] р</p>
                </div>
            </form>
            <hr>";
            
        /*ЕСЛИ В ЗАКАЗЕ ОДИН ТОВАР*/
        }else{
          for ($k = 0;$k < $rowsAllOrders; $k++){
            $rowAllOrders = mysqli_fetch_row($resultAllOrders);
            $queryBasket = "SELECT * FROM basket WHERE id_basket = '$rowAllOrders[2]'";
            $resultBasket = mysqli_query($dbLink, $queryBasket)  or die("Ошибка".mysqli_error($dbLink));
            $rowAllBasket = mysqli_fetch_row($resultBasket);

            $queryProduct = "SELECT * FROM product WHERE id_product = '$rowAllBasket[1]'";
            $resultProduct = mysqli_query($dbLink, $queryProduct) or die("Ошибка БД2");
            $rowAllProduct = mysqli_fetch_row($resultProduct);
            $imgEncode = base64_encode($rowAllProduct[3]);
            echo "
            <form method='post' class='mb-3'>
              <div class='dateAndDelete mb-3'>
                <p>Дата заказа: $row[2]</p>
                <button type='button' class='delete' value='$row[0]' title='удалить заказ'><img src='img/icon/close.png' class='deleteOrder' alt='удалить'></button> 
              </div>
              <div class='row'>
                <div class='orderRow col-12'>
                  <img class='imgOrder' src='data:image/jpg;base64, $imgEncode' alt='$rowAllProduct[1]'>
                  <div class='descrOrder'>
                    <p>$rowAllProduct[1]</p>";

              /*если есть форма, начинка, украшение*/
              if($rowAllBasket[5]!=null && $rowAllBasket[6]!=null && $rowAllBasket[8]!=null){
                $queryFill = "SELECT * FROM filling WHERE id_filling = $rowAllBasket[6]";
                $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД2");
                $rowFill = mysqli_fetch_row($resultFill);

                $queryForm = "SELECT * FROM formcake WHERE id_formCake = $rowAllBasket[5]";
                $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД3");
                $rowForm = mysqli_fetch_row($resultForm);

                $queryDecor = "SELECT * FROM decoration WHERE id_decoration = $rowAllBasket[8]";  
                $resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД2");
                $rowDecor = mysqli_fetch_row($resultDecor);
              echo" <p>Форма: $rowForm[1]</p>
                    <p>Начинка: $rowFill[1]</p>";
                    if ($rowAllBasket[3]<1) {
              echo "<p>Вес: $rowAllBasket[3] г</p>";          
                    }else{
              echo "<p>Вес: $rowAllBasket[3] кг</p>";        
                    }
              echo "<p>Количество: $rowAllBasket[4]</p>
                    <p>Украшение: $rowDecor[1]</p>";  
              /*если есть форма, начинка и НЕТ украшение*/ 
              }elseif($rowAllBasket[5]!=null && $rowAllBasket[6]!=null && $rowAllBasket[8]==null){
                $queryFill = "SELECT * FROM filling WHERE id_filling = $rowAllBasket[6]";
                $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД2");
                $rowFill = mysqli_fetch_row($resultFill);

                $queryForm = "SELECT * FROM formcake WHERE id_formCake = $rowAllBasket[5]";
                $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД3");
                $rowForm = mysqli_fetch_row($resultForm);
              echo" <p>Форма: $rowForm[1]</p>
                    <p>Начинка: $rowFill[1]</p>
                    <p>Вес: $rowAllBasket[3] кг</p>
                    <p>Количество: $rowAllBasket[4]</p>"; 
              /*если НЕТ формы, НЕТ начинки, а украшение ЕСТЬ*/ 
              }elseif($rowAllBasket[5]==null && $rowAllBasket[6]==null && $rowAllBasket[8]!=null){
                $queryDecor = "SELECT * FROM decoration WHERE id_decoration = $rowAllBasket[8]";  
                $resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД2");
                $rowDecor = mysqli_fetch_row($resultDecor);
              echo" <p>Вес: $rowAllBasket[3] кг</p>
                    <p>Количество: $rowAllBasket[4]</p>
                    <p>Украшение: $rowDecor[1]</p>";  
              /*если НЕТ формы, НЕТ начинки, НЕТ украшения*/ 
              }elseif($rowAllBasket[5]==null && $rowAllBasket[6]==null && $rowAllBasket[8]==null){
              echo" <p>Вес: $rowAllBasket[3] кг</p>
                    <p>Количество: $rowAllBasket[4]</p>"; 
              }


              $queryUserName = "SELECT * FROM users WHERE id_user = $idUser";
              $resultUserName = mysqli_query($dbLink, $queryUserName) or die("Ошибка БД");
              $rowUserName = mysqli_fetch_row($resultUserName);
              echo "<p>Цена: $rowAllBasket[7] р</p>
                  </div>
                </div>
                
                <div class='col-12 butMore'>
                  <button type='button' class='butMoreOrder' value='$row[0]'>Подробнее...</button>
                </div>
              </div>
              <div id='moreAboutOrder$row[0]' style='display:none;'>
                <hr>
                <div class='row'>
                  <div class='col-6 col-md-4 col-lg-2 mb-3 mb-lg-0'>
                    <p class='nameColumn'>Имя получателя</p>
                    <p class='nameRow'>$rowUserName[1]</p>
                  </div>
                  <div class='col-6 col-md-4 col-lg-2 mb-3 mb-lg-0'>
                    <p class='nameColumn'>Номер телефона</p>
                    <p class='nameRow'>$row[6]</p>
                  </div>
                  <div class='col-6 col-md-4 col-lg-2 mb-3 mb-lg-0'>
                    <p class='nameColumn'>Способ оплаты</p>
                    <p class='nameRow'>$row[7]</p>
                  </div>
                  <div class='col-6 col-md-4 col-lg-2 mb-3 mb-lg-0'>
                    <p class='nameColumn'>Адрес</p>
                    <p class='nameRow'>$row[4]</p>
                  </div>
                  <div class='col-6 col-md-4 col-lg-2 mb-3 mb-lg-0'>
                    <p class='nameColumn'>Дата и время</p>
                    <p class='nameRow'><span class='dataDelivery'>$row[3]<br>$row[10]</span></p>
                  </div>
                  <div class='col-6 col-md-4 col-lg-2 mb-3 mb-lg-0'>
                    <p class='nameColumn'>Статус заказа</p>
                    <p class='nameRow'><span class='statusOrder'>Заказ оплачен</span></p>
                      <input type='hidden' name='status' value='$row[8]'>
                  </div>
                </div>
                <hr>
              </div>"; 

          echo "
                <div class='butUpdate row mt-3'>
                  <p class='col'>Общая стоимость: $row[5] р</p>
                </div> 
                
            </form>
            <hr>";
          }
        }
          
      }      
    }else{
      echo "<div class='ordersNull'>Ваш список заказов пуст.<br>Вы можете перейти в <a href='catalog.php'>КАТАЛОГ</a> и выполнить оформление заказа.</div>";
    }    
  }

mysqli_close($dbLink);
?>
<script type="text/javascript">
$('.butMoreOrder').on('click',  function(){
  var id = this.value;
  var e = document.getElementById('moreAboutOrder'+id);
  if(e.style.display == 'block')
    e.style.display = 'none';
  else
    e.style.display = 'block';
});


/*УДАЛЕНИЕ ИЗ СПИСКА ЗАКАЗОВ*/
  $('.delete').on('click',  function(){
    var idOrder = this;
    $("#deleteOrder").modal('show');
    $('.deleteYes').on('click', function(){
      var request = new XMLHttpRequest();
        request.onreadystatechange = function(){
          if((request.readyState==4) && (request.status==200)){
            
            $('#deleteOrder').html(this.response);

          }
        }
        request.open('GET','pages/deleteOrder.php?id=' + idOrder.value, true);
        request.send();
    });
  });
</script>