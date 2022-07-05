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
        if ($_SESSION['name']=='' && $_SESSION["adminName"]=='' && $_SESSION["courierName"]==''){
          
          echo "
          <div class='modal-body mx-auto'>
            <p>Чтобы добавить товар в избранное Вам необходимо зарегистрироваться или войти.</p>
            <p>Желаете войти или зарегистрироваться?</p>
          </div>
          
          <div class='modal-footer mx-auto' >
            <button type='button' class='btn' data-dismiss='modal' data-toggle='modal' data-dismiss='modal' data-target='#butAuthModal'>ДА</button>
            <button type='button' class='btn' data-dismiss='modal'>НЕТ</button>
          </div>";
        }elseif($_SESSION['name']!='' && $_SESSION["adminName"]=='' && $_SESSION["courierName"]==''){
          include "../db/dbConnect.php";
          $idProd = $_GET['id'];
          $idUser = $_SESSION['id_user'];
          
            $query = "INSERT INTO favorites (id_product, id_user) VALUES ('$idProd', '$idUser')";
            $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
            if($result){
              echo "
              <div class='modal-body mx-auto'>
                <p>Товар добавлен в избранное</p>
              </div>
              
              <div class='modal-footer mx-auto' >
                <button type='button' class='btn' onClick='inLike();'>ПЕРЕЙТИ В ИЗБРАННОЕ</button>
                <button type='button' class='btn closeM'>ЗАКРЫТЬ</button>
              </div>";
              
            }  
          mysqli_close($dbLink);
          
        }
?>
  </div>
</div>

<script type="text/javascript">

$('#close1').on('click', function(){
  location.reload();
});
$('.closeM').on('click', function(){
  location.reload();
});

function inLike(){
  location.href='like.php';
}
 

</script>

