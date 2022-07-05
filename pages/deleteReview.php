<?php
  include "../db/dbConnect.php";
  $idReview = $_GET['id'];
  $query = "DELETE FROM reviews WHERE id_review = '$idReview'";
  $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
  if($result){
    echo "string"; 
  }  
  mysqli_close($dbLink);
?>