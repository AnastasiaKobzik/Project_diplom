<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "../db/dbConnect.php";
$idUser = $_SESSION['id_user'];
$deliveryData = $_POST['deliveryData'];
$address = $_POST['address'];
$phoneUser = $_POST['phoneUser'];
$paymentMethod = $_POST['payment'];
$idOrder = $_POST['idOrder'];
$timeOrder = $_POST['timeOrder'];
$phoneRegEx = "(\+375(25|29|33|34)([0-9]{3}([0-9]{2}){2}))";

$error = $success = '';

if($deliveryData != null && $timeOrder !='none'){
  if($address!=null && $phoneUser!=null){
    if (preg_match($phoneRegEx, $phoneUser)){
      if($paymentMethod != null){
        $queryChange = "UPDATE orders SET data_delivery='$deliveryData', address='$address', phone='$phoneUser', payment_method='$paymentMethod',timeOrd='$timeOrder' WHERE id_order = $idOrder";  
        $resultChange = mysqli_query($dbLink, $queryChange) or die("Ошибка".mysqli_error($dbLink));
       
        if ($resultChange) {
          $success = "а";
        }
        
      }else{
        $error = "Пожалуйста, выберите способ оплаты";
      }      
    }else{
      $error = "Неверный номер телефона";
    }

  }else{
    $error = "Пожалуйста, заполните все поля";
  }
}else{
  $error = "Пожалуйста, выберите дату и время доставки";
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