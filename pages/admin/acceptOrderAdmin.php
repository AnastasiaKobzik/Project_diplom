<?php
include "../../db/dbConnect.php";
$idOrder = $_GET['id'];

$queryChange = "UPDATE orders SET status_order='2' WHERE id_order = '$idOrder'";  
$resultChange = mysqli_query($dbLink, $queryChange) or die("Ошибка".mysqli_error($dbLink));
if ($resultChange){
	echo "
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          <button type='button' class='close' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body mx-auto'>
        	<p>Заказ принят</p>
        </div>
        
      </div>
    </div>";
}

mysqli_close($dbLink);
?>
<script type="text/javascript">
	$('.close').on('click', function(){
		location.reload();
	});
</script>