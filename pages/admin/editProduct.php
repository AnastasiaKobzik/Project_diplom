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
    
    include "../../db/dbConnect.php";
    $idProduct = $_GET['idProduct'];
    
    $query = "SELECT * FROM product WHERE id_product = $idProduct";  
    $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
    if($result){
      $row = mysqli_fetch_row($result);
      $imgEncode = base64_encode($row[3]);
echo "<div class='modal-body'>
        <form method='post' enctype='multipart/form-data' class='formEdit' id='formEditproductSave'>
        <div class='row mb-3'>
          <div class='col-md-5 imgEditModalProd mb-3'>
            <img src='data:image/jpg;base64, $imgEncode' alt='$row[1]'>
            <div>
              <label class='mt-3'>Загрузить фото: </label>
              <input type='file' class='form-control-file' id='jsFilePhotoEditProd'>
              <input type='hidden' value='$idProduct' name='idProduct'>
            </div>            
          </div>
          
          <div class='anyform col-md-7'>
            <div class='row mb-3'>
              <label class='col-4'>Название: </label>
              <input type='text' maxlength='100' name='nameProduct' value='$row[1]' class='form-control col'>
            </div>
            <div class='row mb-3'>
              <label class='col-4'>Описание:</label>
              <textarea maxlength='400' name='descr' class='form-control col'>$row[2]</textarea>
            </div>
            <div class='row mb-3'>
              <label class='col-4'>Цена&nbsp(р):</label>
              <input type='number' min='1' name='price' value='$row[4]' class='form-control col'></input>
            </div>
            <div class='row mb-3'>";
              if($row[5]==1){
        echo "<label class='col-4 weightLabel'>Вес&nbsp(кг):</label>
              <input type='number' min='0' name='weight' value='$row[8]' class='form-control col weightInp' disabled='true'></input>";
              }else{
        echo "<label class='col-4 weightLabel'>Вес&nbsp(г):</label>
              <input type='number' min='1' name='weight' value='$row[8]' class='form-control col weightInp'></input>";
              }

      echo "</div>
            <div class='row mb-3'>
              <label class='col-4'>Категория:</label>
              <select class='form-control category col' name='category'>";
      $queryCateg = "SELECT * FROM category WHERE id_category = '$row[5]'";
      $resultCateg = mysqli_query($dbLink, $queryCateg) or die("Ошибка БД");
      if($resultCateg){
        $rowCateg = mysqli_fetch_row($resultCateg);
          echo "<option value='$rowCateg[0]'>$rowCateg[1]</option>";
        $queryCategAll = "SELECT * FROM category WHERE id_category != '$row[5]'";
        $resultCategAll = mysqli_query($dbLink, $queryCategAll) or die("Ошибка БД");
        $rowsCategAll = mysqli_num_rows($resultCategAll); //кол-во строк
        for ($i = 0;$i < $rowsCategAll; ++$i){
          $rowCategAll = mysqli_fetch_row($resultCategAll);
          echo "<option value='$rowCategAll[0]'>$rowCategAll[1]</option>";
          
        }
      }
      echo "</select>
            </div>";
      if($row[5]==1){
        echo "
            <div class='row mb-3'>
              <label class='col-4'>Форма:</label>
              <select class='form-control form col' name='form'>";
              $queryForm = "SELECT * FROM formcake";
              $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД");
              if($resultForm){
                $rowsForm = mysqli_num_rows($resultForm); //кол-во строк
                for ($i = 0;$i < $rowsForm; ++$i){
                  $rowForm = mysqli_fetch_row($resultForm);
                  if ($rowForm[0] == $row[6]) {
          echo "<option selected value='$rowForm[0]'>$rowForm[1]</option>";
                  }else{
          echo "<option value='$rowForm[0]'>$rowForm[1]</option>";
                  }
                }
              }

        echo "</select>
            </div>
            <div class='row mb-3'>
              <label class='col-4'>Начинка:</label>
              <select class='form-control filling col' name='filling'>";
              $queryFill = "SELECT * FROM filling";
              $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД");
              if($resultFill){
                $rowsFill = mysqli_num_rows($resultFill); //кол-во строк
                for ($i = 0;$i < $rowsFill; ++$i) {
                  $rowFill = mysqli_fetch_row($resultFill);
                  if ($rowFill[0] == $row[7]) {
          echo "<option selected value='$rowFill[0]'>$rowFill[1]</option>";
                  }else{
          echo "<option value='$rowFill[0]'>$rowFill[1]</option>";
                  }
                }
              }

      echo "  </select>
            </div>";
      }else{
        echo "
            <div class='row mb-3'>
              <label class='col-4'>Форма:</label>
              <select class='form-control form col' disabled  name='form'>";
              $queryForm = "SELECT * FROM formcake";
              $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД");
              if($resultForm){
                $rowsForm = mysqli_num_rows($resultForm); //кол-во строк
                for ($i = 0;$i < $rowsForm; ++$i){
                  $rowForm = mysqli_fetch_row($resultForm);
          echo "<option value='$rowForm[0]'>$rowForm[1]</option>";
                }
              }

        echo "</select>
            </div>
            <div class='row mb-3'>
              <label class='col-4'>Начинка:</label>
              <select class='form-control filling col' disabled  name='filling'>";
              $queryFill = "SELECT * FROM filling";
              $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД");
              if($resultFill){
                $rowsFill = mysqli_num_rows($resultFill); //кол-во строк
                for ($i = 0;$i < $rowsFill; ++$i) {
                  $rowFill = mysqli_fetch_row($resultFill);
          echo "<option value='$rowFill[0]'>$rowFill[1]</option>";
                }
              }
        echo "</select>
            </div>";
      }      
      
     echo"</div>
        </div>
          <span class='error'></span>
        <button type='button' class='btn submitSaveEditProduct'>СОХРАНИТЬ ИЗМЕНЕНИЯ</button>  
        </form>
      </div>";
    }
    mysqli_close($dbLink);
    ?>
    
  </div>
</div>



<script type="text/javascript">
$('.category').on('change', function(){
  
  var value = this.value;
  if(value == 1){
    $('.form').prop('disabled', false);
    $('.filling').prop('disabled', false);
    $('.weightInp').prop('disabled', true);
    $('.weightInp').val(1);
    $('.weightLabel').html('Вес&nbsp(кг):');
  }else{
    $('.form').prop('disabled', true);
    $('.filling').prop('disabled', true);
    $('.weightInp').prop('disabled', false);
    $('.weightLabel').html('Вес&nbsp(г):');
  }

});
/*СОХРАНИТЬ РЕДАКТИРОВАНИЕ ТОВАРА*/
  $('.submitSaveEditProduct').on('click', function(){
    if (window.FormData === undefined) {
      alert('В вашем браузере FormData не поддерживается');
    } else {
      var formData = new FormData(formEditproductSave);
      formData.append('file', $("#jsFilePhotoEditProd")[0].files[0]);
   
      $.ajax({
        type: "POST",
        url: 'pages/admin/saveEditProduct.php',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(msg){
          if (msg.error == '') {
            $('#viewProduct').modal('hide');
            $('#saveEditFilling').modal('show');
            $('.error').css('display', 'none');
          } else {
            $('.error').css('display', 'block');
            $('.error').html(msg.error);
          }
        },
        error: function(response) { // Данные не отправлены
          alert("данные не отправлены");
        }
      });
    }
  }); 
$('.close').on('click', function(){
  location.reload();
});
</script>
<!-- <script src="js/admin/adminIndex.js"></script> -->
