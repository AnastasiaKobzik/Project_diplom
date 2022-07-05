<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bake Cake</title>

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">


    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/modalStyle.css">
    
    <link rel="stylesheet" type="text/css" href="css/pageProduct.css">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Oswald:wght@300&display=swap" rel="stylesheet">

    <!-- SLICK SLIDER -->
    <link rel="stylesheet" type="text/css" href="libs/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="libs/slick/slick-theme.css"/>

    <!-- ICONS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- OWN CAROUSEL -->
    <link rel="stylesheet" href="libs/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="libs/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">

  </head>
<body>
<?php
  include("pages/head-footer/header.php");
?>
<div class="container">
  <div class="dispFlex">
    <a class="backCatalog mr-3" href='catalog.php' title="В каталог">
      <img src="img/icon/back.svg">
    </a>
  <?php
  include "db/dbConnect.php";
  $id = $_POST['hiddenId'];
  $query = "SELECT * FROM product WHERE id_product = $id[0]";
  $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
  if($result){
    $row = mysqli_fetch_row($result);//извл-ся отд-ая строка
    echo "<p class='headingName'>КАТАЛОГ - $row[1]</p>";
  }
  mysqli_close($dbLink);  
  ?>
  </div>
  <div class="row rowPhotoDescr">
    <div class="col-sm-6 col-lg-5 col-xl-4 imgEnd row mb-3 mb-sm-0">
      <?php
        include "db/dbConnect.php";
        $id = $_POST['hiddenId'];
        $query = "SELECT * FROM product WHERE id_product = $id[0]";
        $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
        if($result){
          $row = mysqli_fetch_row($result);//извл-ся отд-ая строка
          $imgEncode = base64_encode($row[3]);
          echo "<img src='data:image/jpg;base64, $imgEncode' alt='$row[1]'>";
        }
        mysqli_close($dbLink);  
      ?>
    </div>
    <div class="col-sm-6">

      <div class="nameAndBut row">
        <div class="nameProd">
          <?php
            include "db/dbConnect.php";
            $id = $_POST['hiddenId'];
            $idUser = $_SESSION['id_user'];
            $query = "SELECT * FROM product WHERE id_product = $id[0]";
            $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
            if($result){
              $row = mysqli_fetch_row($result);//извл-ся отд-ая строка
              echo "$row[1]
        </div>
        <div class='butBaskLike'>
          <a type='button' class='inBasket' title='в корзину'><img src='img/icon/basket.png' alt='В корзину'></a>";
            }
            if ($idUser!=null) {
              $queryLike = "SELECT * FROM favorites WHERE id_product = $id[0] AND id_user = $idUser";
              $resultLike = mysqli_query($dbLink, $queryLike) or die("Ошибка БД");
              if($resultLike){
                $rowLike = mysqli_fetch_row($resultLike);//извл-ся отд-ая строка
                if($rowLike!= null){
                  echo "
          <button type='button' class='deleteLike' value='$id[0]' title='удалить из избранного'><img src='img/icon/likeRed.png' alt='Удалить из избранного'></button>
        </div>
      </div>";                
                }else{
                  echo "
          <button type='button' class='inLike' title='в избранное' value='$id[0]'><img src='img/icon/likeGrey.png' alt='В избранное'></button>
        </div>
      </div>";
                
                }
              }              
            }else{
              echo "
          <button type='button' class='inLike' title='в избранное' value='$id[0]'><img src='img/icon/likeGrey.png' alt='В избранное'></button>
        </div>
      </div>";
            }




          mysqli_close($dbLink);  
          ?> 

      <div class="descrFill">
        <button type="button" class="descrProd">Описание</button>
        <button type="button" class="fillProd">Начинки</button>
      </div>
      <div class="descrOrFill">
        <?php
            include "db/dbConnect.php";
            $id = $_POST['hiddenId'];
            $query = "SELECT * FROM product WHERE id_product = $id[0]";
            $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
            if($result){
            $row = mysqli_fetch_row($result);//извл-ся отд-ая строка
            if($row[5] != 1){
              echo "
              <p>$row[2]</p>
              <p>Цена: <span id='price'>$row[4]</span> р.</p>
              <p>Вес: $row[8] г. / шт.</p>";
            }else{
              
                
                $query2 = "SELECT * FROM filling WHERE id_filling = $row[7]";//достаем описание начинки
                $result2 = mysqli_query($dbLink, $query2) or die("Ошибка БД2");

                $query3 = "SELECT * FROM formcake WHERE id_formCake = $row[6]";//достаем описание форы
                $result3 = mysqli_query($dbLink, $query3) or die("Ошибка БД3".mysqli_error($dbLink));
                if($result2 && $result3){
                  $row2 = mysqli_fetch_row($result2);
                  $row3 = mysqli_fetch_row($result3);
                  echo "
                  <input type='hidden' name='idFill' value='$row[7]' id='idFill'>
                  <input type='hidden' name='idForm' value='$row[6]' id='idForm'>
                  <p>$row[2]</p>
                  <p>Цена: <span id='price'>$row[4]</span> р.</p>
                  <p>Вес: $row[8] кг. / шт.</p>
                  <p>Начинка: $row2[1]</p>
                  <p>Форма: $row3[1]</p>";
                
              }
            } 
          }
            mysqli_close($dbLink);  
          ?> 
      </div> 
      <hr>
      <form method="post" class="form-order">
        <?php
          $id = $_POST['hiddenId'];
          echo "<input type='hidden' name='hiddenId' value='$id[0]'>";
          include "db/dbConnect.php";
            $id = $_POST['hiddenId'];
            $query = "SELECT * FROM product WHERE id_product = $id[0]";
            $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
            if($result){
              $row = mysqli_fetch_row($result);//извл-ся отд-ая строка
              if($row[5] == 1){
                echo"
                <div class='row'>
                  <!-- ФОРМА -->
                  <div class='col-5 col-sm-4'>
                    <p>Выберите форму:</p>";
                    include "db/dbConnect.php";
                    $queryForm = "SELECT * FROM formcake";
                    $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД");
                    if($resultForm){
                      $rowsForm = mysqli_num_rows($resultForm); //кол-во строк
                      for ($i = 0;$i < $rowsForm; ++$i){
                        $rowForm = mysqli_fetch_row($resultForm);
                        echo "
                        <div class='form-check form-checkForm'>
                          <input class='form-check-input radioForm inputCastomCheck' type='radio' name='form' id='$rowForm[1]' value='$rowForm[0]'>
                          <label class='form-check-label' for='$rowForm[1]'>
                            $rowForm[1]
                          </label>
                        </div>";
                      }
                    }

            echo" </div>
                  <!-- НАЧИНКА -->
                  <div class='col-7 col-sm-8' style='padding-right:0;'>
                    <p>Выберите начинку:</p>
                    <div class='row'>";
                    include "db/dbConnect.php";
                    $queryFill = "SELECT * FROM filling";
                    $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД");
                    if($resultFill){
                      $rowsFill = mysqli_num_rows($resultFill); //кол-во строк
                      for ($i = 0;$i < $rowsFill; ++$i) {
                        $rowFill = mysqli_fetch_row($resultFill);
                        echo "
                        <div class='form-check col-xl-6 form-checkFill'>
                          <input class='form-check-input radioFill inputCastomCheck' type='radio' name='filling' id='$rowFill[1]' value='$rowFill[0]'>
                          <label class='form-check-label' for='$rowFill[1]'>
                            $rowFill[1]
                          </label>
                        </div>";
                      }
                    }
                echo"</div>
                  </div>
                </div>
                <hr>";
                }
              }
                mysqli_close($dbLink);
            ?>

        
        <div class="row">
          <?php
            include "db/dbConnect.php";
            $id = $_POST['hiddenId'];
            $query = "SELECT * FROM product WHERE id_product = $id[0]";
            $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
            if($result){
              $row = mysqli_fetch_row($result);//извл-ся отд-ая строка
              if($row[5]==1){
                echo "
                <div class='col-lg-6 mb-3 mb-lg-0'>
                  <p>Вес:&nbsp&nbsp<input type='number' id='weightValue' placeholder='1' min='1' max='10'> кг</p>
                  <div class='slidecontainer'>
                    <input type='range' min='1' max='10' value='$row[8]' class='slider' id='weight' name='weight'>
                  </div>
                </div>
                <div class='col-lg-6'>
                  <p>Количество: &nbsp&nbsp<input type='number' id='colValue'  min='1' max='15' placeholder='1'> шт</p>
                  <div class='slidecontainer'>
                    <input type='range' min='1' max='15' value='1' class='slider' id='col' name='col'>
                  </div>
                </div>
                ";  
              }else{
                echo "
                <div class='col-lg-6'>
                  <p>Количество: &nbsp&nbsp<input type='number' id='colValue' min='1' max='15' placeholder='1'> шт</p>
                  <div class='slidecontainer'>
                    <input type='range' min='1' max='15' value='$row[9]' class='slider' id='col' name='col'>
                  </div>
                </div>
                "; 
              }
              
            echo "
            </div>
            <hr>
            <div class='row but'>
              <div class='col-lg-5 col-xl-4'>Общая сумма: <span id='sum'>$row[4]</span> р.</div>
              <div class='col-md-4 col-lg-3 mt-3 mt-lg-0'>
                <input type='hidden' value='$row[4]' name='summa' id='sumInput'></input>
                <input type='button' class='butOrder' data-toggle='modal' data-target='#orderModal' value='ЗАКАЗАТЬ'></input>
              </div>
            </div>";
          }mysqli_close($dbLink);
          ?>
      </form>
      
    </div>
  </div>
