<?php
include "../../db/dbConnect.php";
$idDecor = $_POST['idDecor'];
$nameDecor = $_POST['nameDecor'];
$priceDecor = $_POST['priceDecor'];
$priceRegEx = "/^[0-9.]{1,3}$/";
if($nameDecor!=null && $priceDecor!=null){
  if ($priceDecor!=0 && preg_match($priceRegEx, $priceDecor)){
    $queryDecor = "UPDATE decoration SET name_decoration='$nameDecor', price='$priceDecor' WHERE id_decoration = $idDecor";
    $resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД");
    if($resultDecor){
      print "<script language='Javascript' type='text/javascript'>
              location.reload();
              </script>";
    }
  }else echo "Неправильно введена цена";
}else{
  echo "Заполните все поля";
}

?>