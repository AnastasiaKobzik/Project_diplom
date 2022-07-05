<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
global $dbLink;
?>
<div class='modal-dialog modal-dialog-centered' role='document'>
  <div class='modal-content'>
    <div class='modal-header' >
      <button type='button' class='close' id="close1" aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>
    <?php
    include "../db/dbConnect.php";
    $idProd = $_GET['id'];
    $idUser = $_SESSION['id_user'];
    $query = "DELETE FROM favorites WHERE id_product = '$idProd' AND id_user = '$idUser'";
    $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
    if($result){
      echo "
      <div class='modal-body mx-auto'>
        <p>Товар удален из избранного </p>
      </div>
            
      <div class='modal-footer mx-auto' >
        <button type='button' class='btn' id='close'>ЗАКРЫТЬ</button>
      </div>";
              
    }  
    mysqli_close($dbLink);
    ?>
  </div>
</div>
<script type="text/javascript">

$('#close1').on('click', function(){
  /*$("#deleteLikeModal").modal('hide');*/
  location.reload();
});
$('#close').on('click',function(){
  location.reload();
});

 

</script>

