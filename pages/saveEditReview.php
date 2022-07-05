<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "../db/dbConnect.php";

$idReview = $_POST['idReview'];
$dataReview = $_POST['dateReview'];
$textReview = $_POST['review'];
$error = $success = '';

if($textReview!=null){
	$queryChange = "UPDATE reviews SET data_review='$dataReview', text_review='$textReview' WHERE id_review = '$idReview'";  
    $resultChange = mysqli_query($dbLink, $queryChange) or die("Ошибка БД1");
	if ($resultChange){
		$success = "df";
	}
}else{
	$error = "Пожалуйста, введите текст";
}

$data = array(
    'error'   => $error,
    'success' => $success,
);
 
/*header('Content-Type: application/json');*/
echo json_encode($data);
exit();
mysqli_close($dbLink);
?>