</div>
  <div class="container">
    <div class="headingName">ПОХОЖИЕ ТОВАРЫ</div>
    
    <div class="home-demo">
      <div class="owl-carousel owl-theme">
        <?php
        include "db/dbConnect.php";
        $queryPr = "SELECT * FROM product WHERE id_product = $id[0]";
        $resultPr = mysqli_query($dbLink, $queryPr) or die("Ошибка БД");
        if($resultPr){
          $rowPr = mysqli_fetch_row($resultPr);//извл-ся отд-ая строка
          $querySimilar = "SELECT * FROM product WHERE id_category = $rowPr[5]";
          $resultSimilar = mysqli_query($dbLink, $querySimilar) or die("Ошибка БД");
          if ($resultSimilar) {
            $rowsSimilar = mysqli_num_rows($resultSimilar); //кол-во строк
            for ($i = 0;$i < $rowsSimilar; $i++) {
              $rowSimilar = mysqli_fetch_row($resultSimilar);//извл-ся отд-ая строка
              $imgEncode = base64_encode($rowSimilar[3]);
              $idProd = $rowSimilar[0];

              echo "
              <div class='item'>
                <form method='post' class='hiddenId' action = 'pageProduct.php' target='_blank'>
                  <a href='#'>
                    <img src='data:image/jpg;base64, $imgEncode' alt='$rowSimilar[1]' class='img-home-demo-item'>
                    <p>$rowSimilar[1]</p>
                    <p style='font-weight: 600;'>$rowSimilar[4]р/кг</p>
                    <button type='submit' class='carousel-hover' value=''>ПОДРОБНЕЕ
                    <img src='img/arrowRight.svg' class='imgHoverArrow'></button>
                    <input type='hidden' name='hiddenId[]' value='$rowSimilar[0]'></input>
                  </a>
                </form>
              </div>";
            }           
          }
          

        }
          mysqli_close($dbLink);
        ?>
      </div>
    </div>

  </div>

