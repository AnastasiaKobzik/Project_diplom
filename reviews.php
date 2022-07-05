<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Отзывы</title>

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/styleReview.css">
    

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
<div class="container">
  <p class="headingPage">ОТЗЫВЫ</p>

  <div class='slick-slider'>
  <?php
  include "db/dbConnect.php";
  $query = "SELECT * FROM reviews";
  $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
  if($result){
    $rows = mysqli_num_rows($result); //кол-во строк
    if($rows == 0){
      echo "<p class='headingPage' style='text-align:center'>НЕТ ОТЗЫВОВ</p>";
    }
    for ($i = 0;$i < $rows; $i++){
      $row = mysqli_fetch_row($result);
      $queryNameUser = "SELECT * FROM users WHERE id_user = $row[1]";
      $resultNameUser = mysqli_query($dbLink, $queryNameUser) or die("Ошибка БД");
      $rowNameUser = mysqli_fetch_row($resultNameUser);
      echo "
      <div class='slide'>
        <form method='post' class='reviewForm'>";
        if($_SESSION['name']!=''&&$_SESSION['courierName']=='' && $_SESSION["adminName"]==''){
          if($_SESSION['id_user'] == $row[1]){
    echo "<div class='editAndDelete'>
            <button type='button' class='edit' value='$row[0]'><img src='img/icon/edit.png' alt='редактировать' title='редактировать'></button>
            <button type='button' class='delete' value='$row[0]'><img src='img/icon/close.png' alt='удалить' title='удалить'></button>
          </div>";        
          }
        }
    echo "<p class='nameInReview'>$rowNameUser[1]</p>
          <p>$row[3]</p>
          <p>$row[2]</p>
        </form>
      </div>";
    }
  }

  mysqli_close($dbLink);    
  ?>
  </div>

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
</div>
<?php
if ($_SESSION['name']!='' && $_SESSION["adminName"]=='' && $_SESSION["courierName"]==''){
  $nameUser = $_SESSION['name'];
  echo "
  <div class='container containerReview'>
    <p>Желаете оставить отзыв?</p>
    <form method='post' class='formReviewAdd mt-4'>
      <p>$nameUser</p>      
      <hr width='100%'>
      <textarea name='review' placeholder='Тут отзыв' maxlength='200'></textarea>
      <input type='hidden' name='dateReview' id='dateReview' value=''>
      <span class='error'></span>
      <button type='button' class='addReview mt-4'>ОТПРАВИТЬ ОТЗЫВ</button>
    </form>
  </div>";
}
?>


<!-- ADD REVIEW -->
  <div class='modal fade' id='addReview' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          <button type='button' class='close' onclick='reload();' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class="modal-body mx-auto">
          <p>Ваш отзыв сохранен.</p>
        </div>
        <div class='modal-footer mx-auto' >
          <button type='button' class='btn' onclick='reload();'>ЗАКРЫТЬ</button>
        </div>
      </div>
    </div>
  </div>

<!-- EDIT REVIEW -->
  <div class='modal fade' id='editReview' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          <button type='button' class='close' onclick='reload();' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
      </div>
    </div>
  </div>
<!-- SAVE EDIT REVIEW -->
  <div class='modal fade' id='saveEditReview' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          <button type='button' class='close' onclick='reload();' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class="modal-body mx-auto">
          <p>Изменения сохранены.</p>
        </div>
        <div class='modal-footer mx-auto' >
          <button type='button' class='btn' onclick='reload();'>ЗАКРЫТЬ</button>
        </div>
      </div>
    </div>
  </div>
<!-- DELETE REVIEW -->
  <div class='modal fade' id='deleteReview' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
          <p>Вы уверены, что хотите удалить отзыв?</p>
        </div>
        <div class='modal-footer mx-auto butChange'>
          <button type='button' class='btn deleteReviewz' value=''>ДА</button>
          <button type='button' class='btn' data-dismiss='modal'>НЕТ</button>
        </div>
      </div>
    </div>
  </div>
<!-- SAVE DELETE REVIEW -->
  <div class='modal fade' id='saveDeleteReview' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          <button type='button' class='close' onclick='reload();' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class="modal-body mx-auto">
          <p>Ваш отзыв удален</p>
        </div>
        <div class='modal-footer mx-auto' >
          <button type='button' class='btn' onclick='reload();'>ЗАКРЫТЬ</button>
        </div>
      </div>
    </div>
  </div>
<?php
  include("pages/head-footer/footer.php");
?>

<script type="text/javascript">
function reload(){
  location.reload();
}
/*УДАЛЕНИЕ ОТЗЫВА*/
$('.delete').on('click',  function(){
  $("#deleteReview").modal('show');
  var id = this.value;
  $('.deleteReviewz').on('click',  function(){
    var request = new XMLHttpRequest();
      request.onreadystatechange = function(){
        if((request.readyState==4) && (request.status==200)){
          $("#deleteReview").modal('hide');
          $('#saveDeleteReview').modal('show');
        }
      }
    request.open('GET','pages/deleteReview.php?id=' + id, true);
    request.send();
  });
});


/*РЕДАКТИРОВАНИЕ ОТЗЫВА*/
  $('.edit').on('click',  function(){

      var request = new XMLHttpRequest();
      request.onreadystatechange = function(){
        if((request.readyState==4) && (request.status==200)){
          $("#editReview").modal('show');
          $('#editReview').html(this.response);

        }
      }
      request.open('GET','pages/editReview.php?id=' + this.value, true);
      request.send();
  });
/*ОСТАВИТЬ ОТЗЫВ*/
  $('.addReview').on('click',  function(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
       dd = '0' + dd;
    }
    if (mm < 10) {
       mm = '0' + mm;
    } 
        
    today = yyyy + '-' + mm + '-' + dd;
    
    $("#dateReview").val(today);
    sendAjaxAddReview('formReviewAdd','pages/addReview.php');
    return false;     
  });
  function sendAjaxAddReview(ajax_form, url) {
    $.ajax({
      url:     url, //url страницы (action_ajax_form.php)
      type:     "POST", //метод отправки
      dataType: "html", //формат данных
      data: $("."+ajax_form).serialize(),
      success: function(msg) { //Данные отправлены успешно
        var result = jQuery.parseJSON(msg);
        if (result.error == '') {
          $("#addReview").modal('show');
          $('.error').css('display', 'none');
        } else {
          $('.error').css('display', 'block');
          $('.error').html(result.error);
        }
      },
      error: function(response) { // Данные не отправлены
        alert("данные не отправлены");
      }
    });
  } 
</script>
<!-- slick slider -->
<script src="js/slickSlider.js"></script>



<!-- библиотека jquery -->
<script src="libs/jquery-3.6.0.min.js"></script>

<!-- подключить библиотеку Bootstrap (js файл) -->
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.bundle.min.js"></script>
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>

<!-- SLICK SLIDER -->
<script type="text/javascript" src="libs/slick/slick.min.js"></script>
    
</body>
</html>