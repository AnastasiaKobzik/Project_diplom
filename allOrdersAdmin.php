<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Все заказы</title>

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/admin/styleOrdersAdmin.css">
    

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Oswald:wght@300&display=swap" rel="stylesheet">

    <!-- ICONS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  </head>
  <body>
 <?php
  include("pages/head-footer/header.php");
  ?>

  

  <div class="container mt-5">
    <div class="headingSearch">
      <div class="headingPage">ВСЕ ЗАКАЗЫ</div>
      <!-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Поиск по дате доставки" aria-label="Search" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0 search" type="button">Искать</button>
      </form> -->
    </div>
    <div class='ordersCategory'>
      <div class='categories'>
        <button class='typeCategory all' value='Все'>Все заказы</button>
        <button class='typeCategory unaccepted' value='unaccepted'>Непринятые заказы</button>
        <button class='typeCategory completed' value='completed'>Завершенные заказы</button>
      </div>
    </div>
  </div>



<div class='container orders'>
  <table class='table table-responsive-md table-hover'>
    <thead class='thead-dark'>
      <tr>
        <th scope='col'>№</th>
        <th scope='col'>Адрес</th>
        <th scope='col'>Дата и время доставки</th>
        <th scope='col'>Способ оплаты</th>
        <th scope='col'>Сумма</th>
        <th scope='col'>Статус заказа</th>
        <th scope='col'></th>
      </tr>
    </thead>
    <tbody>
  <?php
  include "db/dbConnect.php";
  $numberOrder=1;
  //вывод заказов ЗАРЕГИСТРИРОВАННЫХ польз-ей
  $query = "SELECT * FROM orders";
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
        <td>$row[5] р</td>";
      if($row[8]==1){
  echo "<td>Заказ оформляется</td>
        <td style='z-index:10;'><button type='button' class='btn btn-dark accOrdUser' value='$row[0]'>Принять</button></td>";        
      }elseif($row[8]==2){
  echo "<td colspan='2'>Заказ одобрен</td>";
      }elseif($row[8]==3){
  echo "<td colspan='2'>Курьер забрал заказ</td>";
      }elseif($row[8]==4){
  echo "<td colspan='2'>Курьер доставил заказ</td>";
      }elseif($row[8]==5){
  echo "<td colspan='2'>Заказ оплачен</td>";
      }

  echo "<td class='moreOrdUser'>
          <input type='hidden' value='$row[0]' name='moreOrdUser' class='hiddenOrdUser'/>
          <input type='hidden' value='$numberOrder' name='numberOrder' class='numberOrder'/>
        </td>
      </tr>";
      $numberOrder++;
    }
  }
  //вывод заказов НЕЗАРЕГИСТРИРОВАННЫХ польз-ей
  $query1 = "SELECT * FROM ordersnouser";
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
        <td>$row1[6] р</td>";
      if($row1[13]==1){
  echo "<td>Заказ оформляется</td>
        <td style='z-index:10;'><button type='button' class='btn btn-dark accOrdNoUser' value='$row1[0]'>Принять</button></td>";        
      }elseif($row1[13]==2){
  echo "<td colspan='2'>Заказ одобрен</td>";
      }elseif($row1[13]==3){
  echo "<td colspan='2'>Курьер забрал заказ</td>";
      }elseif($row1[13]==4){
  echo "<td colspan='2'>Курьер доставил заказ</td>";
      }elseif($row1[13]==5){
  echo "<td colspan='2'>Заказ оплачен</td>";
      }

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
</div>

<!-- МОДАЛЬНОЕ ОКНО -->
  <div class='modal fade' id='modalOk' tabindex='-1' role='dialog' aria-hidden='true'>
    
  </div>
<!--  -->
<?php
  include("pages/head-footer/footer.php");
  ?>
  
<script type="text/javascript">
/*----- НАЖАТИЕ НА ВСЕ ЗАКАЗЫ ------*/
  $('.all').on('click',  function(){
    $('.unaccepted').css('text-decoration', 'none');
    $('.unaccepted').css('color', '#2C2C2C');
    $('.completed').css('text-decoration', 'none');
    $('.completed').css('color', '#2C2C2C');

    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F');

    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.orders').html(this.response);
      }
    }
    request.open('GET','pages/admin/outputAllOrders.php', true);
    request.send();       
  });

/*----- НАЖАТИЕ НА НЕПРИНЯТЫЕ ЗАКАЗЫ ------*/
  $('.unaccepted').on('click',  function(){
    $('.all').css('text-decoration', 'none');
    $('.all').css('color', '#2C2C2C');
    $('.completed').css('text-decoration', 'none');
    $('.completed').css('color', '#2C2C2C');

    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F');

    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.orders').html(this.response);
      }
    }
    request.open('GET','pages/admin/outputUnacceptedOrders.php', true);
    request.send();    
  });
/*----- НАЖАТИЕ НА ЗАВЕРШЕННЫЕ ЗАКАЗЫ ------*/
  $('.completed').on('click',  function(){
    $('.all').css('text-decoration', 'none');
    $('.all').css('color', '#2C2C2C');
    $('.unaccepted').css('text-decoration', 'none');
    $('.unaccepted').css('color', '#2C2C2C');

    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F');

    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.orders').html(this.response);
      }
    }
    request.open('GET','pages/admin/outputCompletedOrders.php', true);
    request.send();    
  });
/*принять заказ ЗАРЕГ-ГО польз-ля*/
  $('.accOrdUser').on('click', function(){
    var idOrder = this;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('#modalOk').modal('show');
        $('#modalOk').html(this.response);
      }
    }
    request.open('GET','pages/admin/acceptOrderAdmin.php?id=' + idOrder.value, true);
    request.send(); 
  });
/*принять заказ НЕЗАРЕГ-ГО польз-ля*/
  $('.accOrdNoUser').on('click', function(){
    var idOrder = this;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('#modalOk').modal('show');
        $('#modalOk').html(this.response);
      }
    }
    request.open('GET','pages/admin/acceptOrderAdminNoUser.php?id=' + idOrder.value, true);
    request.send(); 
  });
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
    request.open('GET','pages/admin/outputMoreOrder.php?id=' + id + '&numbOrd=' + numbOrd, true);
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
    request.open('GET','pages/admin/outputMoreOrderNoUser.php?id=' + id + '&numbOrd=' + numbOrd, true);
    request.send();
  });
</script>

<!-- библиотека jquery -->
<script src="libs/jquery-3.6.0.min.js"></script>
<!-- подключить библиотеку Bootstrap (js файл) -->
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>

  </body>
</html>