<?php
include "../../db/dbConnect.php";
$nameForm = $_POST['nameForm'];
$error = $success = '';
if($nameForm!=null){
	$query = "INSERT INTO formcake(form) VALUES('$nameForm')";
    $result=mysqli_query($dbLink, $query);
    if ($result) {
        $success = "<p style='text-align: center;' class='mb-5'>Добавлена новая форма</p>";
    }else{
    	$error ="Ошибка".mysqli_error($dbLink);
    }
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