<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Все товары</title>

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/admin/styleIndexAdmin.css">
    

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Oswald:wght@300&display=swap" rel="stylesheet">

    <!-- SLICK SLIDER -->
    <link rel="stylesheet" type="text/css" href="libs/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="libs/slick/slick-theme.css"/>

    <!-- ICONS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  </head>
  <body>
 <?php
  include("pages/head-footer/header.php");
  ?>

  

  <div class="container mt-5">
    <div class="headingSearch row">
      <div class="headingPage col-5">ВСЕ ТОВАРЫ</div>
      <form class="form-inline my-2 my-lg-0 col-7">
        <input class="form-control mr-2" type="search" placeholder="Поиск" aria-label="Search" name="search">
        <button class="btn btn-outline-success my-2 my-sm-0 search" type="button">Искать</button>
      </form>
    </div>

    <div class='dispRowCategory row'>
      <div class='categories'>
        <button class='typeCategory all' value='Все'>Все</button>
        <button class='typeCategory cakes' value='Торты'>Торты</button>
        <button class='typeCategory cheescakes' value='Чизкейки'>Чизкейки</button>
        <button class='typeCategory pastries' value='Пирожные'>Пирожные</button>
        <button class='typeCategory cupcakes' value='Капкейки'>Капкейки</button>  
      </div>
      <button class='addProduct mt-3 mt-lg-0' type="button" data-toggle='modal' data-target='#addProduct'>ДОБАВИТЬ ТОВАР</button>
    </div>

    <div class="fff">
    
<?php
include "db/dbConnect.php";
echo "<div class='slick-slider'>";
  $query = "SELECT * FROM product";
  $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
  if($result){
    $rows = mysqli_num_rows($result); //кол-во строк
    for ($i = 0;$i < $rows; ++$i) {
      $row = mysqli_fetch_row($result);//извл-ся отд-ая строка
      $imgEncode = base64_encode( $row[3] );
      $idProd = $row[0];
      echo "
      <div class='slide'>
        <form method='post' class='hiddenId'>
          <a href='#'>
            <img src='data:image/jpg;base64, $imgEncode' alt='$row[1]'>
            <p>$row[1]</p>";
            if ($row[5]!=1) {
      echo "<p style='font-weight: 600;'>$row[4]р/шт</p>";        
            }else{
      echo "<p style='font-weight: 600;'>$row[4]р/кг</p>";        
            }
      echo "<button type='button' class='slider-hover' value='$row[0]'>ОТКРЫТЬ</button>
          </a>
        </form>
      </div>";
    }
  } 

mysqli_close($dbLink);
echo "</div>
<div class='arrowSlide'>
    <div class='prevArrow'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-left' viewBox='0 0 16 16'>
        <path fill-rule='evenodd' d='M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z'/>
      </svg>
    </div>
    <div class='nextArrow'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-right' viewBox='0 0 16 16'>
        <path fill-rule='evenodd' d='M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z'/>
      </svg>
    </div>
  </div>
";
?>
    </div>
  </div>

