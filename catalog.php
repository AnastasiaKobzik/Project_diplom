<?php

if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="ru">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Каталог товаров кондитерской BakeCake</title>

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/catalog.css">
    

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Oswald:wght@300&display=swap" rel="stylesheet">


    <!-- SLICK SLIDER -->
    <link rel="stylesheet" type="text/css" href="libs/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="libs/slick/slick-theme.css"/>

    <!-- ICONS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  </head>
<body>
 <?php
  include("pages/head-footer/header.php");
  ?>

<div class="container">
  <div class="headingSearch row">
    <p class="headingCatalog col-4">КАТАЛОГ</p>
    <form class="form-inline col-8">
      <input class="form-control mr-2 searchInput" type="search" placeholder="Поиск" aria-label="Search" name="search">
      <button class="btn my-2 my-sm-0 search" type="button">Искать</button>
    </form>
  </div>
  <div class="filterSort">

    <div class="dropdown">
      <button class=" btn-secondaryw dropdown-toggle dropdownFilter" type="button" id="dropdownMenuButtonFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Фильтр
      </button>

      <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonFilter">
        <form method="post" id="ajax_formFilter">
          <h6 class="dropdown-header">Категория:</h6>
          <div class="form-check">
            <input class="form-check-input inputCastomCheck category" type="checkbox" name="category[]" id="all" value="all">
            <label class="form-check-label" for="all">
              Все
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input inputCastomCheck category" type="checkbox" name="category[]" id="cakes" value="1">
            <label class="form-check-label" for="cakes">
              Торты
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input inputCastomCheck category" type="checkbox" name="category[]" id="cheesecake" value="5">
            <label class="form-check-label" for="cheesecake">
              Чизкейки
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input inputCastomCheck category" type="checkbox" name="category[]" id="pastries" value="2">
            <label class="form-check-label" for="pastries">
              Пирожные
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input inputCastomCheck category" type="checkbox" name="category[]" id="cupcakes" value="6">
            <label class="form-check-label" for="cupcakes">
              Капкейки
            </label>
          </div>

          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Цена:</h6>
          <div class="slidecontainer">
            <div>
              <input type="range" min="5" max="100" value="5" class="slider" id="myRange" name="price1">
              <p>От <input type="number" min="5" max="100" id="demo"> р</p>
            </div>
            <div>
              <input type="range" min="5" max="100" value="100" class="slider" id="myRange1" name="price2">
              <p>До <input type="number" min="5" max="100" id="demo1"> р</p>
            </div>
            
          </div>

          <div class="disabNoYes">
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Форма:</h6>
            <?php
            include "db/dbConnect.php";
            $queryForm = "SELECT * FROM formcake";
            $resultForm = mysqli_query($dbLink, $queryForm) or die("Ошибка БД");
            if($resultForm){
              $rowsForm = mysqli_num_rows($resultForm); //кол-во строк
              for ($i = 0;$i < $rowsForm; ++$i){
                $rowForm = mysqli_fetch_row($resultForm);
                echo "
                <div class='form-check'>
                  <input class='form-check-input inputCastomCheck formFilter' type='checkbox' name='form[]' id='$rowForm[1]' value='$rowForm[0]'>
                  <label class='form-check-label' for='$rowForm[1]'>$rowForm[1]</label>
                </div>";
              }
            }
            mysqli_close($dbLink);
            ?>
          </div>
          <div class="disabNoYes">
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Начинка:</h6>
            <?php
            include "db/dbConnect.php";
            $queryFill = "SELECT * FROM filling";
            $resultFill = mysqli_query($dbLink, $queryFill) or die("Ошибка БД");
            if($resultFill){
              $rowsFill = mysqli_num_rows($resultFill); //кол-во строк
              for ($i = 0;$i < $rowsFill; ++$i) {
                $rowFill = mysqli_fetch_row($resultFill);
                echo "
                <div class='form-check'>
                  <input class='form-check-input inputCastomCheck fillFilter' type='checkbox' name='filling[]' id='$rowFill[1]' value='$rowFill[0]'>
                  <label class='form-check-label' for='$rowFill[1]'>$rowFill[1]</label>
                </div>";
              }
            }
            mysqli_close($dbLink);
            ?>
          </div>
          
          <div class="butFilter">
            <input type="submit" name="butOk" class="butOk" value="Применить"></input>
            <input type="submit" name="butNo" class="butNo" value="Сбросить"></input>
          </div>
        </form>

      </div>
    </div> 

    <div class="dropdown dropleft">
      <button class=" btn-secondaryw dropdown-toggle dropdownSort" type="button" id="dropdownMenuButtonSort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Сортировка
      </button>
      <div class="dropdown-menu sort row" aria-labelledby="dropdownMenuButtonSort">
        <a class="dropdown-item1 col-12" id="item1" href="#">Цена по возрастанию</a>
        <a class="dropdown-item2 col-12" id="item2" href="#">Цена по убыванию</a>
      </div>
    </div>

  </div>

</div>
<div class="container ">
  <div class="fff">
    
