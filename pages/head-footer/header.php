<?php
if(session_status()!=PHP_SESSION_ACTIVE) 
        session_start();
?>

<html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/modalStyle.css">
    

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Birthstone+Bounce&family=Oswald:wght@300&display=swap" rel="stylesheet">

  </head>
<body><!-- sticky-top фиксированное меню-->
<?php
  if ($_SESSION['name']=='' && $_SESSION["adminName"]=='' && $_SESSION["courierName"]==''){
  echo"
  <nav class='navbar  navbar-expand-lg navbar-light bg-light font-monts'>
    <div class='container'>

      <a class='navbar-brand logo-position ' href='index.php'></a>
      
      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='.navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation''>
        <span class='navbar-toggler-icon'></span>
      </button>

      <div class='collapse navbar-collapse navCollapseNoPadding navbarSupportedContent justify-content-end'>
        <div class='container paddNo'>
          <ul class='navbar-nav ' >
            <li class='nav-item'>
              <a class='nav-link' href='catalog.php'>Каталог</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='reviews.php'>Отзывы</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='aboutUs.php'>О нас</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='shippingAndPayment.php'>Доставка и оплата</a>
            </li>
            <li class='nav-item  ml-5'>";
            
            echo "<a class='nav-link' data-toggle='modal' data-target='#butAuthModal' href='#'>Вход</a>";
                
            echo "
            </li>
          </ul>
        </div>
      </div>

    </div>
  </nav>";
}elseif ($_SESSION['name']!=''&&$_SESSION['courierName']=='' && $_SESSION["adminName"]=='') {
echo "
<nav class='navbar navbar-inverse navbar-static-top ' role='navigation'>
  <div class='container '>
  <a class='navbar-brand logo-position ' href='index.php'></a>
    <div class='navbar-header justify-content-end'>
      <button type='button' class='navbar-toggle collapsed btnMenuForUsers' data-toggle='collapse' data-target='#menuForUsers'>
        
      </button>
    </div>

    <div class='collapse navbar-collapse navCollapsePadding' id='menuForUsers'>
      <div class='container paddNo'>
        <ul class='nav navbar-nav text-right font-monts'>
          <li class='nav-item '>
              <a class='nav-link' href='catalog.php'>Каталог</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='basket.php'>Корзина</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='reviews.php'>Отзывы</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='like.php'>Избранное</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='allOrders.php'>Все заказы</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='bonuses.php'>Бонусы</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='aboutUs.php'>О нас</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='shippingAndPayment.php'>Доставка и оплата</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' data-toggle='modal' data-target='#logOutModal' href='#'>Выход (".$_SESSION['name'].")</a>
            </li>
        </ul>
      </div>
    </div>
  </div>
</nav>";
}elseif ($_SESSION['name']==''&&$_SESSION['courierName']=='' && $_SESSION["adminName"]!='') {
echo"
  <nav class='navbar navbar-expand-lg navbar-light bg-light font-monts'>
    <div class='container'>

      <a class='navbar-brand logo-position ' href='indexAdmin.php'></a>
      
      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='.navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
      </button>

      <div class='collapse navbar-collapse navCollapseNoPadding navbarSupportedContent justify-content-end'>
        <div class='container paddNo'>
          <ul class='navbar-nav ' >
            <li class='nav-item'>
              <a class='nav-link' href='indexAdmin.php'>Все товары</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='allOrdersAdmin.php'>Все заказы</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='couriers.php'>Курьеры</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' data-toggle='modal' data-target='#logOutModal' href='#'>Выход (".$_SESSION['adminName'].")</a>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </nav>";
}elseif ($_SESSION['name']==''&&$_SESSION['courierName']!='' && $_SESSION["adminName"]=='') {
echo"
  <nav class='navbar navbar-expand-lg navbar-light bg-light font-monts'>
    <div class='container'>

      <a class='navbar-brand logo-position ' href='indexCourier.php'></a>
      
      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='.navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
      </button>

      <div class='collapse navbar-collapse navCollapseNoPadding navbarSupportedContent justify-content-end'>
        <div class='container paddNo'>
          <ul class='navbar-nav ' >
            <li class='nav-item'>
              <a class='nav-link' href='indexCourier.php'>Все заказы</a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' data-toggle='modal' data-target='#logOutModal' href='#'>Выход (".$_SESSION['courierName'].")</a>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </nav>";
}
?>

<!-- BUT-AUTH-MODAL -->
<div class="modal fade" id="butAuthModal" tabindex="-1" role="dialog" aria-hidden="true">
  <?php
  include("pages/logInSingUp/logInOrSignUp.php");
  ?>
  
</div>

<!-- LOG-IN-MODAL -->
<div class="modal fade" id="logInModal" tabindex="-1" role="dialog" aria-hidden="true">
  <?php
  include("pages/logInSingUp/logIn.php");
  ?>
</div>
<!-- SING-UP-MODAL -->
<div class="modal fade" id="SingUpModal" tabindex="-1" role="dialog" aria-hidden="true">
  <?php
  include("pages/logInSingUp/SingUp.php");
  ?>
</div>
<!-- LOG-OUT-MODAL -->
<div class="modal fade" id="logOutModal" tabindex="-1" role="dialog" aria-hidden="true">
  <?php
  include("pages/logInSingUp/logOut.php");
  ?>
</div>
<!-- SUCCESS REGISTRATION -->
<div class='modal fade' id='successReg' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header' >              
          <button type='button' class='close' aria-label='Close' onclick='reloadr();'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body mx-auto'>
          <p>Спасибо за регистрацию!<br>В подарок Вам начислено 15 бонусов.</p>
        </div>
        <div class='modal-footer mx-auto' >
          <button type='button' class='btn' onclick='reloadr();'>ЗАКРЫТЬ</button>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
function reloadr(){
  location.reload();
}


</script>
</body>
</html>