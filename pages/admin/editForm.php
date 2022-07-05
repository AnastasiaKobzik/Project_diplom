
<?php
include "../../db/dbConnect.php";
$idForm = $_GET['idForm'];
$queryForm = "SELECT * FROM formcake WHERE id_formCake = $idForm";
$resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД");
if($resultForm){
  $rowForm = mysqli_fetch_row($resultForm);
  echo "
        <form class='displRow form$rowForm[0]'>
        <input type='hidden' name='idForm' value='$rowForm[0]'>
          <label>Название:</label><input type='text' maxlength='100' name='nameForm' class='form-control mb-3' value='$rowForm[1]'>
          <span class='error'></span>
          <button type='button' class='saveEditForm mt-2' value='$rowForm[0]'>СОХРАНИТЬ</button> 
        </form>";
}
?>
<script type="text/javascript">
/*СОХРАНИТЬ РЕДАКТИРОВАНИЕ ФОРМЫ*/
  $('.saveEditForm').on('click',  function(){
    var id = this.value;
    sendAjaxSaveEditDecor('form'+id,'pages/admin/saveEditForm.php');
    return false;
  });
  function sendAjaxSaveEditDecor(ajax_form, url) {
    $.ajax({
      url:     url, //url страницы (action_ajax_form.php)
      type:     "POST", //метод отправки
      dataType: "html", //формат данных
      data: $("."+ajax_form).serialize(),
      success: function(response) { //Данные отправлены успешно
        $('.error').css('display', 'block');
        $('.error').html(response);
      },
      error: function(response) { // Данные не отправлены
        alert("данные не отправлены");
      }
    });
  }
</script>