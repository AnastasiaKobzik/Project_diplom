<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
global $dbLink;
?>
<div class='modal-dialog modal-dialog-centered' role='document'>
  <div class='modal-content'>
    <div class='modal-header' >
      <button type='button' class='close' id="close1" data-dismiss='modal' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>
    <?php
    
    include "../db/dbConnect.php";
    $idBasket = $_GET['id'];
    /*$idUser = $_SESSION['id_user'];*/
    $query = "SELECT * FROM basket WHERE id_basket = $idBasket";  
    $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
    if($result){
      $row = mysqli_fetch_row($result);
      $queryProd = "SELECT * FROM product WHERE id_product = $row[1]";
      $resultProd = mysqli_query($dbLink, $queryProd) or die("Ошибка БД");
      $rowProd = mysqli_fetch_row($resultProd);
      $imgEncode = base64_encode($rowProd[3]);
      echo "
      <div class='modal-body'>
      <form method='post' class='formChange row'>
        <input type='hidden' name='idBasket' value='$idBasket'>
        <input type='hidden' name='idProd' value='$row[1]'>
        <input type='hidden' name='idDecor' value='$row[8]' id='idDecor'>
        <input type='hidden' name='idFill' value='$row[6]' id='idFill'>
        <input type='hidden' name='idForm' value='$row[5]' id='idForm'>
        <p class='nameProd2 col-12 mb-3'>$rowProd[1]</p>
        <div class='col-sm-4 mb-3 mb-sm-0 photoImgChange'>
          <img src='data:image/jpg;base64, $imgEncode'alt='$rowProd[1]'>
        </div>
          
          <div class='nameAndCheckColumn col-sm-8'>
            <p class='nameProd mb-3'>$rowProd[1]</p>
            <p class='decorP mb-2'>Добавить в украшение: +<span id='priceDecor'>0</span>p.</p>
            
              <div class='row mb-3'>";
              $queryDecor = "SELECT * FROM decoration";
              $resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД");
              if($resultDecor){
                $rowsDecor = mysqli_num_rows($resultDecor); //кол-во строк
                for ($i = 0;$i < $rowsDecor; ++$i) {
                  $rowDecor = mysqli_fetch_row($resultDecor);
                  echo "
                  <div class='form-check col-6 col-md-4 mb-1'>
                    <input class='form-check-input radioDecor' type='radio' name='decor' id='$rowDecor[1]' value='$rowDecor[0]' onclick='foo(this)'>
                    <label class='form-check-label' for='$rowDecor[1]'>$rowDecor[1]</label>
                  </div>";
                }
              }

          echo"</div>";
        if($rowProd[5] == 1){
        echo "      
            <div class='priceAndColColumn row'>
              <div class='col-5 weightSlider'>
                <p>Вес:&nbsp&nbsp<input type='number' id='weightValue' placeholder='1' min='1' max='10'> кг</p>
                <div class='slidecontainer'>
                  <input type='range' min='1' max='10' value='$row[3]' class='slider' id='weight' name='weight'>
                </div>
              </div>
              <div class='col-7 '>
                <p>Количество: &nbsp<input type='number' id='colValue'  min='1' max='15' placeholder='1'> шт</p>
                <div class='slidecontainer'>
                  <input type='range' min='1' max='15' value='$row[4]' class='slider' id='col' name='col'>
                </div>
              </div>
            </div>";
      }else{
        echo "      
            <div class='priceAndColColumn row col-12'>
              <div>
                <p>Количество: &nbsp&nbsp<input type='number' id='colValue'  min='1' max='15' placeholder='1'> шт</p>
                <div class='slidecontainer'>
                  <input type='range' min='1' max='15' value='$row[4]' class='slider' id='col' name='col'>
                </div>
              </div>
            </div>
            <div class='mt-4 mt-md-4 col-sm-12 row summa'>
              <p>Общая сумма: <span id='sum'>$row[7]</span> р.</p>
              <input type='hidden' value='$row[7]' name='summa' id='sumInput'></input>
              <input type='hidden' value='$rowProd[4]' id='price'></input> 
            </div>";
      }
      echo " 
          </div>";
        if($rowProd[5] == 1){
        echo" 
              <div class='filling col-12 col-md-8 mt-4'>
                <p class='mb-2'>Выберите начинку:</p>
                <div class='row col-12 fillingBord'>";
                $queryFill = "SELECT * FROM filling";
                $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД");
                if($resultFill){
                  $rowsFill = mysqli_num_rows($resultFill); //кол-во строк
                  for ($i = 0;$i < $rowsFill; ++$i) {
                    $rowFill = mysqli_fetch_row($resultFill);
                    echo "
                    <div class='form-check col-6 mb-1'>
                      <input class='form-check-input radioFill' type='radio' name='filling' id='$rowFill[1]' value='$rowFill[0]'>
                      <label class='form-check-label' for='$rowFill[1]'>$rowFill[1]</label>
                    </div>";
                  }
                }

          echo" </div>           
              </div>

              <div class='form col-sm-7 col-md-4 mt-4 row'>  
                <p class='col-12 mb-2'>Выберите форму:</p>";
                $queryForm = "SELECT * FROM formcake";
                $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД");
                if($resultForm){
                  $rowsForm = mysqli_num_rows($resultForm); //кол-во строк
                  for ($i = 0;$i < $rowsForm; ++$i){
                    $rowForm = mysqli_fetch_row($resultForm);
                    echo "
                    <div class='form-check mb-1 col-6 col-sm-12'>
                      <input class='form-check-input radioForm' type='radio' name='form' id='$rowForm[1]' value='$rowForm[0]'>
                      <label class='form-check-label' for='$rowForm[1]'>$rowForm[1]</label>
                    </div>";
                  }
                }


          echo"</div>

        <div class='mt-sm-4 mt-md-4 col-sm-5 col-md-12 row summa mt-3'>
          <p>Общая сумма: <span id='sum'>$row[7]</span> р.</p>
          <input type='hidden' value='$row[7]' name='summa' id='sumInput'></input>
          <input type='hidden' value='$rowProd[4]' id='price'></input> 
        </div>";
      }  
   echo"
      </form>
      </div>
            
      <div class='modal-footer mx-auto butChange'>
        <button type='button' class='btn' data-dismiss='modal'>ОТМЕНА</button>
        <button type='button' class='btn saveChange'>СОХРАНИТЬ ИЗМЕНЕНИЯ</button>
      </div>";
    }

      

    mysqli_close($dbLink);
    ?>

  </div>
