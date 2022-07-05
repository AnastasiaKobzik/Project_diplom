<?php
include "../../db/dbConnect.php";

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
                $passwordHashed = md5($password).$salt;
                $queryEmail = "SELECT * FROM couriers WHERE email = '$loginCourier'";
                $resultEmail = mysqli_query($dbLink, $queryEmail) or die("Ошибка запроса".mysqli_error($dbLink));
                if ($resultEmail){
                    $rowEmail = mysqli_fetch_row($resultEmail);
                    if (!empty($rowEmail[2])){
                        $error = "Курьер с таким email уже существует";
                    }else{
                        $query = "INSERT INTO couriers(name, email, password) VALUES('$nameCourier','$loginCourier','$passwordHashed')";
                        $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
                        if ($result){
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