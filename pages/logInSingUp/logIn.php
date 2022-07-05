
<div class="modal-dialog modal-dialog-centered " role="document">
  <div class="modal-content">
    <div class="modal-header" >
      <button type="button" class="close back" data-toggle='modal' data-dismiss="modal" data-target='#butAuthModal' aria-label="Back">
        <!-- <span aria-hidden="true">&larr;</span> -->
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
      </button>
      <button type="button" class="close rel" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body mx-auto">
      <form method="post" class="formLogIn" id="ajax_formLogIn">
        <lable class='mb-1'>Введите логин (e-mail):</lable>
        <input type="email" name="email" class="form-control">
        <!-- <lable>Введите имя:</lable>
        <input type="text" name="name" class="form-control"> -->
        <lable class='mb-1'>Введите пароль:</lable>
        <input type="password" name="password" class="form-control">
        <span class="error"></span>
        <input type="submit" name="submitLogIn" class="btn btnLogIn" value="ВОЙТИ">
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
$('.rel').on('click',  function(){
  location.reload();     
});
  $('.btnLogIn').on('click',  function(){
    sendAjaxFormLogIn('ajax_formLogIn', 'pages/logInSingUp/logInBd.php');
    return false;     
});
 
function sendAjaxFormLogIn(ajax_form, url) {
  $.ajax({
    url:     url, //url страницы (action_ajax_form.php)
    type:     "POST", //метод отправки
    dataType: "html", //формат данных
    data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
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