<div class="container mt-5">
  <div class="headingPage">ДОПОЛНИТЕЛЬНО</div>
  <div class='additionally'>
    <button class='fillingType' value='Начинка'>Начинки</button>
    <button class='formsDecorType' value='Формы_Украшения'>Формы / Украшения</button>
  </div>
  <div class="blokFilling">
    <div class="dispRowFilling">
      <p>В наличии:</p>
      <button class='addFilling mt-3 mt-md-0' type="button" data-toggle='modal' data-target='#addFilling'>ДОБАВИТЬ НАЧИНКУ</button>
    </div>
    <div class="row">
      <?php
      include "db/dbConnect.php";
      $query = "SELECT * FROM filling";
      $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
      if($result){
        $rows = mysqli_num_rows($result); //кол-во строк
        for ($i = 0;$i < $rows; $i++){
          $row = mysqli_fetch_row($result);
          $imgEncode = base64_encode($row[3]);
          echo "
          <div class='col-lg-6 row mb-4 filling'>
            <div class='nameEditDelete2 col-12 mb-3'>
              <p>$row[1]</p>
              <div>
                <button type='button' class='edFill' value='$row[0]'><img src='img/icon/edit.png' alt='редактировать'></button>
                <button type='button' class='delFill' value='$row[0]'><img src='img/icon/close.png' alt='удалить'></button>
              </div>
            </div>
            <div class='imgFilling col-12 col-sm-5'>
              <img src='data:image/jpg;base64, $imgEncode' alt='$row[1]'>
            </div>
            <div class='allDescr col-sm-7'>
              <div class='nameEditDelete mb-3'>
                <p>$row[1]</p>
                <div>
                  <button type='button' class='edFill' value='$row[0]'><img src='img/icon/edit.png' alt='редактировать'></button>
                  <button type='button' class='delFill' value='$row[0]'><img src='img/icon/close.png' alt='удалить'></button>
                </div>
              </div>
              <textarea class='textareaIndex'>$row[2]</textarea>
            </div>
          </div>";
        }
      }


      mysqli_close($dbLink);
      ?>
    </div>
  </div>
  <div class="blockFormDecor">
    
  </div>
</div>
<!-- <div class="container">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">Все</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="cakes-tab" data-toggle="tab" href="#cakes" role="tab" aria-controls="cakes" aria-selected="false">Торты</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="cheesecakes-tab" data-toggle="tab" href="#cheesecakes" role="tab" aria-controls="cheesecakes" aria-selected="false">Чизкейки</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pastries-tab" data-toggle="tab" href="#pastries" role="tab" aria-controls="pastries" aria-selected="false">Пирожные</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="cupcakes-tab" data-toggle="tab" href="#cupcakes" role="tab" aria-controls="cupcakes" aria-selected="false">Капкейки</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
      <p>Все</p>
    </div>
    <div class="tab-pane fade" id="cakes" role="tabpanel" aria-labelledby="cakes-tab">
      <p>Торты</p>
    </div>
    <div class="tab-pane fade" id="cheesecakes" role="tabpanel" aria-labelledby="cheesecakes-tab">

    </div>
    <div class="tab-pane fade" id="pastries" role="tabpanel" aria-labelledby="pastries-tab">

    </div>
    <div class="tab-pane fade" id="cupcakes" role="tabpanel" aria-labelledby="cupcakes-tab">

    </div>
  </div>  
</div> -->




<!-- ДОБАВЛЕНИЕ ТОВАРА -->
  <div class='modal fade' id='addProduct' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body addModal'>
          <form method="post" class="formAdd" id='formdata' enctype='multipart/form-data'>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Название: </label>
                <input type='text' maxlength="100" name='nameProduct' placeholder="Название" class='form-control'>
              </div>
              <div class="form-group col-md-4">
                <label>Цена&nbsp(р):</label>
                <input type='number' min="1" name='price' placeholder='Цена' class='form-control'></input>
              </div>
              <div class="form-group col-md-4">
                <label class="weightLabel">Вес&nbsp(кг):</label>
                <input type='number' min="1" name='weight' placeholder='1' class='form-control weightInp' disabled></input>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-7">
                <label>Описание:</label>
                <textarea maxlength='400' name='descr' class='form-control' placeholder="Описание"></textarea>
              </div>
              <div class="form-group col-md-5">
                <label>Форма:</label>
                <select class='form-control form' name='form'>
                  <?php
                  include "db/dbConnect.php";
                  $queryForm = "SELECT * FROM formcake";
                  $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД");
                  if($resultForm){
                    $rowsForm = mysqli_num_rows($resultForm); //кол-во строк
                    for ($i = 0;$i < $rowsForm; ++$i){
                      $rowForm = mysqli_fetch_row($resultForm);
                      echo "
                      <option value='$rowForm[0]'>$rowForm[1]</option>";
                    }
                  }
                  mysqli_close($dbLink);
                  ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label>Категория:</label>
                <select class='form-control category' name='category'>
                  <option value='1'>Торты</option>
                  <option value='2'>Пирожные</option>
                  <option value='5'>Чизкейки</option>
                  <option value='6'>Капкейки</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label>Начинка:</label>
                <select class='form-control filling' name='filling'>
                  <?php
                  include "db/dbConnect.php";
                  $queryFill = "SELECT * FROM filling";
                  $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД");
                  if($resultFill){
                    $rowsFill = mysqli_num_rows($resultFill); //кол-во строк
                    for ($i = 0;$i < $rowsFill; ++$i) {
                      $rowFill = mysqli_fetch_row($resultFill);
                      echo "
                      <option value='$rowFill[0]'>$rowFill[1]</option>";
                    }
                  }
                  mysqli_close($dbLink);
                  ?>
                </select>
              </div>
              <div class="form-group col-md-5">
                <label>Загрузить фото: </label>
                <input type='file' class='form-control-file' id="js-file">
              </div>
              <span class="error"></span>
            </div>    
            
            <div class="modal-footer" >
              <button type="button" class="noAdd" data-dismiss="modal">ОТМЕНА</button>
              <button type="button" class="btn submitPhotoClass">ДОБАВИТЬ ТОВАР</button>
            </div>  
          </form>
           
        </div>
        
      </div>
    </div>
  </div>


