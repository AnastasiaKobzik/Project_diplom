<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
global $dbLink;
?>
<div class='modal-dialog modal-dialog-centered' role='document'>
  <div class='modal-content'>
    <div class='modal-header' >
      <button type='button' class='close' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>
    <?php
    
    include "../db/dbConnect.php";
    $idOrder = $_GET['id'];
    /*$queryAllOrders = "DELETE FROM allorders WHERE id_order = '$idOrder'";
    $resultAllOrders=mysqli_query($dbLink, $queryAllOrders) or die("Ошибка".mysqli_error($dbLink));*/
    
    $query = "UPDATE orders SET in_stock=0  WHERE id_order = '$idOrder'";
    $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));

    
    if($result){
      echo "
      <div class='modal-body mx-auto'>
        <p>Выбранный заказ удален из Вашего списка заказов</p>
      </div>
            
      <div class='modal-footer mx-auto' >
        <button type='button' class='btn' id='close' data-dismiss='modal'>ЗАКРЫТЬ</button>
      </div>";
      print "<script language='Javascript' type='text/javascript'>
             
             </script>";
    }  
    mysqli_close($dbLink);
    ?>
  </div>
</div>
<script type="text/javascript">
$('#close').on('click',function(){
  location.reload();
});

$('.close').on('click',function(){
  location.reload();
});
 

</script>

