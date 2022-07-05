    <div class='row'>
      <div class='col-sm-6 col-md-5 col-lg-4 col-xl-3 mr-sm-0 mr-md-5 mb-5 mb-sm-0'>
        <p class='nameFormDecor'>Украшения:</p>
        <div class="decorForm">
        <?php
        include "../../db/dbConnect.php";
        $queryDecor = "SELECT * FROM decoration";
        $resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД");
        if($resultDecor){
          $rowsDecor = mysqli_num_rows($resultDecor); //кол-во строк
          for ($i = 0;$i < $rowsDecor; ++$i) {
            $n=$i+1;
            $rowDecor = mysqli_fetch_row($resultDecor);
            echo "
            <form class='displRow decor$rowDecor[0]'>
              <label>$n. $rowDecor[1] - $rowDecor[2] р.</label>
              <div>
                <button type='button' class='editDecor' value='$rowDecor[0]'><img src='img/icon/edit.png' alt='редактировать'></button>
                <button type='button' class='deleteDecor' value='$rowDecor[0]'><img src='img/icon/close.png' alt='удалить'></button>  
              </div>
            </form>";
          }
        }
        mysqli_close($dbLink);
        ?>

          <button class='addDecor mt-3' type="button" data-toggle='modal' data-target='#addDecor'>ДОБАВИТЬ УКРАШЕНИЕ</button>
        </div>
      </div>

      <div class='col-sm-6 col-md-4 col-lg-3 ml-sm-0 ml-md-5'>
        <p class='nameFormDecor'>Формы:</p>
        <div class='formForm'>
        <?php
        include "../../db/dbConnect.php";
        $queryForm = "SELECT * FROM formcake";
        $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД");
        if($resultForm){
          $rowsForm = mysqli_num_rows($resultForm); //кол-во строк
          for ($i = 0;$i < $rowsForm; ++$i) {
            $n=$i+1;
            $rowForm = mysqli_fetch_row($resultForm);
            echo "
           <form class='displRow form$rowForm[0]'>
            <label>$n. $rowForm[1]</label>
            <div>
              <button type='button' class='editForm' value='$rowForm[0]'><img src='img/icon/edit.png' alt='редактировать'></button>
              <button type='button' class='deleteForm' value='$rowForm[0]'><img src='img/icon/close.png' alt='удалить'></button>  
            </div>
          </form>
          ";
          }
        }
        mysqli_close($dbLink);
        ?>
          <button class='addForm mt-3' type='button' data-toggle='modal' data-target='#addForm'>ДОБАВИТЬ ФОРМУ</button>
        </div>

      </div>
    </div>
<!-- ДОБАВЛЕНИЕ ДЕКОРА -->
  <div class='modal fade' id='addDecor' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close addDecorClose' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body addDecorModal'>
          <form class="formAddDecor" id="formAddDecorid"  method='post'>
            <div class='form-group mb-3'>
              <label>Название: </label>
              <input type='text' maxlength="100" name='nameDecor' class='form-control'>
            </div>
            <div class='form-group mb-3'>
              <label>Цена (р):</label>
              <input type='number' min="1" name='priceDecor' class='form-control'>
            </div>
            <span class='error'></span>
            <button type='button' class='btn mt-3 subAddDecor'>ДОБАВИТЬ УКРАШЕНИЕ</button> 
                     
          </form>
        </div>
      </div>
    </div>
  </div>
<!-- ДОБАВЛЕНИЕ ФОРМЫ -->
  <div class='modal fade' id='addForm' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close addDecorClose' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body addFormModal'>
          <form class="formAddForm" id="formAddForm"  method='post'>
            <div class='form-group mb-3'>
              <label>Название: </label>
              <input type='text' maxlength="100" name='nameForm' class='form-control'>
            </div>
            <span class='error'></span>
            <button type='button' class='btn mt-3 subAddForm'>ДОБАВИТЬ ФОРМУ</button> 
                     
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- УДАЛЕНИЕ ДЕКОРА -->
  <div class='modal fade' id='deleteDecor' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close addDecorClose' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body mx-auto'>
          <p style="text-align: center;">Украшение удалено</p>
        </div>
        
      </div>
    </div>
  </div>
<!-- УДАЛЕНИЕ ФОРМЫ -->
  <div class='modal fade' id='deleteForm' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close addDecorClose' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body mx-auto'>
          <p style="text-align: center;">Форма удалена</p>
        </div>
        
      </div>
    </div>
  </div>
<script type="text/javascript">
/*РЕДАКТИРОВАНИЕ УКРАШЕНИЯ*/
  $('.editDecor').on('click',  function(){
    var id = this.value;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.decorForm').html(this.response);
      }
    }
    request.open('GET','pages/admin/editDecor.php?idDecor='+id, true);
    request.send(); 
  });
/*УДАЛЕНИЕ УКРАШЕНИЯ*/
  $('.deleteDecor').on('click',  function(){
    var id = this.value;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('#deleteDecor').modal('show');
        $('#deleteDecor .modal-body').html(this.response);
      }
    }
    request.open('GET','pages/admin/deleteDecor.php?idDecor='+id, true);
    request.send(); 
  });
/*ДОБАВИТЬ УКРАШЕНИЕ*/
  $('.subAddDecor').on('click',  function(){
    if (window.FormData === undefined) {
      alert('В вашем браузере FormData не поддерживается')
    } else {
      var formData = new FormData(formAddDecorid);
   
      $.ajax({
        type: "POST",
        url: 'pages/admin/addDecor.php',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(msg){
          if (msg.error == '') {
            $('.addDecorModal').html(msg.success);
            $('.error').css('display', 'NONE');
            
          } else {
            $('.error').css('display', 'block');
            $('.error').html(msg.error);
          }
        }
      });
    }
  });
  $('.addDecorClose').on('click', function(){
    location.reload();
  });
/*РЕДАКТИРОВАНИЕ ФОРМУ*/
  $('.editForm').on('click',  function(){
    var id = this.value;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.formForm').html(this.response);
      }
    }
    request.open('GET','pages/admin/editForm.php?idForm='+id, true);
    request.send(); 
  });
/*УДАЛЕНИЕ ФОРМЫ*/
  $('.deleteForm').on('click',  function(){
    var id = this.value;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('#deleteForm').modal('show');
        $('#deleteForm .modal-body').html(this.response);
      }
    }
    request.open('GET','pages/admin/deleteForm.php?idForm='+id, true);
    request.send(); 
  });
/*ДОБАВИТЬ ФОРМУ*/
  $('.subAddForm').on('click',  function(){
    if (window.FormData === undefined) {
      alert('В вашем браузере FormData не поддерживается')
    } else {
      var formData = new FormData(formAddForm);
   
      $.ajax({
        type: "POST",
        url: 'pages/admin/addForm.php',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(msg){
          if (msg.error == '') {
            $('.addFormModal').html(msg.success);
            $('.error').css('display', 'none');
            
          } else {
            $('.error').css('display', 'block');
            $('.error').html(msg.error);
          }
        }
      });
    }
  });
</script>
<!-- <script src="js/admin/adminIndex.js"></script> -->