<?php
  include("pages/head-footer/footer.php");
?>
<!-- MODAL LIKE -->
  <div class='modal fade' id='inLikeModal' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>

        
      </div>
    </div>
  </div>

<!-- MODAL BASKET -->
  <div class='modal fade' id='inBasketModal' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        
      </div>
    </div>
  </div>

<!-- MODAL ORDER WHEN NO PROFILE -->
  <div class='modal fade' id='orderModal' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <?php
        if ($_SESSION['name']=='' && $_SESSION["adminName"]=='' && $_SESSION["courierName"]==''){
          echo"
          <div class='modal-body mx-auto'>
            <p class='ordNoUseInfo'>Вы можете выполнить вход в личный кабинет и использовать имеющиеся бонусы. Если у вас еще нет личного кабинета, вы можете зарегистрироваться и получить в подарок <b>15</b> бонусов.</p>
            <p class='ordNoUseInfo'>Желаете войти или зарегистрироваться?</p>
          </div>
                  
          <div class='modal-footer mx-auto' >
            <button type='button' class='btn' data-dismiss='modal' data-toggle='modal' data-dismiss='modal' data-target='#butAuthModal'>ДА</button>
            <button type='button' class='btn' id='butNextOrder'>НЕТ</button>
          </div>";
        }elseif($_SESSION['name']!='' && $_SESSION["adminName"]=='' && $_SESSION["courierName"]==''){
         echo"
          <div class='modal-body mx-auto'>
            <p class='ordNoUseInfo'>Товар автоматически добавится в корзину и вы сможете продолжить оформление заказа</p>
          </div>
                  
          <div class='modal-footer mx-auto' >
            <button type='button' class='btn nextOrd'>ПРОДОЛЖИТЬ</button>
            <button type='button' class='btn' data-dismiss='modal'>ЗАКРЫТЬ</button>
          </div>"; 
        }
        ?>
        


      </div>
    </div>
  </div>

  <div class='modal fade' id='nextOrderModal' data-backdrop="true" tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        
      </div>
    </div>
    <?php
    /*include("pages/orderModal.php");*/
    ?> 
  </div>
