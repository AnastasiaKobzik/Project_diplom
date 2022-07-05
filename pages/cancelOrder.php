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
    $queryAllOrders = "DELETE FROM allorders WHERE id_order = '$idOrder'";
    $resultAllOrders=mysqli_query($dbLink, $queryAllOrders) or die("Ошибка".mysqli_error($dbLink));
    
    $queryOrders = "DELETE FROM orders WHERE id_order = '$idOrder'";
    $resultOrders=mysqli_query($dbLink, $queryOrders) or die("Ошибка".mysqli_error($dbLink));

    
    if($resultAllOrders && $resultOrders){
      echo "
      <div class='modal-body mx-auto'>
        <p>Заказ отменен</p>
      </div>
            
      <div class='modal-footer mx-auto' >
        <button type='button' class='btn' id='closeM'>ЗАКРЫТЬ</button>
      </div>";
    }  
    mysqli_close($dbLink);
    ?>
  </div>
</div>
<script type="text/javascript">
$('#closeM').on('click',function(){
  location.reload();
});

$('.close').on('click',function(){
  location.reload();
});
 

</script>

