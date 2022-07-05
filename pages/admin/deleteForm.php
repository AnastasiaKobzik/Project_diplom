<?php
include "../../db/dbConnect.php";
$idForm = $_GET['idForm'];
$query = "DELETE FROM formcake WHERE id_formCake = $idForm";
$result=mysqli_query($dbLink, $query);
if ($result) {
    echo "<p style='text-align: center;'>Форма удалена</p>";
}else{
    echo "<p style='text-align: center;'>К сожалению, на данный момент вы не можете удалить форму. Попробуйте позже.</p>";
}
mysqli_close($dbLink);
?><!-- .mysqli_error($dbLink). -->