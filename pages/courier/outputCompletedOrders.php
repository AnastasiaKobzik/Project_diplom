  <table class='table table-responsive-md table-hover'>
    <thead class='thead-dark'>
      <tr>
        <th scope='col'>№</th>
        <th scope='col'>Адрес</th>
        <th scope='col'>Дата и время доставки</th>
        <th scope='col'>Способ оплаты</th>
        <th scope='col'>Сумма</th>
        <th scope='col'>Статус заказа</th>
      </tr>
    </thead>
    <tbody>
  <?php
  include "../../db/dbConnect.php";
  $numberOrder=1;
  //вывод заказов ЗАРЕГИСТРИРОВАННЫХ польз-ей
  $query = "SELECT * FROM orders WHERE status_order=5";
  $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
  if($result){
    $rows = mysqli_num_rows($result); //кол-во строк
    for ($i = 0;$i < $rows; ++$i){
      $row = mysqli_fetch_row($result);
echo "<tr class='hoverMore'>
        <th scope='row'>$numberOrder</th>
        <td>$row[4]</td>
        <td>$row[3]<br>$row[10]</td>
        <td>$row[7]</td>
        <td>$row[5] р</td>
        <td>Заказ оплачен</td>";

  echo "<td class='moreOrdUser'>
          <input type='hidden' value='$row[0]' name='moreOrdUser' class='hiddenOrdUser'/>
          <input type='hidden' value='$numberOrder' name='numberOrder' class='numberOrder'/>
        </td>
      </tr>";
      $numberOrder++;
    }
  }
  //вывод заказов НЕ ЗАРЕГИСТРИРОВАННЫХ польз-ей
  $query1 = "SELECT * FROM ordersnouser  WHERE status=5";
  $result1 = mysqli_query($dbLink, $query1) or die("Ошибка БД");
  if($result1){
    $rows1 = mysqli_num_rows($result1); //кол-во строк
    for ($i = 0;$i < $rows1; ++$i){
      $row1 = mysqli_fetch_row($result1);
echo "<tr class='hoverMore'>
        <th scope='row'>$numberOrder</th>
        <td>$row1[9]</td>
        <td>$row1[10]<br>$row1[14]</td>
        <td>$row1[12]</td>
        <td>$row1[6] р</td>
        <td>Заказ оплачен</td>";
      
  echo "<td class='moreOrdNoUser'>
          <input type='hidden' value='$row1[0]' name='moreOrdNoUser' class='hiddenOrdNoUser'/>
          <input type='hidden' value='$numberOrder' name='numberOrderNoUser' class='numberOrderNoUser'/>
        </td>
      </tr>";
      $numberOrder++;
    }
  }
  mysqli_close($dbLink);
  ?>
  
    </tbody>
  </table>
<script type="text/javascript">

//Подробнее у заказа ЗАРЕГ-ГО польз-ля
  $('.moreOrdUser').on('click', function(){
    var id = this.querySelector('.hiddenOrdUser').value;
    var numbOrd = this.querySelector('.numberOrder').value;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.orders').html(this.response);
      }
    }
    request.open('GET','pages/courier/outputMoreOrder.php?id=' + id + '&numbOrd=' + numbOrd, true);
    request.send();
  });

//Подробнее у заказа НЕЗАРЕГ-ГО польз-ля
  $('.moreOrdNoUser').on('click', function(){
    var id = this.querySelector('.hiddenOrdNoUser').value;
    var numbOrd = this.querySelector('.numberOrderNoUser').value;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.orders').html(this.response);
      }
    }
    request.open('GET','pages/courier/outputMoreOrderNoUser.php?id=' + id + '&numbOrd=' + numbOrd, true);
    request.send();
  });
</script>