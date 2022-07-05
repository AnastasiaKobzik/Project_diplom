<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Курьеры</title>

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/admin/styleCouriers.css">
    

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Oswald:wght@300&display=swap" rel="stylesheet">

    <!-- ICONS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  </head>
  <body>
 <?php
  include("pages/head-footer/header.php");
  ?>

  

  <div class="container mt-5">
    <div class="headingPage">КУРЬЕРЫ</div>
    
    <div class='row'>
      <?php
      include "db/dbConnect.php";
      $query = "SELECT * FROM couriers";
      $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
      if($result){
        $rows = mysqli_num_rows($result); //кол-во строк
        for ($i = 0;$i < $rows; $i++){
          $row = mysqli_fetch_row($result);
          $n = $i+1;
    echo "<div class='col-md-6 col-xl-4 mb-4' id='bord$row[0]'>
            <form class='bord'>
              <div class='displRow'>
                <p>$n</p>
                <div class='displCol'>
                  <div class='displRow'>
                    <label class='mr-3'>Имя:</label>
                    <label> $row[1]</label>
                  </div>
                  <div class='displRow'>
                    <label class='mt-2 mr-3'>Логин:</label>
                    <p class='mt-2 log'> $row[2]</p>  
                  </div>
                  <div class='displRow'>
                    <label class='mt-2 mr-3'>Пароль:</label>
                    <label class='mt-2 '> ****</label> 
                  </div>
                  
                  <div class='displRow'>
                    <button type='button' name='butUpdateCourier' class='btn mt-3 mr-3 butNo butUpdateCourier' value='$row[0]'>ИЗМЕНИТЬ</button>
                    <button type='button' name='butDeleteCourier' class='btn mt-3 butNo butDeleteCourier' value='$row[0]'>УДАЛИТЬ</button>
                  </div>
                </div> 
              </div>
            </form>
          </div>";
        }
      }
      mysqli_close($dbLink);
      ?>
      



    </div>
    <div class="butAdd mt-5">
      <button type='button' class='btn' data-toggle='modal' data-target='#addCourier'>ДОБАВИТЬ КУРЬЕРА</button>
    </div>



    <!-- <div class="row grey">
      <div class='col-md-1'><p>№</p></div>
      <div class='col-md-2'><p>Имя</p></div>
      <div class='col-md-3'><p>Логин</p></div>
      <div class='col-md-2'><p>Пароль</p></div>
      <div class='col-md-2'></div>
      <div class='col-md-2'></div>
    </div>
    <div class="row lightGrey">
      <div class='col-md-1'><p>1</p></div>
      <div class='col-md-2'><p>Александр</p></div>
      <div class='col-md-3'><p>sashaCourier@gmail.com</p></div>
      <div class='col-md-2'><p>****</p></div>
      <div class='col-md-2'><button type='button' class='butGrey'>Изменить</button></div>
      <div class='col-md-2'><button type='button' class='butGrey'>Удалить</button></div>
      <hr color='#D9D9D9' width='95%'>
      <div class='col-md-1'><p>1</p></div>
      <div class='col-md-2'><p>Александр</p></div>
      <div class='col-md-3'><p>sashaCourier@gmail.com</p></div>
      <div class='col-md-2'><p>****</p></div>
      <div class='col-md-2'><button type='button' class='butGrey'>Изменить</button></div>
      <div class='col-md-2'><button type='button' class='butGrey'>Удалить</button></div>
    </div> -->
  </div>



    
    
  <div class='modal fade' id='addCourier' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body mx-auto'>
          <form method='post' class='formAdd'>
            <div class='displCol1'>
                <label>Имя:</label>
                <input type='text' class='form-control' name='nameCourier' placeholder='Введите имя'>
                <label class='mt-2'>Логин (email):</label>
                <input type='email' class='form-control' name='loginCourier' placeholder='Введите логин'>
                <label class='mt-2'>Пароль:</label>
                <input type="password" name='password' class='form-control' placeholder='Введите проль'>
                <span class='error'></span>
                <div class='displRow'>
                  <button type="button" name='butDontSaveCourier' class='btn mt-5 mr-3 butNo' data-dismiss="modal">ОТМЕНА</button>
                  <button type='button' name='butAddCourier' class='btn mt-5 butAddCourier'>ДОБАВИТЬ КУРЬЕРА</button>
                </div>
              </div> 
           
          </form>

          
        </div>
        
      </div>
    </div>
  </div>
<!-- Добавление курьера -->
  <div class='modal fade' id='addCourierModal' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          <button type='button' class='close closeAddCourier' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body mx-auto'>
          <p style="text-align: center;">Добавлен новый курьер.</p>
        </div>
              
        
      </div>
    </div>
  </div>
<!-- Редактирование курьера -->
  <div class='modal fade' id='editCourierModal' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          <button type='button' class='close closeAddCourier' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body mx-auto'>
          <p style="text-align: center;">Изменения сохранены.</p>
        </div>
      </div>
    </div>
  </div>
<!-- Удаление курьера -->
  <div class='modal fade' id='deleteCourierModal' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          <button type='button' class='close closeAddCourier' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body mx-auto'>
          <p style="text-align: center;"></p>
        </div>
      </div>
    </div>
  </div>
<?php
  include("pages/head-footer/footer.php");
  ?>
<script type="text/javascript">
$('.closeAddCourier').on('click', function(){
  location.reload();
});
/*ДОБАВЛЕНИЕ КУРЬЕРА*/
  $('.butAddCourier').on('click', function(){
    //alert("sdgb");
    sendAjaxAddCourier('formAdd','pages/admin/addCourierInBd.php');
    return false; 
  });
  function sendAjaxAddCourier(ajax_form, url) {
    $.ajax({
      url:     url, //url страницы (action_ajax_form.php)
      type:     "POST", //метод отправки
      dataType: "html", //формат данных
      data: $("."+ajax_form).serialize(),
      success: function(msg) { //Данные отправлены успешно
        var result = jQuery.parseJSON(msg);
        if (result.error == '') {
          $("#addCourier").modal('hide');
            $("#addCourierModal").modal('show');
            $('.error').css('display', 'none');
          } else {
          $('.error').css('display', 'block');
            $('.error').html(result.error);
          }
      },
      error: function(msg) { // Данные не отправлены
        alert("данные не отправлены");
      }
    });
  }
/*УДАЛЕНИЕ КУРЬЕРА*/
$('.butDeleteCourier').on('click', function(){
  var id = this;
  var request = new XMLHttpRequest();
  request.onreadystatechange = function(){
    if((request.readyState==4) && (request.status==200)){
      $('#deleteCourierModal').modal('show');
      $('#deleteCourierModal p').html(this.response);
    }
  }
  request.open('GET','pages/admin/deleteCourier.php?id=' + id.value, true);
  request.send();
});
/*ИЗМЕНЕНИЕ КУРЬЕРА*/
$('.butUpdateCourier').on('click', function(){
  var id = this;
  var classBord = 'bord'+id.value;
  
  var request = new XMLHttpRequest();
  request.onreadystatechange = function(){
    if((request.readyState==4) && (request.status==200)){    
      $('#'+classBord).html(this.response);
    }
  }
  request.open('GET','pages/admin/updateCourier.php?id=' + id.value+ '&n=' + id.value, true);
  request.send();
});

</script>
<!-- <script src="js/adminIndex.js"></script> -->


<!-- библиотека jquery -->
<script src="libs/jquery-3.6.0.min.js"></script>
<!-- подключить библиотеку Bootstrap (js файл) -->
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>

  </body>
</html>