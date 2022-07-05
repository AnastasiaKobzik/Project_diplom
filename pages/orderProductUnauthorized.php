<?php
include "../db/dbConnect.php";
global $dbLink;
$nameProd = $_POST['nameProduct'];
$formProd = $_POST['formProduct'];
$fillProd = $_POST['fillProduct'];
$weightProd = $_POST['weightProduct'];
$colProd = $_POST['colProduct'];
$priceProd = $_POST['priceProduct'];

$nameUser = $_POST['nameUser'];
$phoneUser = $_POST['phoneUser'];
$address = $_POST['address'];
$deliveryData = $_POST['deliveryData'];
$orderData = $_POST['orderData'];
$paymentType = $_POST['money'];
$timeOrder = $_POST['timeOrder'];

$phoneRegEx = "(\+375(25|29|33|34)([0-9]{3}([0-9]{2}){2}))";
$nameRegEx = "/[А-Я]{1}[а-я]{2,}/u";

$error = $success = '';

if(!empty($_POST['deliveryData'])  && $timeOrder !='none'){
	if(!empty($_POST['nameUser']) && !empty($_POST['phoneUser']) && !empty($_POST['address'])){
		if (!empty($paymentType)) {
			if(preg_match($nameRegEx, $_POST["nameUser"])){
				if(preg_match($phoneRegEx, $_POST["phoneUser"])){
					//если формы и начинки нет (т.е. это торт)
					if(!empty($_POST['formProduct']) && !empty($_POST['fillProduct'])){
						$query = "INSERT INTO ordersnouser(name_product, form_product, fill_product, weight, col_product, price_product, name_user, phone_user, address, delivery_date, order_date, payment_type, status,timeOrd) VALUES('$nameProd','$formProd','$fillProd','$weightProd','$colProd','$priceProd','$nameUser','$phoneUser','$address','$deliveryData','$orderData','$paymentType', '1', '$timeOrder')";
						$result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
						if ($result){
							$success = "";
						}
					}else{
						$query = "INSERT INTO ordersnouser(name_product, weight, col_product, price_product, name_user, phone_user, address, delivery_date, order_date, payment_type, status, timeOrd) VALUES('$nameProd','$weightProd','$colProd','$priceProd','$nameUser','$phoneUser','$address','$deliveryData','$orderData','$paymentType', '1', '$timeOrder')";
						$result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
						if ($result){
							$success = "";
						}
					}
				}else $error = "Номер телефона введен неверно";
			}else $error = "Имя введено неверно (Может состоять из букв русского алфавита длиною минимум 2 символа)";			
		}else $error = "Пожалуйста, выберите способ оплаты";
	}else{$error = "Пожалуйста, заполните все поля";}
}else{$error = "Пожалуйста, выберите дату и время доставки";}


$data = array(
    'error'   => $error,
    'success' => $success,
);
 
/*header('Content-Type: application/json');*/
echo json_encode($data);
exit();
mysqli_close($dbLink);  
?>