<!-- ПРОСМОТР ТОВАРА -->
  <div class='modal fade' id='viewProduct' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
          
        </div>
        
      </div>
    </div>
  </div>

<!-- ДОБАВЛЕНИЕ НАЧИНКИ -->
  <div class='modal fade' id='addFilling' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close addFillClose' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body addFillModal'>
          <form method='post' enctype='multipart/form-data' class='formAddFill' id='formAddFill'>
            <div class='row'>
              
                <div class='form-group mb-3 col-12'>
                  <label>Название: </label>
                  <input type='text' maxlength="50" name='nameFill' class='form-control' value=''>
                </div>
                <div class='form-group mb-3 col-12'>
                  <label>Описание:</label>
                  <textarea class='form-control textareaAddForm' maxlength="400" name='descr'></textarea>
                </div>
              
              <div class='form-group mb-3  col-12'>
                <label>Загрузить фото: </label>
                <input type='file' class='form-control-file' id='js_fileFill'>
              </div>
              <div class='form-group mb-3  col-12'>
                <label>Загрузить мини-фото: </label>
                <input type='file' class='form-control-file' id='js_fileMiniFill'>
              </div>
              <span class='error'></span>
            </div>
              
              
            <button type='button' class='submitAddFill btn mt-3'>ДОБАВИТЬ НАЧИНКУ</button>  
          </form>
        </div>
        
      </div>
    </div>
  </div>
<!-- РЕДАКТИРОВАНИЕ НАЧИНКИ -->
  <div class='modal fade' id='editFilling' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body editFillModalBody'>
          
        </div>
        
      </div>
    </div>
  </div>
<!-- РЕДАКТИРОВАНИЕ НАЧИНКИ ИЛИ ТОВАРА СОХРАНЕНО -->
  <div class='modal fade' id='saveEditFilling' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close closeSaveEditFill' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
          <p >Изменения сохранены</p>
        </div>
        
      </div>
    </div>
  </div>
<!-- УДАЛЕНИЕ НАЧИНКИ СОХРАНЕНО -->
  <div class='modal fade' id='deleteFilling' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close closeDeleteFill' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
          <p>Начинка удалена</p>
        </div>
        
      </div>
    </div>
  </div>


<?php
  include("pages/head-footer/footer.php");
  ?>
<script type="text/javascript">
/*ВЫВОД ПО КАТЕГОРИИ*/
  $('.typeCategory').on('click',  function(){
    var category = this;
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.fff').html(this.response);
      }
    }
    request.open('GET','pages/admin/outputProduct.php?category=' + category.value, true);
    request.send();
    
  });
