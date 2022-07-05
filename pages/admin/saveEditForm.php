<?php
include "../../db/dbConnect.php";
$idForm = $_POST['idForm'];
$nameForm = $_POST['nameForm'];
if($nameForm!=null){
  $queryDecor = "UPDATE formcake SET form='$nameForm' WHERE id_formCake = $idForm";
  $resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД");
  if($resultDecor){
    print "<script language='Javascript' type='text/javascript'>
            location.reload();
            </script>";
  }  
}else{
  echo "Заполните все поля";
}

?>