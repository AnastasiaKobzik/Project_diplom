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
<?php

echo "<div class='slick-slider'>";

include "../db/dbConnect.php";

$category = $_POST['category'];
$form = $_POST['form'];
$filling = $_POST['filling'];
$price1 = $_POST['price1'];
$price2 = $_POST['price2'];
if($category != null){
  $N = count($category);
}

if ($category!=null) {
  $countCategory = count($category);
  /*ЕСЛИ ВЫБРАНО ТОЛЬКО "ВСЕ"*/
  if ($countCategory == 1 && $category[0] == 'all' && $form == null && $filling == null) {
    $query = "SELECT * FROM product WHERE price >= $price1 AND price <= $price2";
    $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
    if($result){
      $rows = mysqli_num_rows($result);
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
        echo  "
              <button type='submit' class='slider-hover' value=''>ПОДРОБНЕЕ
              <img src='img/arrowRight.svg'></button>
              <input type='hidden' name='hiddenId[]' class='productsId' value='$row[0]'>
              <input type='hidden' name='hiddenPrice[]' value='$row[4]'>
              <input type='hidden' name='hiddenName[]' value='$row[1]'>
                  
            </a>
          </form>
        </div>";
      }              
    }
  /*ЕСЛИ ВЫБРАНО ВСЕ, ФОРМА И НАЧИНКА*/
  }elseif($countCategory == 1 && $category[0] == 'all' && $form!=null && $filling!=null){
    $countFilling = count($filling);
    $countForm = count($form);
    $notFound = 0;
    /*$numberCicl=0;*/
    for ($ifi=0; $ifi < $countFilling; $ifi++) { 
      for ($ifo=0; $ifo < $countForm; $ifo++) { 
        $query = "SELECT * FROM product WHERE id_form = $form[$ifo] AND id_filling = $filling[$ifi] AND id_category = '1' AND price >= $price1 AND price <= $price2";
        $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
        if($result){
          $rows = mysqli_num_rows($result);
          if ($rows == 0) {
            $notFound += 1;
          }
          for ($j = 0;$j < $rows; $j++) {
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
            echo  "
                  <button type='submit' class='slider-hover' value=''>ПОДРОБНЕЕ
                  <img src='img/arrowRight.svg'></button>
                  <input type='hidden' name='hiddenId[]' class='productsId' value='$row[0]'>
                  <input type='hidden' name='hiddenPrice[]' value='$row[4]'>
                  <input type='hidden' name='hiddenName[]' value='$row[1]'>
                      
                </a>
              </form>
            </div>";
          }
        }
        /*$numberCicl += 1;*/
      }
    }
    $countFormFill = $countFilling * $countForm ;
    /*echo "<div class='resultNull'>notFound - $notFound, countFilling - $countFilling, countForm - $countForm, numberCicl - $numberCicl</div>";*/
    if ($notFound == $countFormFill) {
      $notFound=0;
      echo "<div class='resultNull'>По данному запросу ничего не найдено.</div>";
    }
  /*ЕСЛИ ВЫБРАНО ВСЕ И НАЧИНКА*/
  }elseif($countCategory == 1 && $category[0] == 'all' && $form == null && $filling != null){
    $countFilling = count($filling);
    $notFound = 0;
    for ($ifi=0; $ifi < $countFilling; $ifi++) { 
      $query = "SELECT * FROM product WHERE id_filling = $filling[$ifi] AND id_category = '1' AND price >= $price1 AND price <= $price2";
      $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
      if($result){
        $rows = mysqli_num_rows($result);
        if ($rows == 0) {
          $notFound += 1;
        }
        for ($j = 0;$j < $rows; $j++) {
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
          echo  "
                <button type='submit' class='slider-hover' value=''>ПОДРОБНЕЕ
                <img src='img/arrowRight.svg'></button>
                <input type='hidden' name='hiddenId[]' class='productsId' value='$row[0]'>
                <input type='hidden' name='hiddenPrice[]' value='$row[4]'>
                <input type='hidden' name='hiddenName[]' value='$row[1]'>
                          
              </a>
            </form>
          </div>";
        }
      }
    }
    if ($notFound == $countFilling) {
      echo "<div class='resultNull'>По данному запросу ничего не найдено.</div>";
    }
  /*ЕСЛИ ВЫБРАНО ВСЕ И ФОРМА*/
  }elseif($countCategory == 1 && $category[0] == 'all' && $form != null && $filling == null){
    $countForm = count($form);
    $notFound = 0;
    for ($ifo=0; $ifo < $countForm; $ifo++) { 
      $query = "SELECT * FROM product WHERE id_form = $form[$ifo] AND id_category = '1' AND price >= $price1 AND price <= $price2";
      $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
      if($result){
        $rows = mysqli_num_rows($result);
        if ($rows == 0) {
          $notFound += 1;
        }
        for ($j = 0;$j < $rows; $j++) {
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
          echo  "
                <button type='submit' class='slider-hover' value=''>ПОДРОБНЕЕ
                <img src='img/arrowRight.svg'></button>
                <input type='hidden' name='hiddenId[]' class='productsId' value='$row[0]'>
                <input type='hidden' name='hiddenPrice[]' value='$row[4]'>
                <input type='hidden' name='hiddenName[]' value='$row[1]'>
                      
              </a>
            </form>
          </div>";
        }
      }
    }
    if ($notFound == $countForm) {
      echo "<div class='resultNull'>По данному запросу ничего не найдено.</div>";
    }
  }else{
    for ($i=0; $i < $countCategory; $i++) {
      /*если выбрано всё и что-то еще*/
      if($category[$i] == 'all'){
        continue;
      /*если выбраны торты*/
      }elseif($category[$i] == '1'){
        /*если выбраны начинка и форма*/
        if($form!=null && $filling!=null){
          $countFilling = count($filling);
          $countForm = count($form);
          $notFound = 0;
          for ($ifi=0; $ifi < $countFilling; $ifi++) { 
            for ($ifo=0; $ifo < $countForm; $ifo++) { 
              $query = "SELECT * FROM product WHERE id_form = $form[$ifo] AND id_filling = $filling[$ifi] AND id_category = $category[$i] AND price >= $price1 AND price <= $price2";
              $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
              if($result){
                $rows = mysqli_num_rows($result);
                if ($rows == 0) {
                  $notFound += 1;
                }
                for ($j = 0;$j < $rows; $j++) {
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
                  echo  "
                        <button type='submit' class='slider-hover' value=''>ПОДРОБНЕЕ
                        <img src='img/arrowRight.svg'></button>
                        <input type='hidden' name='hiddenId[]' class='productsId' value='$row[0]'>
                        <input type='hidden' name='hiddenPrice[]' value='$row[4]'>
                        <input type='hidden' name='hiddenName[]' value='$row[1]'>
                            
                      </a>
                    </form>
                  </div>";
                }
              }
            }
          }
          $countFormFill = $countFilling * $countForm ;
          /*echo "<div class='resultNull'>notFound - $notFound, countFormFill - $countFormFill</div>";*/
          if ($notFound == $countFormFill) {
            $notFound=0;
            echo "<div class='resultNull'>По данному запросу ничего не найдено.</div>";
          }
          break;
        /*если форма не выбрана, а начинка выбрана*/
        }elseif($form==null && $filling!=null){
          $countFilling = count($filling);
          $notFound = 0;
          for ($ifi=0; $ifi < $countFilling; $ifi++) { 
            $query = "SELECT * FROM product WHERE id_filling = $filling[$ifi] AND id_category = $category[$i] AND price >= $price1 AND price <= $price2";
            $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
            if($result){
              $rows = mysqli_num_rows($result);
              if ($rows == 0) {
                $notFound += 1;
              }
              for ($j = 0;$j < $rows; $j++) {
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
                echo  "
                      <button type='submit' class='slider-hover' value=''>ПОДРОБНЕЕ
                      <img src='img/arrowRight.svg'></button>
                      <input type='hidden' name='hiddenId[]' class='productsId' value='$row[0]'>
                      <input type='hidden' name='hiddenPrice[]' value='$row[4]'>
                      <input type='hidden' name='hiddenName[]' value='$row[1]'>
                            
                    </a>
                  </form>
                </div>";
              }
            }
          }
          if ($notFound == $countFilling) {
            echo "<div class='resultNull'>По данному запросу ничего не найдено.</div>";
          }
          break;
        /*если форма выбрана, а начинка не выбрана*/
        }elseif($form!=null && $filling==null){
          $countForm = count($form);
          $notFound = 0;
          for ($ifo=0; $ifo < $countForm; $ifo++) { 
            $query = "SELECT * FROM product WHERE id_form = $form[$ifo] AND id_category = $category[$i] AND price >= $price1 AND price <= $price2";
            $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
            if($result){
              $rows = mysqli_num_rows($result);
              if ($rows == 0) {
                $notFound += 1;
              }
              for ($j = 0;$j < $rows; $j++) {
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
                echo  "
                      <button type='submit' class='slider-hover' value=''>ПОДРОБНЕЕ
                      <img src='img/arrowRight.svg'></button>
                      <input type='hidden' name='hiddenId[]' class='productsId' value='$row[0]'>
                      <input type='hidden' name='hiddenPrice[]' value='$row[4]'>
                      <input type='hidden' name='hiddenName[]' value='$row[1]'>
                            
                    </a>
                  </form>
                </div>";
              }
            }
          }
          if ($notFound == $countForm) {
            echo "<div class='resultNull'>По данному запросу ничего не найдено.</div>";
          }
          break;
        /*если форма и начинка не выбраны*/
        }elseif($form==null && $filling==null){
          $query = "SELECT * FROM product WHERE price >= $price1 AND price <= $price2 AND id_category = $category[$i]";
          $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
          if($result){
            $rows = mysqli_num_rows($result);
            if ($rows == 0) {
              echo "<div class='resultNull'>По данному запросу ничего не найдено.</div>";
            }else{
              for ($j = 0;$j < $rows; $j++) {
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
                echo  "
                      <button type='submit' class='slider-hover' value=''>ПОДРОБНЕЕ
                      <img src='img/arrowRight.svg'></button>
                      <input type='hidden' name='hiddenId[]' class='productsId' value='$row[0]'>
                      <input type='hidden' name='hiddenPrice[]' value='$row[4]'>
                      <input type='hidden' name='hiddenName[]' value='$row[1]'>
                          
                    </a>
                  </form>
                </div>";
              }              
            }
              
          }          
        }
      /*всё кроме тортов*/
      }else{
        if($form==null && $filling==null){
          $query = "SELECT * FROM product WHERE price >= $price1 AND price <= $price2 AND id_category = $category[$i]";
          $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
          if($result){
            $rows = mysqli_num_rows($result);
            if ($rows == 0) {
              echo "<div class='resultNull'>По данному запросу ничего не найдено.</div>";
            }else{
              for ($j = 0;$j < $rows; $j++) {
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
                echo  "
                      <button type='submit' class='slider-hover' value=''>ПОДРОБНЕЕ
                      <img src='img/arrowRight.svg'></button>
                      <input type='hidden' name='hiddenId[]' class='productsId' value='$row[0]'>
                      <input type='hidden' name='hiddenPrice[]' value='$row[4]'>
                      <input type='hidden' name='hiddenName[]' value='$row[1]'>
                          
                    </a>
                  </form>
                </div>";
              }               
            }
             
          }          
        }elseif($form!=null || $filling!=null){
          echo "<div class='resultNull'>По данному запросу ничего не найдено.</div>";
          break;
        }

      }
    }
  }
