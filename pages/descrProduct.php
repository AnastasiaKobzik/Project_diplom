<?php
/*$id = $_POST['hiddenId'];
//echo "<p>$id</p>";
include "../db/dbConnect.php";
$id = $_POST['hiddenId'];
$query = "SELECT * FROM product WHERE id_product = $id";
$query1 = "SELECT id_filling FROM product WHERE id_product = $id";//достаем id начинка
$result = mysqli_query($dbLink, $query) or die("Ошибка БД");
$result1 = mysqli_query($dbLink, $query1) or die("Ошибка БД1");
if($result && $result1){
  $row = mysqli_fetch_row($result);//извл-ся отд-ая строка
  $row1 = mysqli_fetch_row($result1);
  $query2 = "SELECT * FROM filling WHERE id_filling = $row[0]";//достаем описание начинки
  $result2 = mysqli_query($dbLink, $query2) or die("Ошибка БД2");
  if($result2){
    $row2 = mysqli_fetch_row($result2);
    echo "
    <p>$row[2]</p>
    <p>Цена: $row[4] р.</p>
    <p>Начинка: $row2[1]</p>";
  }
  
}
mysqli_close($dbLink);*/  
?>
<?php
$id = $_POST['hiddenId'];
include "../db/dbConnect.php";
$id = $_POST['hiddenId'];
$query = "SELECT * FROM product WHERE id_product = $id";
$result = mysqli_query($dbLink, $query) or die("Ошибка БД");
if($result){
  $row = mysqli_fetch_row($result);//извл-ся отд-ая строка
  if($row[5] != 1){
    echo "
    <p>$row[2]</p>
    <p>Цена: <span id='price'>$row[4]</span> р.</p>
    <p>Вес: $row[8] г/шт</p>";
  }else{
    $query1 = "SELECT id_filling FROM product WHERE id_product = $id";//достаем id начинка
    $result1 = mysqli_query($dbLink, $query1) or die("Ошибка БД1");
    if($result1){
      $row1 = mysqli_fetch_row($result1);
      $query2 = "SELECT * FROM filling WHERE id_filling = $row[7]";//достаем описание начинки
      $result2 = mysqli_query($dbLink, $query2) or die("Ошибка БД2");
      $query3 = "SELECT * FROM formcake WHERE id_formCake = $row[6]";//достаем описание форы
      $result3 = mysqli_query($dbLink, $query3) or die("Ошибка БД3".mysqli_error($dbLink));
      if($result2 && $result3){
        $row2 = mysqli_fetch_row($result2);
        $row3 = mysqli_fetch_row($result3);
        echo "
        <p>$row[2]</p>
        <p>Цена: <span id='price'>$row[4]</span> р.</p>
        <p>Вес: $row[8] кг / шт</p>
        <p>Начинка: $row2[1]</p>
        <p>Форма: $row3[1]</p>";
      }
    }
  } 
}
mysqli_close($dbLink);  
?>