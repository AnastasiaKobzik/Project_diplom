<?php

if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Каталог</title>

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="../libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/catalog.css">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Birthstone+Bounce&family=Oswald:wght@300&display=swap" rel="stylesheet">

    <!-- SLICK SLIDER -->
    <link rel="stylesheet" type="text/css" href="../libs/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="../libs/slick/slick-theme.css"/>

    <!-- ICONS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  </head>
<body>
  <div style="display:flex; flex-direction: row;">
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
            
          </div>
          <div class="disabNoYes">
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Начинка:</h6>
            
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
<!-- slick slider -->
<script src="../js/slickSlider.js"></script>
<!-- библиотека jquery -->
<script src="../libs/jquery-3.6.0.min.js"></script>
<!-- подключить библиотеку Bootstrap (js файл) -->
<script src="../libs/bootstrap-4.0.0-dist/js/bootstrap.bundle.min.js"></script>
<script src="../libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>

<!-- SLICK SLIDER -->
<script type="text/javascript" src="../libs/slick/slick.min.js"></script>
    
</body>
</html>