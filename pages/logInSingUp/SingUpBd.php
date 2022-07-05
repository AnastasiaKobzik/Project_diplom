<?php
include "../../db/dbConnect.php";

global $dbLink;
$nameRegEx = "/[А-Я]{1}[а-я]{2,}/u";
$phoneRegEx = "(\+375(25|29|33|34)([0-9]{3}([0-9]{2}){2}))";
$passwordRegEx = "/^[a-z0-9]{4,10}$/";
$emailRegEx = "/^[a-zA-Z0-9]{2,15}@[a-zA-Z0-9.]{2,15}$/";

$email = $_POST["email"];

$error = $success = '';
if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["phone"]) && !empty($_POST["password"]) && !empty($_POST["passwordRepeat"])){    
    if($_POST["password"] == $_POST["passwordRepeat"]){
        if (preg_match($nameRegEx, $_POST["name"])){
            if (preg_match($emailRegEx, $email)){
                if (preg_match($phoneRegEx, $_POST["phone"])){
                    if (preg_match($passwordRegEx, $_POST["password"])) {
                                       
                        $query = "SELECT users.name, admin.name, couriers.name FROM users, admin, couriers WHERE users.email = '$email' OR couriers.email='$email' OR admin.email='$email'";
                        $result = mysqli_query($dbLink, $query) or die("Ошибка запроса".mysqli_error($dbLink));
                        if ($result){
                            $row = mysqli_fetch_row($result);
                            if (!empty($row[0])){
                                $error = "Пользователь с таким email уже существует";
                            }else{
                                $passwordHashed = md5($_POST["password"]).$salt;
                                $name = $_POST["name"];
                                $phone = $_POST["phone"];
                                $query = "INSERT INTO users(name, email, password, phone, bonuses) VALUES('$name','$email','$passwordHashed','$phone','15')";
                                $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
                                if ($result){
                                    $query="SELECT * FROM users WHERE email='$email'";
                                    $rez = mysqli_query($dbLink, $query);
                                    if ($rez){
                                        $row = mysqli_fetch_assoc($rez);
                                        if (!empty($row["id_user"])){
                                            if(session_status()!=PHP_SESSION_ACTIVE) session_start();
                                            $_SESSION["name"] = $row["name"];            
                                            $_SESSION["login"] = $row["email"];                
                                            $_SESSION["id_user"] = $row["id_user"];                    
                                            mysqli_close($dbLink);
                                            $success = "fg";
                                        }
                                    }
                                }      
                            }
                        } 

                        
                    } else $error = "Неверный пароль (Может состоять из цифр и букв латинского алфавита длиною 4-10 символа)";
                } else $error = "Неверный номер телефона";                
            }else $error = "Неверный email";

        } else $error = "Имя введено неверно (Может состоять из букв русского алфавита длиною минимум 2 символа)";
    } else $error = "Пароли не совпадают";
} else $error = "Заполните все поля";

$data = array(
    'error'   => $error,
    'success' => $success,
);

echo json_encode($data);
exit();
?>