<!-- МОДАЛЬНОЕ ОКНО -->
  <div class='modal fade' id='modalOk' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          <button type='button' class='close' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body mx-auto'>
          <p>Благодарим за заказ! В течение получаса с Вами свяжется наш менеджер. Ожидайте подтверждения заказа.</p>
        </div>
              
      </div>
    </div>
  </div>
<!-- BUT-AUTH-MODAL -->
<div class="modal fade" id="butAuthModal" tabindex="-1" role="dialog" aria-hidden="true">
  <?php
  include("pages/logInSingUp/logInOrSignUp.php");
  ?>
  
</div>
<!-- LOG-IN-MODAL -->
<div class="modal fade" id="logInModal" tabindex="-1" role="dialog" aria-hidden="true">
  <?php
  include("logInSingUp/logIn.php");
  ?>
</div>
<!-- SING-UP-MODAL -->
<div class="modal fade" id="SingUpModal" tabindex="-1" role="dialog" aria-hidden="true">
  <?php
  include("logInSingUp/SingUp.php");
  ?>
</div>

<script src="js/owlCarousel.js"></script>
<script type="text/javascript">
/*СРАЗУ ВЫВОДИТЬ КАКАЯ НАЧИНКА ВЫБРАНА*/
var idFill = document.getElementById("idFill");
var radioFill = document.getElementsByClassName('radioFill');
for (var i = 0; i < radioFill.length; i++) {
  if(radioFill[i].value==idFill.value){
    radioFill[i].checked=true;
  }
}
/*----------------*/
/*СРАЗУ ВЫВОДИТЬ КАКАЯ ФОРМА ВЫБРАНА*/
var idForm = document.getElementById("idForm");
var radioForm = document.getElementsByClassName('radioForm');
for (var i = 0; i < radioForm.length; i++) {
  if(radioForm[i].value==idForm.value){
    radioForm[i].checked=true;
  }
}
/*----------------*/

/*----- ОПИСАНИЕ ------*/
  $('.descrProd').on('click',  function(){
    $('.fillProd').css('text-decoration', 'none');
    $('.fillProd').css('color', '#2C2C2C', 'important');

    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F', 'important');

    sendAjaxDescr('form-order','pages/descrProduct.php');
    return false;     
  });
 
  function sendAjaxDescr(ajax_form, url) {
    $.ajax({
      url:     url, //url страницы (action_ajax_form.php)
      type:     "POST", //метод отправки
      dataType: "html", //формат данных
      data: $("."+ajax_form).serialize(),
      success: function(response) { //Данные отправлены успешно
        $('.descrOrFill').html(response);
      },
      error: function(response) { // Данные не отправлены
        alert("данные не отправлены");
      }
    });
  }

