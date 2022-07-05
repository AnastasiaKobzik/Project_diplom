<div class='modal-dialog modal-dialog-centered' role='document'>
  <div class='modal-content'>
    <div class='modal-header' >
      <button type='button' class='close' id="close1" aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>
    <?php
    include "../../db/dbConnect.php";
    $idProd = $_GET['idProduct'];
    $query = "DELETE FROM product WHERE id_product = '$idProd'";
    $result=mysqli_query($dbLink, $query);
    if($result){
      echo "
      <div class='modal-body mx-auto'>
        <p style='text-align: center;'>Товар удален </p>
      </div>
            
      <div class='modal-footer mx-auto' >
        <button type='button' class='btn' id='close'>ЗАКРЫТЬ</button>
      </div>";
              
    }else{
      echo "
      <div class='modal-body mx-auto'>
        <p style='text-align: center;'>К сожалению, на данный момент вы не можете удалить этот товар. Попробуйте позже.</p>
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
$('#close').on('click', function(){
  
  location.reload();
});
$('#close1').on('click', function(){
  
  location.reload();
});
</script>