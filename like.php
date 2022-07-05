<?php

if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Избранное</title>

    <!-- STYLE CSS -->
    <!-- подключить библиотеку Bootstrap (css файл) -->
    <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/styleLike.css">
    

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Birthstone+Bounce&family=Montserrat:wght@300;400;500;600;700&family=Oswald:wght@300;400;500;600&display=swap" rel="stylesheet">

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
      <p class="headingLike">ИЗБРАННОЕ</p>
    </div>
    <div class="col-6">
     <!--  <a class="txtAndImg">
        <p>Удалить всё</p>
        <img src="img/icon/binGrey.png" alt='очистить'>
      </a> -->
      
    </div>
  </div>
</div>
<div class="container">
  <div class='row'>
    <?php
    include "db/dbConnect.php";
    $idUser = $_SESSION['id_user'];
    $query = "SELECT * FROM favorites WHERE id_user = $idUser";
    $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
    if($result){
      $rows = mysqli_num_rows($result); //кол-во строк
      if ($rows>0) {
        for ($i = 0;$i < $rows; $i++) {
          $row = mysqli_fetch_row($result);
          $queryProd = "SELECT * FROM product WHERE id_product = $row[1]";
          $resultProd = mysqli_query($dbLink, $queryProd) or die("Ошибка БД");
          if ($resultProd) {
            $rowProd = mysqli_fetch_row($resultProd);
            $imgEncode = base64_encode($rowProd[3]);
            echo "
            <div class='col-lg-6 colLike'>
              <form method='post' class='hiddenId' action='pageProduct.php' target='_blank'>
                <div class='row'>
                    <div class='col-12 nameDel2 mb-3'>
                      <p class='nameLike'>$rowProd[1]</p>
                      <button type='button' class='delete' value='$row[1]' title='удалить из избранного'>
                        <img src='img/icon/close.png' class='closeImg' alt='удалить'>
                      </button>
                    </div>
                  <div class='col-5 prod'>
                    <img src='data:image/jpg;base64, $imgEncode' class='photoImg' alt='$rowProd[1]'>
                  </div>
                  
                  <div class='col-7 descr'>
                    <div class='row nameDel mb-3'>
                      <p class='nameLike'>$rowProd[1]</p>
                      <button type='button' class='delete' value='$row[1]' title='удалить из избранного'>
                        <img src='img/icon/close.png' class='closeImg' alt='удалить'>
                      </button>
                    </div>
                    <textarea class='descrP mb-3 mb-sm-0'>$rowProd[2]</textarea>  
                    <p class='price'>Цена: $rowProd[4]р.</p>
                  </div>
                  <input type='submit' class='hover'></input>

                  

                </div>
                <input type='hidden' name='hiddenId[]' value='$row[1]'></input>

              </form>
            </div>";    
          }
              
        }        
      }else{
        echo "<div class='likeNull'>В избранном пока что ничего нет.<br>Вы можете перейти в <a href='catalog.php'>КАТАЛОГ</a> и добавить нужный товар.</div>";
      }
    }

    mysqli_close($dbLink);
    ?>
    


  </div>
</div>


<!-- DELETE LIKE -->
  <div class='modal fade' id='deleteLikeModal' tabindex='-1' role='dialog' aria-hidden='true'>
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
  $('.delete').on('click',  function(){

      var request = new XMLHttpRequest();
      request.onreadystatechange = function(){
        if((request.readyState==4) && (request.status==200)){
          $("#deleteLikeModal").modal('show');
          $('#deleteLikeModal').html(this.response);

        }
      }
      request.open('GET','pages/DeleteLike.php?id=' + this.value, true);
      request.send();
  });

</script>

<!-- библиотека jquery -->
<script src="libs/jquery-3.6.0.min.js"></script>
<!-- подключить библиотеку Bootstrap (js файл) -->
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.bundle.min.js"></script>
<script src="libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    
</body>
</html>