<?
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

?>

<div class='modal-dialog modal-dialog-centered' role='document'>
	<div class='modal-content'>
		<div class='modal-header' >
	      <button type='button' class='close' id="close1" data-dismiss='modal' aria-label='Close'>
	        <span aria-hidden='true'>&times;</span>
	      </button>
	    </div>
	    <div class='modal-body'>
			<form method='post' class='editReviewForm'>
			    <?php
			    include "../db/dbConnect.php";
			    $nameUser = $_SESSION["name"];
			    $idReview = $_GET['id'];
			    $query = "SELECT * FROM reviews WHERE id_review = '$idReview'";  
			    $result = mysqli_query($dbLink, $query) or die("Ошибка БД1");
					if ($result){
						$row = mysqli_fetch_row($result);
			  echo "<p>$nameUser</p>
			  		<hr>
				    <textarea name='review' maxlength='200'>$row[3]</textarea>
				    <input type='hidden' name='dateReview' id='dateReviewq' value=''>
				    <input type='hidden' name='idReview' id='idREview' value='$idReview'>
				    <span class='error'></span>";						
					}

					mysqli_close($dbLink);
			    ?>
			    
			    
			 </form>
	    </div>
	    <div class='modal-footer mx-auto butChange'>
	      <button type='button' class='btn editReview'>СОХРАНИТЬ ИЗМЕНЕНИЯ</button>
	    </div>
	</div>
</div>

<script type="text/javascript">
/*РЕДАКТИРОВАНИЕ ОТЗЫВА*/
  $('.editReview').on('click',  function(){
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
    
    $("#dateReviewq").val(today);
    sendAjaxChange('editReviewForm','pages/saveEditReview.php');
    return false;     
  });
  function sendAjaxChange(ajax_form, url) {
    $.ajax({
      url:     url, //url страницы (action_ajax_form.php)
      type:     "POST", //метод отправки
      dataType: "html", //формат данных
      data: $("."+ajax_form).serialize(),
      success: function(msg) { //Данные отправлены успешно
        var result = jQuery.parseJSON(msg);
        if (result.error == '') {
          $("#editReview").modal('hide');
          $("#saveEditReview").modal('show');
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