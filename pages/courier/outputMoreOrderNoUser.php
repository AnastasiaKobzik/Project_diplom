<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
 <table class="table table-responsive">
    <thead class="thead-light">
      <tr>
        <th scope="col">№</th>
        <th scope="col">Имя</th>
        <th scope="col">Номер телефона</th>
        <th scope="col">Адрес</th>
        <th scope="col">Дата и время доставки</th>
        <th scope="col">Способ оплаты</th>
        <th scope="col">Сумма</th>
        <th scope="col">Статус заказа</th>
        <th scope="col">Курьер</th>
      </tr>
    </thead>
<?php
echo "
<div class='buttonComeBack mb-3'>
    <button class='comeBack'>
        <svg xmlns='http://www.w3.org/2000/svg' width='40' height='20' fill='currentColor' class='bi bi-arrow-left' viewBox='0 0 16 16'>
          <path fill-rule='evenodd' d='M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z'/>
        </svg>
        Вернуться
    </button>
</div>";

include "../../db/dbConnect.php";
$idCourier = $_SESSION["id_courier"];
$idOrder = $_GET['id'];
$numbOrd = $_GET["numbOrd"];
$query = "SELECT * FROM ordersnouser WHERE ordersnouser.id_order = $idOrder";
$result = mysqli_query($dbLink, $query) or die("Ошибка БД");
if($result){
  $rows = mysqli_num_rows($result); //кол-во строк
  for ($i = 0;$i < $rows; ++$i){
    $row = mysqli_fetch_row($result);
    echo "
    <tbody>
      <tr>
        <th scope='row'>$numbOrd</th>
        <td>$row[7]</td>
        <td>$row[8]</td>
        <td>$row[9]</td>
        <td>$row[10]<br>$row[14]</td>
        <td>$row[12]</td>
        <td>$row[6] р</td>";
      if($row[13]==1){
  echo "<td>Заказ оформляется</td>
        <td>-</td>";        
      }elseif($row[13]==2){
  echo "<td>Заказ одобрен</td>
        <td>-</td>";
      }elseif($row[13]==3){
        $queryCourierName = "SELECT couriers.name FROM couriers,courierordersnouser WHERE courierordersnouser.id_order = $row[0] AND courierordersnouser.id_courier=couriers.id_courier";
      $resultCourierName = mysqli_query($dbLink, $queryCourierName) or die("Ошибка БД");
      if ($resultCourierName) {
        $rowCourierName = mysqli_fetch_row($resultCourierName);
  echo "<td>Курьер забрал заказ</td>
        <td>$rowCourierName[0]</td>";
      }

      }elseif($row[13]==4){
        $queryCourierName = "SELECT couriers.name FROM couriers,courierordersnouser WHERE courierordersnouser.id_order = $row[0] AND courierordersnouser.id_courier=couriers.id_courier";
      $resultCourierName = mysqli_query($dbLink, $queryCourierName) or die("Ошибка БД");
      if ($resultCourierName) {
        $rowCourierName = mysqli_fetch_row($resultCourierName);
  echo "<td>Курьер доставил заказ</td>
        <td>$rowCourierName[0]</td>";
      }

      }elseif($row[13]==5){
  echo "<td>Заказ оплачен</td>
        <td>-</td>";
      }
      
  echo "</tr>    
    </tbody>";
  
    if($row[13]==2){
  echo"<tfoot>
        <tr><td colspan='9' style='text-align: right;'><button type='button' class='btn btn-dark accOrdNoUser' value='$idOrder'>Забрать</button></td></tr>
      </tfoot>";      
    }elseif($row[13]==3){
      $queryCourierId = "SELECT couriers.id_courier FROM couriers,courierordersnouser WHERE courierordersnouser.id_order = $row[0] AND courierordersnouser.id_courier=couriers.id_courier";
      $resultCourierId = mysqli_query($dbLink, $queryCourierId) or die("Ошибка БД");
      if ($resultCourierId){
        $rowCourierId = mysqli_fetch_row($resultCourierId);
        if ($rowCourierId[0] == $idCourier){
        echo"<tfoot>
              <tr><td colspan='9' style='text-align: right;'><button type='button' class='btn btn-dark deliOrdNoUser' value='$idOrder'>Доставлено</button></td></tr>
            </tfoot>";
        }
      }
        
    }elseif($row[13]==4){
      $queryCourierId = "SELECT couriers.id_courier FROM couriers,courierordersnouser WHERE courierordersnouser.id_order = $row[0] AND courierordersnouser.id_courier=couriers.id_courier";
      $resultCourierId = mysqli_query($dbLink, $queryCourierId) or die("Ошибка БД");
      if ($resultCourierId){
        $rowCourierId = mysqli_fetch_row($resultCourierId);
        if ($rowCourierId[0] == $idCourier){
        echo"<tfoot>
              <tr><td colspan='9' style='text-align: right;'><button type='button' class='btn btn-dark paidOrdNoUser' value='$idOrder'>Оплачено</button></td></tr>
            </tfoot>";             
        }
      }
    }
  }
}
mysqli_close($dbLink);
?>  
  </table>
<script src="js/courier/indexCourier.js"></script><!-- 
<script src="js/courier/outputMoreOrderNoUser.js"></script> -->