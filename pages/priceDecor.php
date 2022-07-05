<?php
include "../db/dbConnect.php";

$idDecor = $_GET['idDecor'];
$queryDecor = "SELECT * FROM decoration WHERE id_decoration = $idDecor";  
$resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД2");
$rowDecor = mysqli_fetch_row($resultDecor);

echo "$rowDecor[2]";

mysqli_close($dbLink);
?>