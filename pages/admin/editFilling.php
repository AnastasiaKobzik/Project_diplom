<div class='modal-dialog modal-dialog-centered' role='document'>
	<div class='modal-content'>
		<div class='modal-header' >
	      <button type='button' class='close closeSaveEditFill' aria-label='Close'>
	        <span aria-hidden='true'>&times;</span>
	      </button>
	    </div>
	    <?php
		include "../../db/dbConnect.php";
		$idfilling = $_GET['id'];
		$query = "SELECT * FROM filling WHERE id_filling = '$idfilling'";  
		$result = mysqli_query($dbLink, $query) or die("Ошибка БД1");
		if ($result){
			$row = mysqli_fetch_row($result);
      		$imgEncode = base64_encode($row[3]);
echo "<div class='modal-body editFillModalBody'>
        <form method='post' enctype='multipart/form-data' class='formEdit' id='formEditFill'>
        <div class='row'>
        	<input type='hidden' value='$row[0]' name='idFill'>
          <div class='col-md-6 mb-3 imgEditModalFill'>
            <img src='data:image/jpg;base64, $imgEncode' alt='$row[1]'>
          </div>
        	<div class='allDescr mb-3 col-md-6'>
	        	<div class='form-group'>
	        		<label>Название: </label>
	            	<input type='text' maxlength='50' name='nameFill' class='form-control' value='$row[1]'>
	          	</div>
              	<div class='form-group'>
                	<label>Описание:</label>
                	<textarea class='form-control textareaForm' maxlength='400' name='descr'>$row[2]</textarea>
              	</div>
            </div>
            <div class='form-group col-md-6 mt-3 mt-md-0'>
                <label>Загрузить фото: </label>
	            <input type='file' class='form-control-file' id='js_fileEditFill'>
            </div>
            <div class='form-group col-md-6'>
                <label>Загрузить мини-фото: </label>
	            <input type='file' class='form-control-file' id='js_fileMiniEditFill'>
            </div>
            <span class='error'></span>
        </div>
          
          
        <button type='button' class='submitSaveEditFill btn mt-3'>СОХРАНИТЬ ИЗМЕНЕНИЯ</button>  
        </form>
      </div>";
	    }
	    mysqli_close($dbLink);
		?>
	</div>
</div>
<script type="text/javascript">
  $('.submitSaveEditFill').on('click', function(){
    if (window.FormData === undefined) {
      alert('В вашем браузере FormData не поддерживается')
    } else {
      var formData = new FormData(formEditFill);
      formData.append('file', $("#js_fileEditFill")[0].files[0]);
      formData.append('filem', $("#js_fileMiniEditFill")[0].files[0]);
   
      $.ajax({
        type: "POST",
        url: 'pages/admin/saveEditFilling.php',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(msg){
          if (msg.error == '') {
            $('#editFilling').modal('hide');
            $('#saveEditFilling').modal('show');
            $('.error').css('display', 'none');
          } else {
            $('.error').css('display', 'block');
            $('.error').html(msg.error);
          }
        }
      });
    }
  });
  $('.closeSaveEditFill').on('click', function(){
  	location.reload();
  });
</script>