/*если не выбрана категория*/
}else{
  /*если выбраны начинка и форма*/
  if($form!=null && $filling!=null){
    $countFilling = count($filling);
    $countForm = count($form);
    $notFound = 0;
    for ($ifi=0; $ifi < $countFilling; $ifi++) { 
      for ($ifo=0; $ifo < $countForm; $ifo++) { 
        $query = "SELECT * FROM product WHERE id_form = $form[$ifo] AND id_filling = $filling[$ifi] AND id_category = '1' AND price >= $price1 AND price <= $price2";
        $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
        if($result){
          $rows = mysqli_num_rows($result);
          if ($rows == 0) {
            $notFound += 1;
          }
          for ($j = 0;$j < $rows; $j++) {
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
            echo  "
                  <button type='submit' class='slider-hover' value=''>ПОДРОБНЕЕ
                  <img src='img/arrowRight.svg'></button>
                  <input type='hidden' name='hiddenId[]' class='productsId' value='$row[0]'>
                  <input type='hidden' name='hiddenPrice[]' value='$row[4]'>
                  <input type='hidden' name='hiddenName[]' value='$row[1]'>
                      
                </a>
              </form>
            </div>";
          }
        }
      }
    }
    $countFormFill = $countFilling * $countForm ;
    /*echo "<div class='resultNull'>notFound - $notFound, countFormFill - $countFormFill</div>";*/
    if ($notFound == $countFormFill) {
      $notFound=0;
      echo "<div class='resultNull'>По данному запросу ничего не найдено.</div>";
    }
  /*если форма не выбрана, а начинка выбрана*/
  }elseif($form==null && $filling!=null){
    $countFilling = count($filling);
    $notFound = 0;
    for ($ifi=0; $ifi < $countFilling; $ifi++) { 
      $query = "SELECT * FROM product WHERE id_filling = $filling[$ifi] AND id_category = '1' AND price >= $price1 AND price <= $price2";
      $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
      if($result){
        $rows = mysqli_num_rows($result);
        if ($rows == 0) {
          $notFound += 1;
        }
        for ($j = 0;$j < $rows; $j++) {
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
          echo  "
                <button type='submit' class='slider-hover' value=''>ПОДРОБНЕЕ
                <img src='img/arrowRight.svg'></button>
                <input type='hidden' name='hiddenId[]' class='productsId' value='$row[0]'>
                <input type='hidden' name='hiddenPrice[]' value='$row[4]'>
                <input type='hidden' name='hiddenName[]' value='$row[1]'>
                          
              </a>
            </form>
          </div>";
        }
      }
    }
    if ($notFound == $countFilling) {
      echo "<div class='resultNull'>По данному запросу ничего не найдено.</div>";
    }
  /*если форма выбрана, а начинка не выбрана*/
  }elseif($form!=null && $filling==null){
    $countForm = count($form);
    $notFound = 0;
    for ($ifo=0; $ifo < $countForm; $ifo++) { 
      $query = "SELECT * FROM product WHERE id_form = $form[$ifo] AND id_category = '1' AND price >= $price1 AND price <= $price2";
      $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
      if($result){
        $rows = mysqli_num_rows($result);
        if ($rows == 0) {
          $notFound += 1;
        }
        for ($j = 0;$j < $rows; $j++) {
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
          echo  "
                <button type='submit' class='slider-hover' value=''>ПОДРОБНЕЕ
                <img src='img/arrowRight.svg'></button>
                <input type='hidden' name='hiddenId[]' class='productsId' value='$row[0]'>
                <input type='hidden' name='hiddenPrice[]' value='$row[4]'>
                <input type='hidden' name='hiddenName[]' value='$row[1]'>
                      
              </a>
            </form>
          </div>";
        }
      }
    }
    if ($notFound == $countForm) {
      echo "<div class='resultNull'>По данному запросу ничего не найдено.</div>";
    }
  /*если форма и начинка не выбраны*/
  }elseif($form==null && $filling==null){
    $query = "SELECT * FROM product WHERE price >= $price1 AND price <= $price2 AND id_category = '1'";
    $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
    if($result){
      $rows = mysqli_num_rows($result);
      for ($j = 0;$j < $rows; $j++) {
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
        echo  "
              <button type='submit' class='slider-hover' value=''>ПОДРОБНЕЕ
              <img src='img/arrowRight.svg'></button>
              <input type='hidden' name='hiddenId[]' class='productsId' value='$row[0]'>
              <input type='hidden' name='hiddenPrice[]' value='$row[4]'>
              <input type='hidden' name='hiddenName[]' value='$row[1]'>
            
            </a>
          </form>
        </div>";
      }              
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