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
    
    include "../../db/dbConnect.php";
    $idProduct = $_GET['idProduct'];
    
    $query = "SELECT * FROM product WHERE id_product = $idProduct";  
    $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
    if($result){
      $row = mysqli_fetch_row($result);
      $imgEncode = base64_encode($row[3]);
      
echo "<div class='modal-body mx-auto'>
        <form method='post' class='editProduct row'>
        <p class='nameViewProd col-12'>$row[1]</p>
        <div class='col-md-5 mb-3 imgViewModalProd'>
            <img src='data:image/jpg;base64, $imgEncode' alt='$row[1]'>
        </div>
            <div class='descr mb-3 col-md-7'>
              <p>$row[1]</p>
              <p>$row[2]</p>
              <p>Цена: $row[4] р</p>";
      if ($row[5]==1) {
        $queryForm = "SELECT * FROM formcake WHERE id_formCake = $row[6]";  
        $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД");
        $rowForm = mysqli_fetch_row($resultForm);

        $queryFilling = "SELECT * FROM filling WHERE id_filling = $row[7]";  
        $resultFilling = mysqli_query($dbLink, $queryFilling) or die("Ошибка БД");
        $rowFilling = mysqli_fetch_row($resultFilling);   
        echo "<p>Форма: $rowForm[1]</p>
              <p>Начинка: $rowFilling[1]</p>";
      }
      $queryCategory = "SELECT * FROM category WHERE id_category = $row[5]";  
      $resultCategory = mysqli_query($dbLink, $queryCategory) or die("Ошибка БД");
      $rowCategory = mysqli_fetch_row($resultCategory);
   echo  "    <p>Категория: $rowCategory[1]</p>
            </div>
          
          <hr>
          
        </form>
      </div>
              
    <div class='modal-footer mx-auto butChange'>
      <button type='button' class='btn delete' value='$idProduct'>УДАЛИТЬ</button>
      <button type='button' class='btn editProduct' value='$idProduct'>РЕДАКТИРОВАТЬ</button>
    </div>";
    }
    mysqli_close($dbLink);
    ?>
  </div>
</div>


<!-- РЕДАКТИРОВАНИЕ ТОВАРА -->
<!--   <div class='modal fade' id='editProduct' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        
      </div>
    </div>
  </div> -->

<script type="text/javascript">
/*РЕДАКТИРОВАНИЕ ТОВАРА*/
  $('.editProduct').on('click',  function(){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('#viewProduct').html(this.response);
      }
    }
    request.open('GET','pages/admin/editProduct.php?idProduct=' + this.value, true);
    request.send();     
  });

/*УДАЛЕНИЕ ТОВАРА*/
  $('.delete').on('click',  function(){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('#viewProduct').html(this.response);
      }
    }
    request.open('GET','pages/admin/deleteProduct.php?idProduct=' + this.value, true);
    request.send();     
  });
$('.close').on('click', function(){
  location.reload();
});
</script>
<!-- <script src="js/admin/adminIndex.js"></script> -->