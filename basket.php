<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Корзина</title>

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/styleBasket.css">
    

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Oswald:wght@300&display=swap" rel="stylesheet">


    <!-- ICONS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  </head>
<body>
 <?php
  include("pages/head-footer/header.php");
  ?>
<div class="container">
  <div class="row namePageAndClear">
    <div class="col-6">
      <p class="headingBasket">КОРЗИНА</p>
    </div>
    <div class="col-6">
      <!-- <a class="txtAndImg">
        <p>Очистить корзину</p>
        <img src="img/icon/binGrey.png" alt='очистить'>
      </a> -->
    </div>
    <input type='hidden' class='url' name='url' value="">
  </div>
  <div class="row mb-3">
    <div class="col-5 col-sm-6">
      <a class="checkAll">
        <input type="checkbox" name="chooseAll" class="chooseAll" id='choose'>
        <label for='choose'>Выбрать всё</label>
      </a>
    </div>
    <div class="col-7 col-sm-6">
      <div class="txtAndImg">
        <p class="clear clickDeleteAll">Очистить корзину</p>
        <img class="clickDeleteAll" src="img/icon/binGrey.png" alt='очистить'>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <form method='post' class='form-select' action='selectordBasket.php'>
    <?php
    include "db/dbConnect.php";
    $idUser = $_SESSION['id_user'];
    $query = "SELECT * FROM basket WHERE id_user = $idUser AND in_stock=1 ORDER BY id_basket DESC";
    $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
    if($result){
      $rows = mysqli_num_rows($result); //кол-во строк
      if ($rows>0) {
        for ($i = 0;$i < $rows; $i++){
          $row = mysqli_fetch_row($result);
          $queryProd = "SELECT * FROM product WHERE id_product = $row[1]";
          $resultProd = mysqli_query($dbLink, $queryProd) or die("Ошибка БД1");

          $rowProd = mysqli_fetch_row($resultProd);
          $imgEncode = base64_encode($rowProd[3]);
          /*ЕСЛИ ЕСТЬ НАЧИНКА И ФОРМА*/
          if($rowProd[6]!=null && $rowProd[7]!=null){
            $queryFill = "SELECT * FROM filling WHERE id_filling = $row[6]";
            $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД2");

            $rowFill = mysqli_fetch_row($resultFill);

            $queryForm = "SELECT * FROM formcake WHERE id_formCake = $row[5]";
            $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД3");

            $rowForm = mysqli_fetch_row($resultForm);
            /*ЕСЛИ ЕСТЬ УКРАШЕНИЕ*/
            if($row[8]!=null){
              $queryDecor = "SELECT * FROM decoration WHERE id_decoration = $row[8]";  
              $resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД2");
              $rowDecor = mysqli_fetch_row($resultDecor);
              echo "
                  <div class='row form-chek select-prod mb-4'>
                    <input type='checkbox' name='select[]' class='col-1 form-chek-input custom-checkbox' value='$row[0]' id='$row[0]'>
                    <label for='$row[0]' class='mt-2 mt-sm-0'></label>
                    <div class='row col-12 product'>

                            <div class='nameSelAndDelete2 col-12'>
                              <p>$rowProd[1]</p>
                              <button type='button' class='delete' value='$row[0]' title='удалить'>
                                <img src='img/icon/close.png' class='closeImg' alt='удалить'>
                              </button>                         
                            </div>
                      <div class='col-sm-5 col-md-4 col-lg-3 mb-3 mb-sm-0 photo'>
                        <img class='photoProd' src='data:image/jpg;base64, $imgEncode' alt='$rowProd[1]'>
                      </div>
                      
                      <div class='col-sm-7 col-md-8 col-lg-9 descrProduct'>
                        
                          <div>
                            <div class='nameSelAndDelete'>
                              <p>$rowProd[1]</p>
                              <button type='button' class='delete' value='$row[0]' title='удалить'><img src='img/icon/close.png' class='closeImg' alt='удалить'></button>
                            </div>
                            <p>$rowProd[2]</p>
                            <div class='characteristic row'>
                              <p class='col-sm-12 col-md-6 col-lg-4'>Начинка: $rowFill[1],</p>
                              <p class='col-sm-4 col-md-4 col-lg-2'>Вес: $row[3]кг,</p>
                              <p class='col-sm-6 col-md-4 col-lg-3'>Форма: $rowForm[1],</p>
                              <p class='col-sm-12 col-md-4 col-lg-3'>Количество: $row[4],</p>
                              <p class='col-sm-12 col-md-6 col-lg-3'>Украшение: $rowDecor[1]</p>
                            </div>  
                          </div>
                          
                          <div class='selectBottom row'>
                            <p class='col-12 col-md-4 col-lg-5 mb-sm-3 mb-md-0'>Цена: <b>$row[7]р.</b></p>
                            <div class='butSelect row col-12 col-md-8 col-lg-7 mt-3 mt-sm-0'>
                              <button type='button' class='change' value='$row[0]'>ИЗМЕНИТЬ</button>
                              <div class='position'>
                                <input type='submit' class='order' name='orderClick' value='$row[0]'>
                                <div class='txt'>ЗАКАЗАТЬ</div>
                              </div>  
                            </div>
                          </div>
                        
                      </div>
                    
                    </div>

                  </div>
                
                
              ";
              /* ЕСЛИ НЕТ УКРАШЕНИЯ*/
              /*<input type='checkbox' name='select[]' class='col-1 form-chek-input custom-checkbox' value='$row[0]' id='$row[0]'>
                    <label for='$row[0]'></label>*/
            }else{
              echo "
                  <div class='row form-chek select-prod mb-4'>
                    <input type='checkbox' name='select[]' class='col-1 form-chek-input custom-checkbox' value='$row[0]' id='$row[0]'>
                    <label for='$row[0]' class='mt-2 mt-sm-0'></label>
                    <div class='row col-12 product'>
                          <div class='nameSelAndDelete2 col-12'>
                            <p>$rowProd[1]</p>
                            <button type='button' class='delete' value='$row[0]' title='удалить'>
                              <img src='img/icon/close.png' class='closeImg' alt='удалить'>
                            </button>
                          </div>
                      <div class='col-sm-5 col-md-4 col-lg-3 mb-3 mb-sm-0 photo'>
                        <img class='photoProd' src='data:image/jpg;base64, $imgEncode' alt='$rowProd[1]'>
                      </div>
                      
                      <div class='col-sm-7 col-md-8 col-lg-9 descrProduct'>
                        <div>
                          <div class='nameSelAndDelete'>
                            <p>$rowProd[1]</p>
                            <button type='button' class='delete' value='$row[0]' title='удалить'><img src='img/icon/close.png' class='closeImg' alt='удалить'></button>
                          </div>
                          <p>$rowProd[2]</p>
                          <div class='characteristic row'>
                            <p class='col-sm-12 col-md-6 col-lg-4'>Начинка: $rowFill[1],</p>
                            <p class='col-sm-4 col-md-4 col-lg-2'>Вес: $row[3]кг,</p>
                            <p class='col-sm-6 col-md-4 col-lg-3'>Форма: $rowForm[1],</p>
                            <p class='col-sm-12 col-md-4 col-lg-3'>Количество: $row[4]</p>
                          </div>
                        </div>
                        <div class='selectBottom row'>
                          <p class='col-12 col-md-4 col-lg-5 mb-sm-3 mb-md-0'>Цена: <b>$row[7]р.</b></p>
                          <div class='butSelect row col-12 col-md-8 col-lg-7 mt-3 mt-sm-0'>
                            <button type='button' class='change' value='$row[0]'>ИЗМЕНИТЬ</button>
                            <div class='position'>
                              <input type='submit' class='order' name='orderClick' value='$row[0]'>
                              <div class='txt'>ЗАКАЗАТЬ</div>
                            </div>  
                          </div> 
                        </div>
                        
                      </div>
                    
                    </div>

                  </div>
                
                
              ";
            }
           /*ЕСЛИ НЕТ НАЧИНКИ И ФОРМЫ*/   
          }else{
            /*ЕСЛИ ЕСТЬ УКРАШЕНИЕ*/
            if($row[8]!=null){
              $queryDecor = "SELECT * FROM decoration WHERE id_decoration = $row[8]";  
              $resultDecor = mysqli_query($dbLink, $queryDecor) or die("Ошибка БД2");
              $rowDecor = mysqli_fetch_row($resultDecor);
              echo "
                
                
                  <div class='row form-chek select-prod mb-4'>
                    <input type='checkbox' name='select[]' class='col-1 form-chek-input custom-checkbox' value='$row[0]' id='$row[0]'>
                    <label for='$row[0]' class='mt-2 mt-sm-0'></label>
                    <div class='row col-12 product'>
                          <div class='nameSelAndDelete2 col-12'>
                            <p>$rowProd[1]</p>
                            <button type='button' class='delete' value='$row[0]' title='удалить'><img src='img/icon/close.png' class='closeImg' alt='удалить'></button>
                          </div>
                      <div class='col-sm-5 col-md-4 col-lg-3 mb-3 mb-sm-0 photo'>
                        <img class='photoProd' src='data:image/jpg;base64, $imgEncode' alt='$rowProd[1]'>
                      </div>
                      
                      <div class='col-sm-7 col-md-8 col-lg-9 descrProduct'>
                        <div>
                          <div class='nameSelAndDelete'>
                            <p>$rowProd[1]</p>
                            <button type='button' class='delete' value='$row[0]' title='удалить'><img src='img/icon/close.png' class='closeImg' alt='удалить'></button>
                          </div>
                          <p>$rowProd[2]</p>
                          <div class='characteristic row'>
                            <p class='col-sm-6 col-md-4 col-lg-3'>Вес: $row[3] г,</p>
                            <p class='col-sm-6 col-md-4 col-lg-3'>Количество: $row[4],</p>
                            <p class='col-12 col-md-6 col-lg-4'>Украшение: $rowDecor[1]</p>
                          </div>
                        </div>
                        <div class='selectBottom row'>
                          <p class='col-12 col-md-4 col-lg-5 mb-sm-3 mb-md-0'>Цена: <b>$row[7]р.</b></p>
                          <div class='butSelect row col-12 col-md-8 col-lg-7 mt-3 mt-sm-0'>
                            <button type='button' class='change' value='$row[0]'>ИЗМЕНИТЬ</button>
                            <div class='position'>
                              <input type='submit' class='order' name='orderClick' value='$row[0]'>
                              <div class='txt'>ЗАКАЗАТЬ</div>
                            </div>  
                          </div>
                        </div>
                        
                      </div>                  
                      
                    </div>

                  </div>
                
                
              ";
              /* ЕСЛИ НЕТ УКРАШЕНИЯ*/
            }else{
              echo "
                
                
                  <div class='row form-chek select-prod mb-4'>
                    <input type='checkbox' name='select[]' class='col-1 form-chek-input custom-checkbox' value='$row[0]' id='$row[0]'>
                    <label for='$row[0]' class='mt-2 mt-sm-0'></label>
                    <div class='row col-12 product'>
                          <div class='nameSelAndDelete2 col-12'>
                            <p>$rowProd[1]</p>
                            <button type='button' class='delete' value='$row[0]' title='удалить'><img src='img/icon/close.png' class='closeImg' alt='удалить'></button>
                          </div>
                      <div class='col-sm-5 col-md-4 col-lg-3 mb-3 mb-sm-0 photo'>
                        <img class='photoProd' src='data:image/jpg;base64, $imgEncode' alt='$rowProd[1]'>
                      </div>
                      
                      <div class='col-sm-7 col-md-8 col-lg-9 descrProduct'>
                        <div>
                          <div class='nameSelAndDelete'>
                            <p>$rowProd[1]</p>
                            <button type='button' class='delete' value='$row[0]' title='удалить'><img src='img/icon/close.png' class='closeImg' alt='удалить'></button>
                          </div>
                          <p>$rowProd[2]</p>
                          <div class='characteristic row'>
                            <p class='col-sm-6 col-md-4 col-lg-3'>Вес: $row[3] г,</p>
                            <p class='col-sm-6 col-md-4 col-lg-3'>Количество: $row[4]</p>
                          </div>
                        </div>
                        <div class='selectBottom row'>
                          <p class='col-12 col-md-4 col-lg-5 mb-sm-3 mb-md-0'>Цена: <b>$row[7]р.</b></p>
                          <div class='butSelect row col-12 col-md-8 col-lg-7 mt-3 mt-sm-0'>
                            <button type='button' class='change' value='$row[0]'>ИЗМЕНИТЬ</button>
                            <div class='position'>
                              <input type='submit' class='order' name='orderClick' value='$row[0]'>
                              <div class='txt'>ЗАКАЗАТЬ</div>
                            </div>  
                          </div>
                            
                        </div>
                        
                      </div>                  
                      
                    </div>

                  </div>
                
                
              ";  
            }
            
          }
        }
        echo "
        <div class='butSelectCheck'>
          <input type='submit' class='selectOrder' value='ЗАКАЗАТЬ'></input>
        </div>";        
      }else{
        echo "<div class='basketNull'>В корзине пока что ничего нет.<br>Это отличная возможность её заполнить!<br>Вы можете перейти в <a href='catalog.php'>КАТАЛОГ</a> и выбрать нужный товар.</div>";
      }
    }
    ?>
 
  </form>

