<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "../db/dbConnect.php";

$idUser = $_SESSION['id_user'];
$dataReview = $_POST['dateReview'];
$textReview = $_POST['review'];
$error = $success = '';
if($textReview!=null){
	$query = "INSERT INTO reviews(id_user, data_review,	text_review) VALUES('$idUser','$dataReview','$textReview')";
	$result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
	if ($result){
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