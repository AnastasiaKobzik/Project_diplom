<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>О нас</title>

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/styleAboutUs.css">

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
    <div class="headingAboutUs">О НАС</div>
    <div class="row about align-items-center">
      <div class="col-md-4 col-lg-3 photo1"><img src="img/aboutUs/confectioner2.jpg" alt="кондитер1"></div>
      <div class="col-lg-3 photo2"><img src="img/aboutUs/confectioner.jpg" alt="кондитер2"></div>
      <div class="col-12 col-md-8 col-lg-6 aboutP">
        <p>О КОНДИТЕРСКОЙ</p>
        <p>Частная кондитерская “Bake Cake” предлагает великолепные кондитерские изделия и торты ручной работы.<br><br>Их потрясающий вкус и дизайн никого не оставит равнодушным. Мы предлагаем торты разной тематики, любой сложности украшения и многообразие состава.<br><br>Особенность нашей продукции заключается в том, что мы используем только качественные, свежие продукты. Наша продукция не содержит ГМО, консервантов, отдушек и других вредных веществ, а также дрожжей, сои, маргарина. Поэтому кондитерские изделия обладают неповторимым, изысканным вкусом и утонченным ароматом, которые очаруют Вас навсегда!</p>
        
      </div>
    </div>
  </div>
  <div class="container-fluid bgCont">
    <div class="container">
      <p>ПОЧЕМУ МЫ?</p>
      <div class="row">
        <div class="col-md-6 col-lg-3 ellips">
          <img src="img/ellipse.svg" alt="стабильное качество">
          <div class="txtWhyWe">
            <p>1&nbsp&nbspСТАБИЛЬНОЕ КАЧЕСТВО</p>
            <p>Насыщенный  вкус, великолепный  аромат  и  безупречный  внешний вид   - неотъемлемая  часть каждого  изделия.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 ellips">
          <img src="img/ellipse.svg" alt="безупречный сервис">
          <div class="txtWhyWe">
            <p>2&nbsp&nbspБЕЗУПРЕЧНЫЙ СЕРВИС</p>
            <p>Вежливость  персонала,  желание  помочь  и оперативность  позволяет каждому клиенту почувствовать  себя  значимым.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 ellips">
          <img src="img/ellipse.svg" alt='стабильное качество'>
          <div class="txtWhyWe">
            <p>3&nbsp&nbspВОВЛЕЧЕННОСТЬ</p>
            <p>Вы лично участвуете в создании вашего торта, а мы применяем свои навыки, чтобы дать Вам то, чего вы желаете.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 ellips">
          <img src="img/ellipse.svg" alt="безупречный сервис">
          <div class="txtWhyWe">
            <p>4&nbsp&nbspСИСТЕМА СКИДОК</p>
            <p>Пусть  эта мелочь  станет  приятной вишинкой на Вашем торте.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container ourCommand">
    <p class="ourCommandP">НАША КОМАНДА</p>
    <div class="home-demo">
      <div class="owl-carousel owl-theme">
        <div class='item'>
          <div class="command">
            <img src="img/aboutUs/conditer.jpg" alt="Кондитер">
            <p>Александра</p>
            <p>кондитер</p>
          </div>
        </div>
        <div class="item">
          <div class="command">
            <img src="img/aboutUs/conditer2.jpg" alt="Кондитер">
            <p>Дарья</p>
            <p>кондитер</p>
          </div>
        </div>
        <div class="item">
          <div class="command">
            <img src="img/aboutUs/oformitel.jpg" alt="Оформитерь">
            <p>Виктория</p>
            <p>оформитель</p>
          </div>
        </div>
        <div class="item">
          <div class="command">
            <img src="img/aboutUs/courier.jpg" alt="Курьер">
            <p>Мария</p>
            <p>курьер</p>
          </div>
        </div>
      </div>
    </div>
  </div> 
  </div>

  <div class="container-fluid containerTime">
    <div class="row">
      <div class="col-md-7 col-lg-6 bgColor ">
        <div class=" bgColorCont">
          <p class="bgColorPone">Кондитерская</p>
          <p class="bgColorPtwo">Bake Cake</p>
          <p class="bgColorPthree">Понедельник - Воскресенье<br><b><span class="r">9.00 - 20.00</span></b></p>
          <div style="display:flex; flex-direction: row;"><img src="img/icon/telephone2.png" alt="телефон"><p class="bgColorPthree">+375 (33) 356 25 22</p></div>
          <div><a href="https://www.instagram.com" class="instAboutCond"><img src="img/icon/instagram2.png" alt="инстаграм"><p class="bgColorPthree">bakeCake_</p></a></div>
          
        </div>
      </div>
      <div class="col-md-5 col-lg-6 bgImg"></div>
    </div>
  </div>

  <div class="container bonuses">
    <p>СИСТЕМА БОНУСОВ</p>
    <div class="row">
      <div class="col-lg-6 col-xl-4">
        <div class="row posRelative">
          <img src="img/ellipse2.svg" alt="15 бонусов">
          <div class="bonus">
            <p>15</p>
            <p>БОНУСОВ</p>
          </div>
        </div>
        <p class="widthPBonuses">При регистрации Вы получаете 15 бонусов, которые сможете найти в своём личном кабинете и в дальнейшем использовать их.</p>
      </div>
      <div class="col-lg-6 col-xl-4">
        <div class="row posRelative">
          <img src="img/ellipse2.svg" alt="10 бонусов">
          <div class="bonus">
            <p>10</p>
            <p>БОНУСОВ</p>
          </div>
        </div>
        <p class="widthPBonuses">При оформлении заказа на сумму 60&nbspр. Вы получаете 10 бонусов, которые сможете использовать при оформлении следующего заказа.</p>
      </div>
      <div class="col-lg-6 col-xl-4">
        <div class="row posRelative">
          <img src="img/ellipse2.svg" alt="5 бонусов">
          <div class="bonus">
            <p>&nbsp5</p>
            <p>&nbspБОНУСОВ</p>
          </div>
        </div>
        <p class="widthPBonuses">При заказе трех и более товаров за раз Вам предоставляется 5 бонусов, которые Вы сможете использовать при оформлении следующего заказа.</p>
      </div>

    </div>
  </div>
<?php
  include("pages/head-footer/footer.php");
  ?>
<script src="js/owlCarouselAboutUs.js"></script>
<!-- библиотека jquery -->
<script src="libs/jquery-3.6.0.min.js"></script>
<!-- подключить библиотеку Bootstrap (js файл) -->
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>

<!-- OWL CAROUSEL -->
<script src="libs/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    
  </body>
</html>