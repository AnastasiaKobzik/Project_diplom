<?php
include "../../db/dbConnect.php";
$idCourier = $_GET['id'];
$queryCourierOrders = "SELECT * FROM courierorders WHERE id_courier = $idCourier";
$resultCourierOrders=mysqli_query($dbLink, $queryCourierOrders) or die("Ошибка".mysqli_error($dbLink));

$queryCourierOrdersNoUser = "SELECT * FROM courierordersnouser WHERE id_courier = $idCourier";
$resultCourierOrdersNoUser=mysqli_query($dbLink, $queryCourierOrdersNoUser) or die("Ошибка".mysqli_error($dbLink));

if($resultCourierOrders && $resultCourierOrdersNoUser){
    $rowsCourierOrders = mysqli_num_rows($resultCourierOrders); //кол-во строк
    $rowsCourierOrdersNoUser = mysqli_num_rows($resultCourierOrdersNoUser); //кол-во строк
    if($rowsCourierOrders > 0 || $rowsCourierOrdersNoUser > 0){
        $k=array();
        for ($i = 0;$i < $rowsCourierOrders; $i++){
            $rowCourierOrders = mysqli_fetch_row($resultCourierOrders);

            $queryStatusOrders = "SELECT status_order FROM orders WHERE id_order='$rowCourierOrders[1]'";
            $resultStatusOrders=mysqli_query($dbLink, $queryStatusOrders) or die("Ошибка".mysqli_error($dbLink));
            if($resultStatusOrders){
                $rowStatusOrders = mysqli_fetch_row($resultStatusOrders);
                if($rowStatusOrders[0]!=5){
                   array_push($k,$rowStatusOrders[0]);
                   
                }
            }
        }

        for ($i = 0;$i < $rowsCourierOrdersNoUser; $i++){
            $rowCourierOrdersNoUser = mysqli_fetch_row($resultCourierOrdersNoUser);

            $queryStatusOrdersNoUser = "SELECT status FROM ordersnouser WHERE id_order='$rowCourierOrdersNoUser[1]'";
            $resultStatusOrdersNoUser=mysqli_query($dbLink, $queryStatusOrdersNoUser) or die("Ошибка".mysqli_error($dbLink));
            if($resultStatusOrdersNoUser){
                $rowStatusOrdersNoUser = mysqli_fetch_row($resultStatusOrdersNoUser);
                if($rowStatusOrdersNoUser[0]!=5){
                   array_push($k,$rowStatusOrdersNoUser[0]);
                   
                }
            }
        }
        if(in_array(3,$k) || in_array(4,$k)){
            echo "Курьер не может быть удален так как за ним закреплён заказ.";
        }else{
            $query = "DELETE FROM couriers WHERE id_courier = '$idCourier'";
            $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
            if($result){
                echo "Курьер удален";
                }
        }
    }else{
        $query = "DELETE FROM couriers WHERE id_courier = '$idCourier'";
        $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
        if($result){
            echo "Курьер удален";
        }    
    }
        
        
    /*if($k != 0){
        $query = "DELETE FROM couriers WHERE id_courier = '$idCourier'";
        $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
        if($result){
            print "<script language='Javascript' type='text/javascript'>
                        alert('Курьер удален');
                        location.reload();
                    </script>";
        }
    }elseif($k==0){
        print "<script language='Javascript' type='text/javascript'>
                    alert('Курьер не может быть удален так как за ним закреплён заказ.');
                    location.reload();
                </script>";
    }*/
}


/**/

mysqli_close($dbLink);
?>