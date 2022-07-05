    <div class="dispRowFilling">
      <p>В наличии:</p>
      <button class='addFilling mt-3 mt-md-0' type="button" data-toggle='modal' data-target='#addFilling'>ДОБАВИТЬ НАЧИНКУ</button>
    </div>
    <div class="row">
      <?php
      include "../../db/dbConnect.php";
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
<script type="text/javascript">

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
</script>