/*ПРОСМОТР ТОВАРА*/
  $('.slider-hover').on('click',  function(){
    
    $("#viewProduct").modal('show');
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('#viewProduct').html(this.response);
      }
    }
    request.open('GET','pages/admin/viewProduct.php?idProduct=' + this.value, true);
    request.send();     
  });

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
   
/*ПОИСК*/
  $('.search').on('click',  function(){
    
    sendAjaxSearch('form-inline','pages/searchProduct.php');
    return false;     
  });
  function sendAjaxSearch(ajax_form, url) {
    $.ajax({
      url:     url, //url страницы (action_ajax_form.php)
      type:     "POST", //метод отправки
      dataType: "html", //формат данных
      data: $("."+ajax_form).serialize(),
      success: function(response) { //Данные отправлены успешно
        
        $('.fff').html(response);
      },
      error: function(response) { // Данные не отправлены
        alert("данные не отправлены");
      }
    });
  }
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
/*ДОБАВЛЕНИЕ ТОВАРА*/
  $('.submitPhotoClass').on('click', function(){
    if (window.FormData === undefined) {
      alert('В вашем браузере FormData не поддерживается')
    } else {
      var formData = new FormData(formdata);
      formData.append('file', $("#js-file")[0].files[0]);
   
      $.ajax({
        type: "POST",
        url: 'pages/admin/addProduct.php',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(msg){
          if (msg.error == '') {
            $('.addModal').html(msg.success);
            $('.error').css('display', 'none');
          } else {
            $('.error').css('display', 'block');
            $('.error').html(msg.error);
          }
        }
      });
    }
    /*alert('sdfgv');*/
  });
/*ДОБАВЛЕНИЕ НАЧИНКИ*/
  $('.submitAddFill').on('click', function(){
    if (window.FormData === undefined) {
      alert('В вашем браузере FormData не поддерживается')
    } else {
      var formData = new FormData(formAddFill);
      formData.append('file', $("#js_fileFill")[0].files[0]);
      formData.append('filem', $("#js_fileMiniFill")[0].files[0]);
   
      $.ajax({
        type: "POST",
        url: 'pages/admin/addFilling.php',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(msg){
          if (msg.error == '') {
            $('.addFillModal').html(msg.success);
            $('.error').css('display', 'none');
          } else {
            $('.error').html(msg.error);
            $('.error').css('display', 'block');
          }
        }
      });
    }
    /*alert('sdfgv');*/
  });
  $('.addFillClose').on('click', function(){
    location.reload();
  });
$('.close').on('click', function(){
  location.reload();
});
/*УДАЛЕНИЕ НАЧИНКИ*/
  $('.delFill').on('click', function(){
      var request = new XMLHttpRequest();
      request.onreadystatechange = function(){
        if((request.readyState==4) && (request.status==200)){
          $("#deleteFilling").modal('show');
          $("#deleteFilling .modal-body").html(this.response);
        }
      }
      request.open('GET','pages/admin/deleteFilling.php?id=' + this.value, true);
      request.send();
  });
$('.closeDeleteFill').on('click', function(){
  location.reload();
});
/*РЕДАКТИРОВАНИЕ НАЧИНКИ*/
  $('.edFill').on('click',  function(){

      var request = new XMLHttpRequest();
      request.onreadystatechange = function(){
        if((request.readyState==4) && (request.status==200)){
          $("#editFilling").modal('show');
          $('#editFilling').html(this.response);
        }
      }
      request.open('GET','pages/admin/editFilling.php?id=' + this.value, true);
      request.send();
  });