<?php
include "db/dbConnect.php";
echo "<div class='slick-slider'>";
$query = "SELECT * FROM product";
$result = mysqli_query($dbLink, $query) or die("Ошибка БД");
if($result){
  $rows = mysqli_num_rows($result); //кол-во строк
  for ($i = 0;$i < $rows; ++$i) {
    $row = mysqli_fetch_row($result);//извл-ся отд-ая строка
    $imgEncode = base64_encode( $row[3] );
    $idProd = $row[0];
    echo "
    <div class='slide'>
      <form method='post' class='hiddenId' action = 'pageProduct.php'>
        <a href='#'>
          <img src='data:image/jpg;base64, $imgEncode' alt='$row[1]'>
          <p>$row[1]</p>";
          if ($row[5]!=1) {
    echo "<p style='font-weight: 600;'>$row[4]р/шт</p>";              
          }else{
    echo "<p style='font-weight: 600;'>$row[4]р/кг</p>";             
          }
    echo "<button type='submit' class='slider-hover' value=''>ПОДРОБНЕЕ
          <img src='img/arrowRight.svg'></button>
          <input type='hidden' name='hiddenId[]' class='productsId' value='$row[0]'></input>
          <input type='hidden' name='hiddenPrice[]' value='$row[4]'></input>
        </a>
      </form>
    </div>";
  }
}
mysqli_close($dbLink);
echo "</div>
<div class='arrowSlide'>
    <div class='prevArrow'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-left' viewBox='0 0 16 16'>
        <path fill-rule='evenodd' d='M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z'/>
      </svg>
    </div>
    <div class='nextArrow'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-arrow-right' viewBox='0 0 16 16'>
        <path fill-rule='evenodd' d='M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z'/>
      </svg>
    </div>
  </div>
";
?>
    </div>
  
</div>

<?php
  include("pages/head-footer/footer.php");
?>

<script type="text/javascript">


/*скрыть выбор формы и начинки если в фильтре не выбрано торт или все*/
$('.category').on('change', function(){
  var categoryChecked = $('.category:checked', '#ajax_formFilter');
  var disab = 0;
  var form = document.getElementsByClassName('formFilter');
  var fill = document.getElementsByClassName('fillFilter');
  for (var i = 0; i < categoryChecked.length; i++) {
    
    var nameCateg = categoryChecked[i].value;
    if (nameCateg == 1 || nameCateg == 'all') {
      disab++;
    } 
  }
    if (disab == 1 || disab == 2 || categoryChecked.length==0) {
      $('.disabNoYes').css('display', 'block');
      for (var fr = 0; fr < form.length; fr++){
        form[fr].disabled=false;
      }
      for (var fl = 0; fl < fill.length; fl++){
        fill[fl].disabled=false;
      }
    }else{
      $('.disabNoYes').css('display', 'none');
      for (var fr = 0; fr < form.length; fr++){
        form[fr].disabled=true;
        form[fr].checked=false;
      }
      for (var fl = 0; fl < fill.length; fl++){
        fill[fl].disabled=true;
        fill[fl].checked=false;
      }
    }
});

/*----- ФИЛЬТР ------*/
$('.butOk').on('click',  function(){
  sendAjaxForm('ajax_formFilter', 'pages/outputOfProducts.php');
  return false;     
});

function sendAjaxForm(ajax_form, url) {
  $.ajax({
    url:     url, //url страницы (action_ajax_form.php)
    type:     "POST", //метод отправки
    dataType: "html", //формат данных
    data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
    success: function(response) { //Данные отправлены успешно
      /*var divElem = document.createElement("div");
      divElem.classList.add("slide");*/
      $('.fff').html(response);
    },
    error: function(response) { // Данные не отправлены
      alert("данные не отправлены");
    }
  });
}
/*----- ЦЕНА ПО ВОЗРАСТАНИЮ ------*/
$('.dropdown-item1').on('click',  function(){
  var products = document.getElementsByClassName('productsId');
  var prodMas = [];
  for (var i = 0; i < products.length; i++) {
    prodMas[i] = products[i].value;
    /*alert(prodMas[i]);*/
  }
  $.post("pages/sortOfProducts.php",
    {'data[]': prodMas}, 
    function(result){
      $('.fff').html(result);
    }
  );
    
});

/*----- ЦЕНА ПО УБЫВАНИЮ ------*/
$('.dropdown-item2').on('click',  function(){
  var products = document.getElementsByClassName('productsId');
  var prodMas = [];
  for (var i = 0; i < products.length; i++) {
    prodMas[i] = products[i].value;
    /*alert(prodMas[i]);*/
  }
  $.post("pages/rSortOfProducts.php",
    {'data[]': prodMas}, 
    function(result){
      $('.fff').html(result);
    }
  );
       
});
 


/*----- ПОИСК ------*/
$('.search').on('click',  function(){
  
    sortAjaxForm('form-inline', 'pages/searchProduct.php');
    return false;     
});
 
function sortAjaxForm(ajax_form, url) {
  $.ajax({
    url:     url, //url страницы (action_ajax_form.php)
    type:     "POST", //метод отправки
    dataType: "html", //формат данных
    data: $("."+ajax_form).serialize(),  // Сеарилизуем объект
    success: function(response) { //Данные отправлены успешно
      
      $('.fff').html(response);
    },
    error: function(response) { // Данные не отправлены
      alert("данные не отправлены");
    }
  });
}

</script>


<!-- slick slider -->
<script src="js/slickSlider.js"></script>
<!-- ползунок с ценой -->
<script src="js/slideContainer.js"></script>
<!-- библиотека jquery -->
<script src="libs/jquery-3.6.0.min.js"></script>
<!-- подключить библиотеку Bootstrap (js файл) -->
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.bundle.min.js"></script>
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>

<!-- SLICK SLIDER -->
<script type="text/javascript" src="libs/slick/slick.min.js"></script>
    
</body>
</html>