</div>

<script type="text/javascript">
/*СРАЗУ ВЫВОДИТЬ КАКОЕ УКРАШЕНИЕ ВЫБРАНО*/
var idDecor = document.getElementById("idDecor");
var radioDecor = document.getElementsByClassName('radioDecor');
for (var i = 0; i < radioDecor.length; i++) {
  if(radioDecor[i].value==idDecor.value){
    foo(radioDecor[i]);
  }
}
/*----------------*/
/*СРАЗУ ВЫВОДИТЬ КАКАЯ НАЧИНКА ВЫБРАНА*/
var idFill = document.getElementById("idFill");
var radioFill = document.getElementsByClassName('radioFill');
for (var i = 0; i < radioFill.length; i++) {
  if(radioFill[i].value==idFill.value){
    radioFill[i].checked=true;
  }
}
/*----------------*/
/*СРАЗУ ВЫВОДИТЬ КАКАЯ ФОРМА ВЫБРАНА*/
var idForm = document.getElementById("idForm");
var radioForm = document.getElementsByClassName('radioForm');
for (var i = 0; i < radioForm.length; i++) {
  if(radioForm[i].value==idForm.value){
    radioForm[i].checked=true;
  }
}
/*----------------*/

/*ИЗМЕНЕНИЕ ЦЕНЫ ПРИ ВЫБОРЕ ДЕКОРА*/
var a,b;
function foo(c) {
    if (a != c) {
      b = 0;
      a = c
    };
    b ^= 1;
    c.checked = b
    if($('input[name=decor]:checked', '.formChange').length==0){
      var sliderWeight = document.getElementById("weight");
      var sliderCol = document.getElementById("col");
      var price = document.getElementById("price");
      var priceDecor = document.getElementById("priceDecor");
      priceDecor.innerHTML = '0';
      if(sliderWeight!=null){
        sum.innerHTML = sliderWeight.value * sliderCol.value * price.value;
        $('#sumInput').val(sum.innerHTML);
      }else{
        sum.innerHTML = sliderCol.value * price.value;
        $('#sumInput').val(sum.innerHTML);
      }

    }else{
      var changeDecor = $('input[name=decor]:checked', '.formChange').val();
      var request = new XMLHttpRequest();
      request.onreadystatechange = function(){
        if((request.readyState==4) && (request.status==200)){
          $('#priceDecor').html(this.response);
          var sliderWeight = document.getElementById("weight");
          var sliderCol = document.getElementById("col");
          var price = document.getElementById("price");
          var priceDecor = document.getElementById("priceDecor").textContent;
          if(sliderWeight!=null){
            sum.innerHTML = sliderWeight.value * sliderCol.value * price.value+Number(priceDecor);
            $('#sumInput').val(sum.innerHTML);
          }else{
            sum.innerHTML = sliderCol.value * price.value+Number(priceDecor);
            $('#sumInput').val(sum.innerHTML);
          }
          
        }
      }
      request.open('GET','pages/priceDecor.php?idDecor=' + changeDecor, true);
      request.send();   
    }
     
};
/*--------------------*/