$('.closeSaveEditFill').on('click', function(){
  location.reload();
});
/*нажатие на ВСЕ */
  $('.all').on('click',  function(){
    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F');

    $('.cakes').css('text-decoration', 'none');
    $('.cakes').css('color', '#2C2C2C');
    $('.cheescakes').css('text-decoration', 'none');
    $('.cheescakes').css('color', '#2C2C2C');
    $('.pastries').css('text-decoration', 'none');
    $('.pastries').css('color', '#2C2C2C');
    $('.cupcakes').css('text-decoration', 'none');
    $('.cupcakes').css('color', '#2C2C2C');
    
  });
/*нажатие на ТОРТЫ */
  $('.cakes').on('click',  function(){
    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F');

    $('.all').css('text-decoration', 'none');
    $('.all').css('color', '#2C2C2C');
    $('.cheescakes').css('text-decoration', 'none');
    $('.cheescakes').css('color', '#2C2C2C');
    $('.pastries').css('text-decoration', 'none');
    $('.pastries').css('color', '#2C2C2C');
    $('.cupcakes').css('text-decoration', 'none');
    $('.cupcakes').css('color', '#2C2C2C');
    
  });
/*нажатие на ЧИЗКЕЙКИ */
  $('.cheescakes').on('click',  function(){
    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F');

    $('.all').css('text-decoration', 'none');
    $('.all').css('color', '#2C2C2C');
    $('.cakes').css('text-decoration', 'none');
    $('.cakes').css('color', '#2C2C2C');
    $('.pastries').css('text-decoration', 'none');
    $('.pastries').css('color', '#2C2C2C');
    $('.cupcakes').css('text-decoration', 'none');
    $('.cupcakes').css('color', '#2C2C2C');
    
  });
/*нажатие на ПИРОЖНЫЕ */
  $('.pastries').on('click',  function(){
    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F');

    $('.all').css('text-decoration', 'none');
    $('.all').css('color', '#2C2C2C');
    $('.cakes').css('text-decoration', 'none');
    $('.cakes').css('color', '#2C2C2C');
    $('.cheescakes').css('text-decoration', 'none');
    $('.cheescakes').css('color', '#2C2C2C');
    $('.cupcakes').css('text-decoration', 'none');
    $('.cupcakes').css('color', '#2C2C2C');
    
  });
/*нажатие на КАПКЕЙКИ */
  $('.cupcakes').on('click',  function(){
    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F');

    $('.all').css('text-decoration', 'none');
    $('.all').css('color', '#2C2C2C');
    $('.cakes').css('text-decoration', 'none');
    $('.cakes').css('color', '#2C2C2C');
    $('.cheescakes').css('text-decoration', 'none');
    $('.cheescakes').css('color', '#2C2C2C');
    $('.pastries').css('text-decoration', 'none');
    $('.pastries').css('color', '#2C2C2C');
    
  });


/*нажатие на НАЧИНКИ */
  $('.fillingType').on('click',  function(){
    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F');

    $('.formsDecorType').css('text-decoration', 'none');
    $('.formsDecorType').css('color', '#2C2C2C');
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.blokFilling').html(this.response);
      }
    }
    request.open('GET','pages/admin/outputFilling.php', true);
    request.send();
  });
/*нажатие на ФОРМЫ/УКРАШЕНИЯ */
  $('.formsDecorType').on('click',  function(){
    $(this).css('text-decoration', 'underline');
    $(this).css('color', '#D11F1F');

    $('.fillingType').css('text-decoration', 'none');
    $('.fillingType').css('color', '#2C2C2C');
    
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('.blokFilling').html(this.response);
      }
    }
    request.open('GET','pages/admin/outputFormDecor.php', true);
    request.send(); 
  });

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
            $('.error').css('display', 'none');
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
</script>

<!-- slick slider -->
<script src="js/slickSlider.js"></script>

<!-- библиотека jquery -->
<script src="libs/jquery-3.6.0.min.js"></script>
<script src="js/admin/adminIndex.js"></script>
<!-- подключить библиотеку Bootstrap (js файл) -->

<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
<!-- SLICK SLIDER -->
<script type="text/javascript" src="libs/slick/slick.min.js"></script>

  </body>
</html>