<!--  <input type="checkbox" class="custom-checkbox" id="happy" name="happy" value="yes">
<label for="happy">Happy</label>
</div> -->


<!-- МОДАЛЬНОЕ ОКНО ДЛЯ УДАЛЕНИЯ -->
  <div class='modal fade' id='deleteFromBasket' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          
          <button type='button' class='close' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body mx-auto'>
          <p>Вы уверены, что хотите очистить Корзину?</p>
        </div>
              
        <div class='modal-footer mx-auto' >
          <button type='button' class='btn deleteAllBasket'>ДА</button>
          <button type='button' class='btn ml-3' id='close'>НЕТ</button>
        </div>
        
      </div>
    </div>
  </div>

<!-- МОДАЛЬНОЕ ОКНО ДЛЯ ИЗМЕНЕНИЯ -->
  <div class='modal fade' id='changeFromBasket' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
              
      </div>
    </div>
  </div>

<?php
  include("pages/head-footer/footer.php");
?>

<script type="text/javascript">
$('.close').on('click',function(){
  location.reload();
});
$('#close').on('click', function(){
  location.reload();
});
/* УДАЛЕНИЕ ИЗ КОРЗИНЫ*/
  $('.delete').on('click',  function(){
    
      var request = new XMLHttpRequest();
      request.onreadystatechange = function(){
        if((request.readyState==4) && (request.status==200)){
          $("#deleteFromBasket").modal('show');
          $('#deleteFromBasket').html(this.response);
        }
      }
      request.open('GET','pages/DeleteFromBasket.php?id=' + this.value, true);
      request.send();
  });
