<?php
include "../../db/dbConnect.php";
$idfilling = $_GET['id'];
$query = "DELETE FROM filling WHERE id_filling = '$idfilling'";  
$result = mysqli_query($dbLink, $query);
if ($result){
	echo "<p style='text-align: center;'>Начинка удалена</p>";
}else{
    echo "<p style='text-align: center;'>К сожалению, на данный момент вы не можете удалить эту начинку. Попробуйте позже.</p>";
}
mysqli_close($dbLink);
?>