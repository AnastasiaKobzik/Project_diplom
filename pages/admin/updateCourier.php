<?php
include "../../db/dbConnect.php";
$idCourier = $_GET['id'];
$n = $_GET['n'];
$query = "SELECT * FROM couriers WHERE id_courier=$idCourier";
$result = mysqli_query($dbLink, $query) or die("Ошибка БД");
if($result){
  $row = mysqli_fetch_row($result);
    echo "<form class='bord' id='bordForm$n'>
            <div class='displRow'>
              <p>$n</p>
              <div class='displCol'>
                <label>Имя:</label>
                <input type='hidden' name='id' value='$row[0]'></input>
                <input type='text' class='form-control' name='nameCourier' value='$row[1]'>
                <label class='mt-2'>Логин:</label>
                <input type='email' class='form-control' name='loginCourier' value='$row[2]'>
                <label class='mt-2'>Пароль:</label>
                <input type='password' name='password' class='form-control' placeholder='Введите пароль'>
                <span class='error'></span>
                <div class='displRow'>
                  <button type='button' name='butDontSaveCourier' class='btn mt-4 mr-3 butNo butDontSaveCourier'>ОТМЕНА</button>
                  <button type='button' name='butSaveCourier' class='btn mt-4 butSaveCourier' value='$row[0]'>СОХРАНИТЬ ИЗМЕНЕНИЯ</button>
                </div>
              </div> 
            </div>
          </form>";
}
mysqli_close($dbLink);
?>
<script type="text/javascript">
$('.butDontSaveCourier').on('click', function(){
  location.reload();
});

/*ИЗМЕНЕНИЕ КУРЬЕРА*/
  $('.butSaveCourier').on('click', function(){
    var id = this.value;
    var idform = 'bordForm'+id;
    
    sendAjaxUpdateCourier(idform,'pages/admin/updateCourierInBd.php');
    return false; 
  });
  function sendAjaxUpdateCourier(ajax_form, url) {
    $.ajax({
      url:     url, //url страницы (action_ajax_form.php)
      type:     "POST", //метод отправки
      dataType: "html", //формат данных
      data: $('#'+ajax_form).serialize(),
      success: function(msg) { //Данные отправлены успешно
        var result = jQuery.parseJSON(msg);
        if (result.error == '') {
            $("#editCourierModal").modal('show');
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


</script>