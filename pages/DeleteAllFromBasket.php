<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
global $dbLink;
?>
<div class='modal-dialog modal-dialog-centered' role='document'>
  <div class='modal-content'>
    <div class='modal-header' >
      <button type='button' class='close' id="close1" data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>
    <?php
    
    include "../db/dbConnect.php";
    $idUser = $_SESSION['id_user'];
    
    $query1 = "DELETE FROM basket WHERE id_user = '$idUser' AND in_stock=1";
    $result1=mysqli_query($dbLink, $query1) or die("Ошибка".mysqli_error($dbLink));
    if($result1){
      echo "
      <div class='modal-body mx-auto'>
        <p>Корзина очищена</p>
      </div>
            
      <div class='modal-footer mx-auto' >
        <button type='button' class='btn' id='close' data-dismiss='modal'>ЗАКРЫТЬ</button>
      </div>";
    } 
    mysqli_close($dbLink);
    ?>
  </div>
</div>
<script type="text/javascript">

$('.close').on('click', function(){
  location.reload();
});

$('#close').on('click',function(){
  location.reload();
});
 

</script>