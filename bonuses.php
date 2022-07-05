<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Бонусы</title>

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/styleBonuses.css">

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
    <div class="headingPage">СИСТЕМА БОНУСОВ</div>
    <div class='row'>
      <div class='col-lg-6'>
        &nbsp&nbsp&nbspТеперь вы можете оплачивать часть заказа бонусами!<br><br>&nbsp&nbsp&nbspПри покупке всегда приятно получить скидку, поэтому в нашей кондитерской имеется система бонусов, позволяющая Вам копить бонусы и использовать их при оформлении заказа!<br><br>&nbsp&nbsp&nbspБонусная система действует только для зарегистрированных пользователей (1 бонус = 1 рубль).<br><br>&nbsp&nbsp&nbspБонусы начисляются:<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>5 бонусов</b> - при заказе трех и более товаров за раз;<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>10 бонусов</b> - при оформлении заказа на сумму от 60 р;<br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>15 бонусов</b> - при регистрации.<br><br>
        &nbsp&nbsp&nbspСтоит отметить, что бонусы Вы сможете использовать если сумма заказа больше 20 рублей и если количество бонусов не превышает сумму заказа.
      </div>
      <div class='col-lg-6 bonuses mt-5 mt-lg-0'>
        <p class="howBonuses">На Вашем счету:</p>
        <div class='el1'>
        <?php
        $idUser = $_SESSION["id_user"];
        include "db/dbConnect.php";
        $query = "SELECT * FROM users WHERE id_user = $idUser";
        $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
        if($result){
          $row = mysqli_fetch_row($result);
    echo "<p class='number'>$row[5]</p>";
        }
        mysqli_close($dbLink);
        ?>
          <p class='tbonus'>БОНУСОВ</p>
        </div>
      </div>
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