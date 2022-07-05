<?php
include "../../db/dbConnect.php";
$idCourier = $_POST['id'];
$nameCourier = $_POST['nameCourier'];
$loginCourier = $_POST['loginCourier'];
$password = $_POST['password'];

$nameRegEx = "/[А-Я]{1}[а-я]{2,}/u";
$passwordRegEx = "/^[a-z0-9]{4,10}$/";
$emailRegEx = "/^[a-zA-Z0-9]{2,15}Courier@[a-zA-Z0-9.]{2,15}$/";
$error = $success = '';
if($nameCourier!=null && $loginCourier!=null && $password!=null){
	if (preg_match($nameRegEx, $nameCourier)){
		if (preg_match($emailRegEx, $loginCourier)){
			if (preg_match($passwordRegEx, $password)){
				$queryEmail = "SELECT email FROM couriers WHERE email = '$loginCourier' AND id_courier <> '$idCourier'";
				$resultEmail = mysqli_query($dbLink, $queryEmail) or die("Ошибка запроса".mysqli_error($dbLink));
				if ($resultEmail){
			        $rowEmail = mysqli_fetch_row($resultEmail);
			        if (!empty($rowEmail[0])){
			        	$error = "Курьер с таким email уже существует";
			        }
			        else{
					    $passwordHashed = md5($password).$salt;
						$queryChange = "UPDATE couriers SET name='$nameCourier', email='$loginCourier', password='$passwordHashed' WHERE id_courier = '$idCourier'";  
					    $resultChange = mysqli_query($dbLink, $queryChange) or die("Ошибка".mysqli_error($dbLink));
					    if ($resultChange){
					    	$success = "";
					    }    	
			        }
			    }
			}else{
				$error = "Пароль введен неверно";
			}
		}else{
			$error = "Email введен неверно";
		}
	}else{
		$error = "Неверное имя";
	}


	
}else{
	$error = "Пожалйста, заполните все поля";
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