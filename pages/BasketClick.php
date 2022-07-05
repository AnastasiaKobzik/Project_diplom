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
            <p>Чтобы добавить товар в корзину Вам необходимо зарегистрироваться или войти.</p>
            <p>Желаете войти или зарегистрироваться?</p>
          </div>
          
          <div class='modal-footer mx-auto' >
            <button type='button' class='btn' data-dismiss='modal' data-toggle='modal' data-dismiss='modal' data-target='#butAuthModal'>ДА</button>
            <button type='button' class='btn' data-dismiss='modal'>НЕТ</button>
          </div>";
        }elseif($_SESSION['name']!='' && $_SESSION["adminName"]=='' && $_SESSION["courierName"]==''){
          include "../db/dbConnect.php";
          $idProd = $_POST['hiddenId'];
          $idUser = $_SESSION['id_user'];
          $queryAll = "SELECT * FROM basket WHERE id_product = $idProd AND id_user = $idUser AND in_stock = 1";
          $resultAll=mysqli_query($dbLink, $queryAll) or die("Ошибка".mysqli_error($dbLink));
          $row = mysqli_fetch_row($resultAll);
          if(!$row){
            $query = "SELECT * FROM product WHERE id_product = $idProd";
            $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));
            $rowPr = mysqli_fetch_row($result);
            if($rowPr[5] == 1){
              $query = "INSERT INTO basket (id_product, id_user, weight, quantity, form, filling, price, id_decoration, in_stock) VALUES ('$rowPr[0]', '$idUser', '$rowPr[8]', '$rowPr[9]', '$rowPr[6]', '$rowPr[7]', '$rowPr[4]', null, 1)";
              $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));

              if($result){
                echo "
                <div class='modal-body mx-auto'>
                  <p>Товар добавлен в корзину</p>
                </div>
                
                <div class='modal-footer mx-auto' >
                  <button type='button' class='btn' onClick='inBasket();'>ПЕРЕЙТИ В КОРЗИНУ</button>
                  <button type='button' class='btn' data-dismiss='modal'>ЗАКРЫТЬ</button>
                </div>";
                
              }  
            }else{
              $query = "INSERT INTO basket (id_product, id_user, weight, quantity, price, id_decoration, in_stock) VALUES ('$rowPr[0]', '$idUser', '$rowPr[8]', '$rowPr[9]', '$rowPr[4]', null, 1)";
              $result=mysqli_query($dbLink, $query) or die("Ошибка".mysqli_error($dbLink));

              if($result){
                echo "
                <div class='modal-body mx-auto'>
                  <p>Товар добавлен в корзину</p>
                </div>
                
                <div class='modal-footer mx-auto' >
                  <button type='button' class='btn' onClick='inBasket();'>ПЕРЕЙТИ В КОРЗИНУ</button>
                  <button type='button' class='btn' data-dismiss='modal'>ЗАКРЫТЬ</button>
                </div>";
                
              }
            }
              
          }else{
            echo "
              <div class='modal-body mx-auto'>
                <p>Такой товар уже есть в корзине</p>
              </div>
              
              <div class='modal-footer mx-auto' >
                <button type='button' class='btn' onClick='inBasket();'>ПЕРЕЙТИ В КОРЗИНУ</button>
                <button type='button' class='btn' data-dismiss='modal'>ЗАКРЫТЬ</button>
              </div>";
              
          }mysqli_close($dbLink);
          
        }
?>
  </div>
</div>
<script type="text/javascript">

$('#close1').on('click', function(){
  $("#inLikeModal").modal('hide');
});

function inBasket(){
  location.href='basket.php';
}
 

</script>

