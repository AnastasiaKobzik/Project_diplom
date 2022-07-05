<?php
if(session_status()!=PHP_SESSION_ACTIVE) 
        session_start();
?>

<html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/styleHome.css">
    

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Birthstone+Bounce&family=Oswald:wght@300&display=swap" rel="stylesheet">

  </head>
<body>
<?php
  if ($_SESSION['name']=='' && $_SESSION["adminName"]=='' && $_SESSION["courierName"]==''){
  echo"
<div class='container footer'>
  <div class='row'>
    <div class='col-12 col-sm-4 col-md-5 col-lg-4'>
      <div class='row'>
        <div class='col-6 col-md-5 col-lg-4'><a href='catalog.php'><p>Каталог</p></a></div>
        <div class='col-6 col-md-7 col-lg-4'><a href='reviews.php'><p>Отзывы</p></a></div>
      </div>
      <div class='row'>
        <div class='col-6 col-md-5 col-lg-4'><a href='aboutUs.php'><p>О нас</p></a></div>
        <div class='col-6 col-md-7 col-lg-8'><a href='shippingAndPayment.php'><p>Доставка и оплата</p></a></div>
      </div>
    </div>
    <a class='col-5 col-sm-3 col-md-2 col-lg-4 mt-4 mt-sm-0 logo' href='index.php'></a>
    <div class='col-7 col-sm-5 col-md-5 col-lg-4 mt-4 mt-sm-0'>
      <div class='row'>
        <div class='col-10 col-md-9 col-lg-8'>
          <p>Понедельник - Воскресенье</p><p>9.00 - 20.00</p>
          <p>+375 (33) 356 25 22</p>
        </div>
        <div class='col-2 col-md-3 col-lg-4 icon'>
          <a href='https://www.instagram.com'><img src='img/icon/instagram.png' alt='инстаграм' class='inst'></a>
          <a href='https://www.pinterest.com/'><img src='img/icon/pinterest.png' alt='пинтерест' class='pint'></a>
        </div>
      </div>
    </div>
  </div>
</div>";
  
}elseif ($_SESSION['name']!=''&&$_SESSION['courierName']=='' && $_SESSION["adminName"]=='') {
echo "
<div class='container footer'>
  <div class='row'>
    <div class='row col-12 col-md-5'>
      
        <div class='col-3 col-md-5 col-lg-3'><a href='catalog.php'><p>Каталог</p></a></div>
        <div class='col-4 col-md-7 col-lg-4'><a href='like.php'><p>Избранное</p></a></div>
        <div class='col-5 col-md-5 col-lg-5'><a href='bonuses.php'><p>Бонусы</p></a></div>
      
        <div class='col-3 col-md-7 col-lg-3'><a href='basket.php'><p>Корзина</p></a></div>
        <div class='col-4 col-md-5 col-lg-4'><a href='allOrders.php'><p>Все заказы</p></a></div>
        <div class='col-5 col-md-7 col-lg-5'><a href='shippingAndPayment.php'><p>Доставка и оплата</p></a></div>        
      
        <div class='col-3 col-md-5 col-lg-3'><a href='aboutUs.php'><p>О нас</p></a></div>
        <div class='col-4 col-md-7 col-lg-4'><a href='reviews.php'><p>Отзывы</p></a></div>
    
    </div>
    <a class='col-5 col-sm-4 col-md-3 col-lg-2 mt-4 mt-md-0 logo' href='index.php'></a>
    <div class='col-7 col-sm-8 col-md-4 col-lg-5 mt-4 mt-md-0'>
      <div class='row'>
        <div class='col-lg-1'></div>
        <div class='col-9 col-lg-8'>
          <p>Понедельник - Воскресенье</p><p>9.00 - 20.00</p>
          <p>+375 (33) 356 25 22</p>
        </div>
        <div class='col-3 col-lg-3 icon'>
          <a href='https://www.instagram.com'><img src='img/icon/instagram.png' alt='инстаграм' class='inst'></a>
          <a href='https://www.pinterest.com/'><img src='img/icon/pinterest.png' alt='пинтерест' class='pint'></a>
        </div>
      </div>
    </div>
  </div>
</div>
";
}
?>

<a id="backTopHome" title="Наверх" href="#"></a>
<!-- библиотека jquery -->
<script src="libs/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
/* Прокручивает страницу вверх при нажатии на кнопку */
  $(window).scroll(function() {
      var height = $(window).scrollTop();
      if (height > 100) {
          $('#backTopHome').fadeIn();
      } else {
          $('#backTopHome').fadeOut();
      }
  });
  $(document).ready(function() {
      $("#backTopHome").click(function(event) {
          event.preventDefault();
          $("html, body").animate({ scrollTop: 0 }, "slow");
          return false;
      });

  });
</script>
</body>
</html>