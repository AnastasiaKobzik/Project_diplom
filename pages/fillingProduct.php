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
    <link rel="stylesheet" href="../libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    
    <link rel="stylesheet" type="text/css" href="css/pageProduct.css">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Birthstone+Bounce&family=Oswald:wght@300&display=swap" rel="stylesheet">

    <!-- SLICK SLIDER -->
    <link rel="stylesheet" type="text/css" href="../libs/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="../libs/slick/slick-theme.css"/>

  </head>
<body>
<?php
/*$id = $_POST['hiddenId'];*/
echo "<p>$id</p>";
include "../db/dbConnect.php";
echo "<div class='slick-slider'>";
$query = "SELECT * FROM filling";
$result = mysqli_query($dbLink, $query) or die("Ошибка БД");
if($result){
  $rows = mysqli_num_rows($result); //кол-во строк
  for ($i = 0;$i < $rows; ++$i) {
    $row = mysqli_fetch_row($result);//извл-ся отд-ая строка
    $imgEncode = base64_encode($row[4]);
    echo "
          <div class='slide'>
            <img src='data:image/jpg;base64, $imgEncode' alt='$row[1]'>
          </div>";
  }
}
echo "</div>";
echo "<div class='slick-for'>";
$query = "SELECT * FROM filling";
$result = mysqli_query($dbLink, $query) or die("Ошибка БД");
if($result){
  $rows = mysqli_num_rows($result); //кол-во строк
  for ($i = 0;$i < $rows; ++$i) {
    $row = mysqli_fetch_row($result);//извл-ся отд-ая строка
    
    echo "
          <div class='slide'>
            <p>$row[1]</p>
            <p>$row[2]</p>
          </div>";
  }
}
echo "</div>";
mysqli_close($dbLink);  
?>
<!-- slick slider -->
<script src="../js/slickSliderProd.js"></script>

<!-- библиотека jquery -->
<script src="../libs/jquery-3.6.0.min.js"></script>
<!-- подключить библиотеку Bootstrap (js файл) -->
<script src="../libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
<!-- SLICK SLIDER -->
<script type="text/javascript" src="../libs/slick/slick.min.js"></script>
    
  </body>
</html>