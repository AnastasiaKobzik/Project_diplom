<?php
include "../../db/dbConnect.php";
$idDecor = $_GET['idDecor'];
$query = "DELETE FROM decoration WHERE id_decoration = $idDecor";
$result=mysqli_query($dbLink, $query);
if ($result) {
    echo "<p style='text-align: center;'>Украшение удалено</p>";
}else{
    echo "<p style='text-align: center;'>К сожалению, на данный момент вы не можете удалить это украшение. Попробуйте позже.</p>";
}
mysqli_close($dbLink);
?>