/*----- НАЧИНКА ------*/
  $('.fillProd').on('click',  function(){
    $('.descrProd').css('text-decoration', 'none');
    $('.descrProd').css('color', '#2C2C2C', 'important');

    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F', 'important');

    sendAjaxDescr('form-order','pages/fillingProduct.php');
    return false;     
  });
   
  function sendAjaxDescr(ajax_form, url) {
    $.ajax({
      url:     url, //url страницы (action_ajax_form.php)
      type:     "POST", //метод отправки
      dataType: "html", //формат данных
      data: $("."+ajax_form).serialize(),
      success: function(response) { //Данные отправлены успешно
        
        $('.descrOrFill').html(response);
      },
      error: function(response) { // Данные не отправлены
        alert("данные не отправлены");
      }
    });
  }

/*----- BASKET ------*/
  $('.inBasket').on('click',  function(){
    
    $("#inBasketModal").modal('show');
    sendAjaxBasket('form-order','pages/BasketClick.php');
      return false;
  });
  function sendAjaxBasket(ajax_form, url) {
    $.ajax({
      url:     url, //url страницы (action_ajax_form.php)
      type:     "POST", //метод отправки
      dataType: "html", //формат данных
      data: $("."+ajax_form).serialize(),
      success: function(response) { //Данные отправлены успешно
        
        $('#inBasketModal').html(response);
      },
      error: function(response) { // Данные не отправлены
        alert("данные не отправлены");
      }
    });
  }
/*ЗАКАЗ ТОВАРА АВТОРИЗ-ЫМ ПОЛЬЗ-ЕМ*/
  $('.nextOrd').on('click',  function(){
    
    $("#orderModal").modal('show');
    sendAjaxAddBasketNextOrd('form-order','pages/addBasketAndNextOrd.php');
      return false;
  });
  function sendAjaxAddBasketNextOrd(ajax_form, url) {
    $.ajax({
      url:     url, //url страницы (action_ajax_form.php)
      type:     "POST", //метод отправки
      dataType: "html", //формат данных
      data: $("."+ajax_form).serialize(),
      success: function(response) { //Данные отправлены успешно
        
        $('#orderModal').html(response);
      },
      error: function(response) { // Данные не отправлены
        alert("данные не отправлены");
      }
    });
  }
/*----- LIKE --------*/
  $('.inLike').on('click',  function(){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){
        $("#inLikeModal").modal('show');
        $('#inLikeModal').html(this.response);
      }
    }
    request.open('GET','pages/likeClick.php?id=' + this.value, true);
    request.send();
  });

  $('.deleteLike').on('click',  function(){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){
        $("#inLikeModal").modal('show');
        $('#inLikeModal').html(this.response);
      }
    }
    request.open('GET','pages/DeleteLike.php?id=' + this.value, true);
    request.send();
     
  });

/*----- ОКНО ЗАКАЗА -----*/
/*function butNextOrder(){
  
}*/
  $('#butNextOrder').on('click',  function(){
    /*$("#orderModal").modal('hide');
    $("#nextOrderModal").modal('show');*/
    sendAjaxOrd('form-order','pages/orderModal.php');
    return false; 
        
  });
  function sendAjaxOrd(ajax_form, url) {
    $.ajax({
      url:     url, //url страницы (action_ajax_form.php)
      type:     "POST", //метод отправки
      dataType: "html", //формат данных
      data: $("."+ajax_form).serialize(),
      success: function(response) { //Данные отправлены успешно
        
        $('#orderModal').html(response);
      },
      error: function(response) { // Данные не отправлены
        alert("данные не отправлены");
      }
    });
  }

</script>
<!-- slick slider -->
<script src="js/slickSliderProd.js"></script>
<!-- ползунок  -->
<script src="js/slideContainerProduct.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- библиотека jquery -->
<script src="libs/jquery-3.6.0.min.js"></script>
<!-- подключить библиотеку Bootstrap (js файл) -->
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
<!-- SLICK SLIDER -->
<script type="text/javascript" src="libs/slick/slick.min.js"></script>
<!-- OWL CAROUSEL -->
<script src="libs/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
  </body>
</html>
