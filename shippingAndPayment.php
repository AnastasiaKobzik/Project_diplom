<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Доставка и Оплата</title>

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/styleShippingAndPayment.css">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Oswald:wght@300&display=swap" rel="stylesheet">

    <!-- OWN CAROUSEL -->
    <link rel="stylesheet" href="libs/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="libs/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">

  <!-- ICONS -->
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  </head>
  <body>
 <?php
  include("pages/head-footer/header.php");
  ?>

  <div class="container">
    <div class="headingPage">ДОСТАВКА И ОПЛАТА</div>
    <div class="row shipping">
      <div class="col-lg-2 col-xl-3"></div>
      <div class="col-12 col-sm-6 col-md-7 col-lg-4 col-xl-3 mt-4">
        
        <p class="">Бережно упакованный товар мы доставим по указанному адресу. Доставка осуществляется только в пределах города Минска. <br><br>При оформлении заказа Вы можете выбрать способ оплаты: наличные или карта (Visa, Mastercard и тп). Оплата при получении.</p>
      </div>
      <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3 imgShipping">
        <img src="img/shippingAndPayment/courier.jpg" class="imgShip" alt='Курьер'>
      </div>
      <div class="col-lg-2 col-xl-3 none"></div>
    </div>
    <div class="hedingParagraph">КАК СДЕЛАТЬ ЗАКАЗ?</div>
    <div class='row'>
      <div class="col-lg-1 none"></div>
      <div class="col-12 col-lg-3">
        <p class="mt-3 txt"><b>1</b> - Вы выбираете нужный товар, начинку, вес, форму, количество</p>
      </div>
      <div class="none1 col-lg-3">
        <img src="img/shippingAndPayment/step1.jpg" class="imgStep" alt='Шаг 1'>
      </div>     
      <div class="col-12 col-lg-3 disp">
        <p class="txt"><b>2</b> - Добавляете товар в корзину. В корзине Вы сможете внести изменения, если это будет необходимо</p>
      </div>
      <div class="col-lg-2 none"></div>
    
      <div class="col-lg-1 none"></div>
      <div class="none1 col-lg-3 mt-lg-5 ">
        <img src="img/shippingAndPayment/step2.jpg" class="imgStep" alt='Шаг 2'>
      </div>
      <div class="col-12 col-lg-3  mt-lg-5 displCol">
        <p class="mt-lg-4 txt"><b>3</b> - Нажимаете кнопку “заказать” и приступаете к оформлению заказа</p>
        <p class="mb-3 txt"><b>4</b> - После заполнения всех нужных полей нажимаете кнопку “оформить заказ”. Готово!</p>
      </div>     
      <div class="col-12 col-lg-3  mt-lg-5 imgStepSize">
        <img src="img/shippingAndPayment/step3.jpg" class="imgStep4" alt='Шаг 4'>
      </div>
      <div class="col-1 none"></div>
    </div>
    
  </div>



<?php
  include("pages/head-footer/footer.php");
  ?>





<!-- библиотека jquery -->
<script src="libs/jquery-3.6.0.min.js"></script>
<!-- подключить библиотеку Bootstrap (js файл) -->
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>

<!-- OWL CAROUSEL -->
<script src="libs/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    
  </body>
</html>