/*УДАЛИТЬ ВСЁ*/
$('.clickDeleteAll').on('click', function(){
  $("#deleteFromBasket").modal('show');
  $('.deleteAllBasket').on('click', function(){
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){
        $('#deleteFromBasket').html(this.response);
      }
    }
    request.open('GET','pages/DeleteAllFromBasket.php', true);
    request.send();
  });
});

/*$('.selectOrder').on('click',  function(){
    
      var request = new XMLHttpRequest();
      request.onreadystatechange = function(){
        if((request.readyState==4) && (request.status==200)){

        }
      }
      request.open('GET','pages/orderProduct.php?id=' + this.value, true);
      request.send();
  });*/
/* ИЗМЕНЕНИЕ В КОРЗИНЕ*/
  $('.change').on('click',  function(){
    
      var request = new XMLHttpRequest();
      request.onreadystatechange = function(){
        if((request.readyState==4) && (request.status==200)){
          $("#changeFromBasket").modal('show');
          $('#changeFromBasket').html(this.response);

        }
      }
      request.open('GET','pages/changeFromBasket.php?id=' + this.value, true);
      request.send();
  });

/*ОТСЛЕЖИВАНИЕ ВЫБРАННЫХ CHECKBOX*/
const myCount = function() {
    
  if($('.form-chek-input:checked').length >= 1){
    /*$('.selectOrder').css('display','block');*/
    $('.butSelectCheck').css('display','flex');
    $('.order').css('display','none');
    $('.txt').css('display','none');
    
  }else{
    /*$('.selectOrder').css('display','none');*/
    $('.butSelectCheck').css('display','none');
    $('.order').css('display','block');
    $('.txt').css('display','block');
  }
};
myCount();
$('.form-chek-input').on('click', myCount);

