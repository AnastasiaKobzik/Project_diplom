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
    <link rel="stylesheet" href="../../libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/admin/styleIndexAdmin.css">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Birthstone+Bounce&family=Oswald:wght@300&display=swap" rel="stylesheet">

    <!-- SLICK SLIDER -->
    <link rel="stylesheet" type="text/css" href="../../libs/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="../../libs/slick/slick-theme.css"/>

    <!-- ICONS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  </head>
<body>
<?php
$category = $_GET['category'];
include "../../db/dbConnect.php";
echo "<div class='slick-slider'>";
if($category == 'Все'){
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
	      <form method='post' class='hiddenId'>
	        <a href='#'>
	          <img src='data:image/jpg;base64, $imgEncode' alt='$row[1]'>
	          <p>$row[1]</p>";
	          if ($row[5]!=1) {
	    echo "<p style='font-weight: 600;'>$row[4]р/шт</p>";      	
	          }else{
	    echo "<p style='font-weight: 600;'>$row[4]р/кг</p>";      	
	          }
	    echo "<button type='button' class='slider-hover' value='$row[0]'>ОТКРЫТЬ</button>
	        </a>
	      </form>
	    </div>";
	  }
	}	
}else{
	$queryProdCateg = "SELECT * FROM product,category WHERE product.id_category = category.id_category AND category.categories = '$category'";
	$resultProdCateg = mysqli_query($dbLink, $queryProdCateg) or die("Ошибка БД");
	if($resultProdCateg){
	  $rows = mysqli_num_rows($resultProdCateg); //кол-во строк
	  for ($i = 0;$i < $rows; ++$i) {
	    $row = mysqli_fetch_row($resultProdCateg);//извл-ся отд-ая строка
	    $imgEncode = base64_encode($row[3]);
	    $idProd = $row[0];
	    echo "
	    <div class='slide'>
	      <form method='post' class='hiddenId'>
	        <a href='#'>
	          <img src='data:image/jpg;base64, $imgEncode' alt='$row[1]'>
	          <p>$row[1]</p>";
	          if ($row[5]!=1) {
	    echo "<p style='font-weight: 600;'>$row[4]р/шт</p>";      	
	          }else{
	    echo "<p style='font-weight: 600;'>$row[4]р/кг</p>";      	
	          }
	    echo "<button type='button' class='slider-hover' value='$row[0]'>ОТКРЫТЬ</button>
	        </a>
	      </form>
	    </div>";
	  }
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
<!-- ПРОСМОТР ТОВАРА -->
  <div class='modal fade' id='viewProduct' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered ' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
        	
        </div>
        
      </div>
    </div>
  </div>

<script type="text/javascript">
/*ПРОСМОТР ТОВАРА*/
  $('.slider-hover').on('click',  function(){
    $("#viewProduct").modal('show');
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
      if((request.readyState==4) && (request.status==200)){    
        $('#viewProduct').html(this.response);
      }
    }
    request.open('GET','pages/admin/viewProduct.php?idProduct=' + this.value, true);
    request.send();     
  });


</script>
<!-- slick slider -->
<script src="../../js/slickSlider.js"></script>
<!-- библиотека jquery -->
<script src="../../libs/jquery-3.6.0.min.js"></script>
<!-- подключить библиотеку Bootstrap (js файл) -->
<script src="../../libs/bootstrap-4.0.0-dist/js/bootstrap.bundle.min.js"></script>
<script src="../../libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>

<!-- SLICK SLIDER -->
<script type="text/javascript" src="../../libs/slick/slick.min.js"></script>
    
</body>
</html>