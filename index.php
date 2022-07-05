<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="ru">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Кондитерская BakeCake</title>
    <meta name="description" content="BakeCake - кондитерские изделия любой сложности с бережной доставкой">

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/styleFillHome.css">
    

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Birthstone+Bounce&family=Montserrat:wght@300;400;500;600;700&family=Oswald:wght@300&display=swap" rel="stylesheet">

    <!-- OWN CAROUSEL -->
    <link rel="stylesheet" href="libs/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="libs/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">

  <!-- ICONS -->
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  </head>
  <body>
 <?php
  include("pages/head-footer/headerHome.php");
  ?>

  <div class="container">
    <div class="row">
      <div class="col-12 mt-5 mt-lg-0 col-lg-6 align-self-center contentHome">
        <div class="namePage">Bake Cake</div>
        <div class="font-monts">Кондитерские изделия любой сложности с <br>бережной доставкой</div>
        <div class="mt-5 but-catalog-home"><a href="catalog.php" class="">Перейти в каталог</a><img src="img/arrowRight.svg"></div>
        
      </div>
      <div class="col-lg-6 ">
        <!-- <img src="img/img-home/photo-home.jpg" class="imgHome"> -->
        <div class="imgHome"></div>
        <div class="backgroundImg"></div>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="heading">ПОПУЛЯРНЫЕ ТОВАРЫ</div>
    
    <div class="home-demo">
      <div class="owl-carousel owl-theme">
        <?php
        include "db/dbConnect.php";
        $query = "SELECT * FROM product ORDER BY RAND() LIMIT 6";
        $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
        if($result){
          $rows = mysqli_num_rows($result); //кол-во строк
          for ($i = 0;$i < $rows; ++$i) {
            $row = mysqli_fetch_row($result);//извл-ся отд-ая строка
            $imgEncode = base64_encode( $row[3] );
            $idProd = $row[0];

            echo "
            <div class='item'>
              <a href='catalog.php'>
                <img src='data:image/jpg;base64, $imgEncode' alt='$row[1]' alt='$row[1]' class='img-home-demo-item'>
                <p>$row[1]</p>
                <p style='font-weight: 600;'>$row[4]р/кг</p>
                <button type='submit' class='carousel-hover' value=''>В КАТАЛОГ
                <img src='img/arrowRight.svg' class='imgHoverArrow'></button>
              </a>
            </div>";
          }
        }
          mysqli_close($dbLink);
        ?>
      </div>
    </div>

  </div>

  <div class="container-fluid mt-5 filling">
    <div class="heading container">НАЧИНКИ</div>
    <ul class='advantages-circle'>    
    <?php
        include "db/dbConnect.php";
        $query = "SELECT * FROM filling";
        $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
        if($result){
          $rows = mysqli_num_rows($result); //кол-во строк
          for ($i = 0;$i < $rows; ++$i) {
            $row = mysqli_fetch_row($result);//извл-ся отд-ая строка
            $imgEncodeBig = base64_encode($row[3]);
            $imgEncodeMini = base64_encode($row[4]);
            $idProd = $row[0];

            echo "
          <li class='advantages display$row[0]'>
            <img src='data:image/jpg;base64, $imgEncodeBig' alt='$row[1]'>
            <div class='backgrBlack'></div>
            <div class='displColumn'>
              <p class='nameFill'>$row[1]</p>
              <p class='descrFill'>$row[2]</p>
            </div>
          </li>
          <li class='advantages-circle__element'>
            <img src='data:image/jpg;base64, $imgEncodeMini' class='$row[0]' alt='$row[1]'>
          </li>";
          }
          
        }
          mysqli_close($dbLink);
        ?>

    </ul>
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
<?php
  include("pages/head-footer/footerHome.php");
  ?>

<script src="js/owlCarousel.js"></script>
<!-- библиотека jquery -->
<script src="libs/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
/*расположение начинок в круге*/
  var advantages_circle_element = document.getElementsByClassName('advantages-circle__element');
  var angle = 360 / advantages_circle_element.length
  var n = 0;
  for (var i = 0; i < advantages_circle_element.length; i++) {
    advantages_circle_element[i].style.transform = `rotate(${n}deg) translate(${17.5}em) rotate(${-n}deg)`;
    n+=angle;
  }



/*при загрузке стр первый элемент сразу увеличенный и описание выводится*/
  var advantages = document.getElementsByClassName('advantages');
  for (var i = 1; i < advantages.length; i++){
    advantages[i].style.display = 'none';
  }
  var img_circle = advantages_circle_element[0].querySelector('img');

  img_circle.style.width = '8em';
  img_circle.style.height = '8em';



/*при клике на начинку увеличив-ся кружочек и меняется круг с начинкой*/
  $('.advantages-circle__element img').on('click',function(e){
    var id_click = $(e.target).attr("class");

    for (var i = 0; i < advantages_circle_element.length; i++){
      var img_circle = advantages_circle_element[i].querySelector('img');
      img_circle.style.transition = 'all .3s ease-in';
      img_circle.style.width = '6em';
      img_circle.style.height = '6em';
      
    }
    for (var i = 0; i < advantages.length; i++){
      if(advantages[i].classList.contains('display'+id_click)){
        advantages[i].style.display = 'flex';
      }else{
        advantages[i].style.display = 'none';
      }
    }
    this.style.width = '8em';
    this.style.height = '8em';

  });


</script>
<!-- подключить библиотеку Bootstrap (js файл) -->
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>

<!-- OWL CAROUSEL -->
<script src="libs/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    
  </body>
</html>