/*если нажато ВЫБРАТЬ ВСЁ*/
$('.chooseAll').on('click', function(){
  var chooseAll = document.getElementsByClassName('form-chek-input');
  var choose = document.getElementById("choose");
  if(choose.checked==true){
    for (var i = 0; i < chooseAll.length; i++) {
      chooseAll[i].checked=true;
      /*$('.selectOrder').css('display','block');*/
      $('.butSelectCheck').css('display','flex');
      $('.order').css('display','none');
      $('.txt').css('display','none');
    }    
  }else{
    for (var i = 0; i < chooseAll.length; i++) {
      chooseAll[i].checked=false;
     /* $('.selectOrder').css('display','none');*/
      $('.butSelectCheck').css('display','none');
      $('.order').css('display','block');
      $('.txt').css('display','block');
    } 
  }

});
$('#close1').on('click', function(){
  $("#deleteFromBasket").modal('hide');
  location.reload();
});

$('#closeSave').on('click',function(){
  alert("fgvjnd");
  location.reload();
});
</script>

<!-- библиотека jquery -->
<script src="libs/jquery-3.6.0.min.js"></script>
<script src="js/slideContainerBasket.js"></script>
<!-- подключить библиотеку Bootstrap (js файл) -->
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.bundle.min.js"></script>
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    
</body>
</html>