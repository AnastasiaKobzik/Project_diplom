<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include "../db/dbConnect.php";
global $dbLink;

$idUser = $_SESSION['id_user'];
$orderData = $_POST['orderData'];
$deliveryData = $_POST['deliveryData'];
$address = $_POST['address'];
$price = $_POST['sumWithBonus'];
$phoneUser = $_POST['phoneUser'];
$paymentMethod = $_POST['payment'];
$idBasket = $_POST['idBasket'];
$writtenOffBonuses = $_POST['writtenOffBonuses'];
$timeOrder = $_POST['timeOrder'];

$phoneRegEx = "(\+375(25|29|33|34)([0-9]{3}([0-9]{2}){2}))";
$error = $success = '';
$colAccruedBonus=0;

if($deliveryData != null && $timeOrder !='none'){
  if($address!=null && $phoneUser!=null){
    if (preg_match($phoneRegEx, $phoneUser)) {
      if($paymentMethod != null){
        $query = "INSERT INTO orders(id_user, data_order, data_delivery, address, price, phone, payment_method, status_order, in_stock,timeOrd) VALUES('$idUser','$orderData','$deliveryData','$address','$price','$phoneUser','$paymentMethod','1',1, '$timeOrder')";
        $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));

        if ($result){
          $queryChangeUser = "UPDATE users SET bonuses=bonuses-$writtenOffBonuses WHERE id_user = $idUser";  
          $resultChangeUser = mysqli_query($dbLink, $queryChangeUser) or die("Ошибка1".mysqli_error($dbLink));

          $queryMaxId = "SELECT MAX(id_order) FROM orders";
          $resultMaxId = mysqli_query($dbLink, $queryMaxId) or die("Ошибка".mysqli_error($dbLink));
          if($resultMaxId){
            $rowMaxId = mysqli_fetch_row($resultMaxId);
            if($price>=60){
              $colAccruedBonus= $colAccruedBonus + 10;
              $queryAddBonuses = "UPDATE users SET bonuses=bonuses+10 WHERE id_user = $idUser";  
              $resultAddBonuses = mysqli_query($dbLink, $queryAddBonuses) or die("Ошибка1".mysqli_error($dbLink));
            }
            if(count($idBasket)>1){
              $N = count($idBasket);
              if ($N>=3) {
                $colAccruedBonus= $colAccruedBonus + 5;
                $queryAddBonuses = "UPDATE users SET bonuses=bonuses+5 WHERE id_user = $idUser";  
                $resultAddBonuses = mysqli_query($dbLink, $queryAddBonuses) or die("Ошибка1".mysqli_error($dbLink));
              }
              for ($i=0; $i < count($idBasket); $i++) { 
                $queryAll = "INSERT INTO allorders(id_order, id_basket) VALUES('$rowMaxId[0]','$idBasket[$i]')";
                $resultAll = mysqli_query($dbLink, $queryAll) or die("Ошибка".mysqli_error($dbLink));

                $query1 = "UPDATE basket SET in_stock=0 WHERE id_basket = '$idBasket[$i]' AND id_user = '$idUser'";
                $result1=mysqli_query($dbLink, $query1) or die("Ошибка".mysqli_error($dbLink));
              }
             $success = $colAccruedBonus;
            }else{
              $queryAll = "INSERT INTO allorders(id_order, id_basket) VALUES('$rowMaxId[0]','$idBasket[0]')";
              $resultAll = mysqli_query($dbLink, $queryAll) or die("Ошибка".mysqli_error($dbLink));
              
              $query1 = "UPDATE basket SET in_stock=0 WHERE id_basket = '$idBasket[0]' AND id_user = '$idUser'";
              $result1=mysqli_query($dbLink, $query1) or die("Ошибка".mysqli_error($dbLink));
              $success = $colAccruedBonus;
              
            }
          }
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
  $error = "Пожалуйста, выберите дату и время доставки ";
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