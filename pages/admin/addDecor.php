<?php
include "../../db/dbConnect.php";
$nameDecor = $_POST['nameDecor'];
$priceDecor = $_POST['priceDecor'];
$priceRegEx = "/^[0-9.]{1,3}$/";
$error = $success = '';
if($nameDecor!=null && $priceDecor!=null){
    if ($priceDecor!=0 && preg_match($priceRegEx, $priceDecor)){
        $query = "INSERT INTO decoration(name_decoration, price) VALUES('$nameDecor','$priceDecor')";
        $result=mysqli_query($dbLink, $query);
        if ($result) {
            $success = "<p style='text-align: center;' class='mb-5'>Добавлено новое украшение</p>";
        }else{
            $error ="Ошибка".mysqli_error($dbLink);
        }
    }else $error = "Неправильно введена цена";

}else{
	$error = "Заполните все поля";
}


 
$data = array(
    'error'   => $error,
    'success' => $success,
);
 
header('Content-Type: application/json');
echo json_encode($data, JSON_UNESCAPED_UNICODE);
exit();

mysqli_close($dbLink);
?>