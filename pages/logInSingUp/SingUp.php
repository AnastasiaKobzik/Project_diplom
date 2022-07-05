
<div class="modal-dialog modal-dialog-centered " role="document">
  <div class="modal-content">
    <div class="modal-header" >
      <button type="button" class="close back" data-toggle='modal' data-dismiss="modal" data-target='#butAuthModal' aria-label="Back">
        <!-- <span aria-hidden="true">&larr;</span> -->
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
      </button>
      <button type="button" class="close" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body mx-auto">
      <form method="post" class="formSingUp" id="ajax_formSingUp" novalidate>
        
        <lable for='name' class='mb-1'>Введите имя:</lable>
        <input type="text" name="name" class="form-control" id="name" required>
        <div class="invalid-feedback">Пожалуйста, введите Имя.</div>
        
        <lable for='email' class='mb-1'>Введите e-mail:</lable>
        <input type="email" name="email" class="form-control" id="email" required>
        <div class="invalid-feedback">Email должен содержать символ "@"</div>

        <lable for='phone' class='mb-1'>Введите номер телефона:</lable>
        <input type="text" name="phone" class="form-control" id="phone" placeholder="+ 375*********" required>
        <div class="invalid-feedback">Пожалуйста, введите номер телефона</div>

        <lable for='password' class='mb-1'>Введите пароль:</lable>
        <input type="password" name="password" class="form-control" id="password" required>
        <div class="invalid-feedback">Пожалуйста, введите пароль</div>

        <lable for='passwordRepeat' class='mb-1'>Повторите пароль:</lable>
        <input type="password" name="passwordRepeat" class="form-control" id="passwordRepeat" required>
        <div class="invalid-feedback" class='mb-1'>Пожалуйста, повторите пароль</div>

        <span class="error" style="width: 250px;"></span>
        <input type="submit" name="submit" class="btn btnSingUp" value="ЗАРЕГИСТРИРОВАТЬСЯ">
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
$('.rel').on('click',  function(){
  location.reload();     
});
$('.btnSingUp').on('click',  function(){
    sendAjaxFormSingUp('ajax_formSingUp', 'pages/logInSingUp/SingUpBd.php');
    return false;     
});
 
function sendAjaxFormSingUp(ajax_form, url) {
  $.ajax({
    url:     url, //url страницы (action_ajax_form.php)
    type:     "POST", //метод отправки
    dataType: "html", //формат данных
    data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
    success: function(msg) { //Данные отправлены успешно
      var result = jQuery.parseJSON(msg);
      if (result.error == '') {
        $('#SingUpModal').modal('hide');
        $('#successReg').modal('show');
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