$('#close1').on('click', function(){
  $("#deleteFromBasket").modal('hide');
  location.reload();
});

/*$('#closeSave').on('click',function(){
  alert("fgvjnd");
  location.reload();
});*/
/*ИЗМЕНЕНИЕ ЦЕНЫ ПРИ ВЫБОРЕ ВЕСА*/
/*$('.formChange input[name=weight]').on('change',function () {
  var sliderWeight = document.getElementById("weight");
  var weightValue = document.getElementById("weightValue");
  var sliderCol = document.getElementById("col");
  var colValue = document.getElementById("colValue");
  var price = document.getElementById("price");
  var priceDecor = document.getElementById("priceDecor").textContent;
  if(sliderWeight!=null){
    weightValue.value = this.value;
    sum.innerHTML = sliderWeight.value * sliderCol.value * price.value+Number(priceDecor);
    $('#sumInput').val(sum.innerHTML);
  }else{
    sum.innerHTML = sliderCol.value * price.value+Number(priceDecor);
    $('#sumInput').val(sum.innerHTML);
  }
});*/
/*ИЗМЕНЕНИЕ ЦЕНЫ ПРИ ВЫБОРЕ КОЛИЧЕСТВА*/
/*$('.formChange input[name=col]').on('change',function () {
  var sliderWeight = document.getElementById("weight");
  var weightValue = document.getElementById("weightValue");
  var sliderCol = document.getElementById("col");
  var colValue = document.getElementById("colValue");
  var price = document.getElementById("price");
  var priceDecor = document.getElementById("priceDecor").textContent;
  if(sliderCol!=null){
    colValue.value = this.value;
    sum.innerHTML = sliderWeight.value * sliderCol.value * price.value+Number(priceDecor);
    $('#sumInput').val(sum.innerHTML);
  }else{
    sum.innerHTML = sliderCol.value * price.value+Number(priceDecor);
    $('#sumInput').val(sum.innerHTML);
  }
});*/

/*----- СОХРАНИТЬ ИЗМЕНЕНИЯ -----*/
  $('.saveChange').on('click',  function(){
    sendAjaxChange('formChange','pages/saveChangeBasket.php');
    return false;     
  });
  function sendAjaxChange(ajax_form, url) {
    $.ajax({
      url:     url, //url страницы (action_ajax_form.php)
      type:     "POST", //метод отправки
      dataType: "html", //формат данных
      data: $("."+ajax_form).serialize(),
      success: function(response) { //Данные отправлены успешно
        
        $('.modal-content').html(response);
      },
      error: function(response) { // Данные не отправлены
        alert("данные не отправлены");
      }
    });
  } 

</script>
<!-- ползунок -->
<script src="js/slideContainerBasket.js"></script>
