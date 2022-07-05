
<?php
include "../../db/dbConnect.php";
$idDecor = $_GET['idDecor'];
$queryDecor = "SELECT * FROM decoration WHERE id_decoration = $idDecor";
$resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД");
if($resultDecor){
  $rowDecor = mysqli_fetch_row($resultDecor);
  echo "
        <form class='displRow decor$rowDecor[0]'>
        <input type='hidden' name='idDecor' value='$rowDecor[0]'>
          <label>Название:</label><input type='text' maxlength='100' name='nameDecor' class='form-control mb-2' value='$rowDecor[1]'>
          <label>Цена (р):</label><input type='number' min='1' name='priceDecor' class='form-control mb-3' value='$rowDecor[2]'>
          <span class='error'></span>
          <button type='button' class='saveEditDecor mt-2' value='$rowDecor[0]'>СОХРАНИТЬ</button> 
        </form>";
}
?>
<script type="text/javascript">
/*СОХРАНИТЬ РЕДАКТИРОВАНИЕ ДЕКОРА*/
  $('.saveEditDecor').on('click',  function(){
    var id = this.value;
    sendAjaxSaveEditDecor('decor'+id,'pages/admin/saveEditDecor.php');
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
