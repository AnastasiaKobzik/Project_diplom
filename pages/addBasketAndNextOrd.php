<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
global $dbLink;

include "../db/dbConnect.php";
$idProd = $_POST['hiddenId'];
$idUser = $_SESSION['id_user'];
$form = $_POST['form'];
$filling = $_POST['filling'];
$weight = $_POST['weight'];
$col = $_POST['col'];
$summa = $_POST['summa'];

$queryPr = "SELECT * FROM product WHERE id_product = $idProd";
$resultPr=mysqli_query($dbLink, $queryPr) or die("Ошибка".mysqli_error($dbLink));
$rowPr = mysqli_fetch_row($resultPr);
if($resultPr){
  /*если это торт*/
  if ($rowPr[5]==1){
    /*если форма и начинка не выбраны*/
    if($filling==null && $form==null){
      $queryAll = "SELECT * FROM basket WHERE id_product = '$idProd' AND id_user = '$idUser' AND form = '$rowPr[6]' AND filling = '$rowPr[7]' AND weight = '$weight' AND quantity = '$col' AND price = '$summa'";
      $resultAll=mysqli_query($dbLink, $queryAll) or die("Ошибка".mysqli_error($dbLink));
      $row = mysqli_fetch_row($resultAll);
      if(!$row){
        $queryInsert = "INSERT INTO basket (id_product, id_user, weight, quantity, form, filling, price, id_decoration, in_stock) VALUES ('$idProd', '$idUser', '$weight', '$col', '$rowPr[6]', '$rowPr[7]', '$summa', null, 1)";
        $resultInsert=mysqli_query($dbLink, $queryInsert) or die("Ошибка".mysqli_error($dbLink));

        if($resultInsert){
          print "<script language='Javascript' type='text/javascript'>
                  
                  function reload(){top.location = 'basket.php'};
                  setTimeout('reload()', 0);
              </script>";
        }
        
      }else {
        print "<script language='Javascript' type='text/javascript'>
                  function reload(){top.location = 'basket.php'};
                  setTimeout('reload()', 0);
              </script>";
      }


    /*если форма не выбрана а начинка выбрана*/
    }elseif($filling!=null && $form==null){
      $queryAll = "SELECT * FROM basket WHERE id_product = '$idProd' AND id_user = '$idUser' AND form = '$rowPr[6]' AND filling = '$filling' AND weight = '$weight' AND quantity = '$col' AND price = '$summa'";
      $resultAll=mysqli_query($dbLink, $queryAll) or die("Ошибка".mysqli_error($dbLink));
      $row = mysqli_fetch_row($resultAll);
      if(!$row){
        $queryInsert = "INSERT INTO basket (id_product, id_user, weight, quantity, form, filling, price, id_decoration, in_stock) VALUES ('$idProd', '$idUser', '$weight', '$col', '$rowPr[6]', '$filling', '$summa', null, 1)";
        $resultInsert=mysqli_query($dbLink, $queryInsert) or die("Ошибка".mysqli_error($dbLink));

        if($resultInsert){
          print "<script language='Javascript' type='text/javascript'>
                  
                  function reload(){top.location = 'basket.php'};
                  setTimeout('reload()', 0);
              </script>";
        }
        
      }else {
        print "<script language='Javascript' type='text/javascript'>
                  function reload(){top.location = 'basket.php'};
                  setTimeout('reload()', 0);
              </script>";
      }
    /*если форма выбрана а начинка не выбрана*/
    }elseif($filling==null && $form!=null){
      $queryAll = "SELECT * FROM basket WHERE id_product = '$idProd' AND id_user = '$idUser' AND form = '$form' AND filling = '$rowPr[7]' AND weight = '$weight' AND quantity = '$col' AND price = '$summa'";
      $resultAll=mysqli_query($dbLink, $queryAll) or die("Ошибка".mysqli_error($dbLink));
      $row = mysqli_fetch_row($resultAll);
      if(!$row){
        $queryInsert = "INSERT INTO basket (id_product, id_user, weight, quantity, form, filling, price, id_decoration, in_stock) VALUES ('$idProd', '$idUser', '$weight', '$col', '$form', '$rowPr[7]', '$summa', null, 1)";
        $resultInsert=mysqli_query($dbLink, $queryInsert) or die("Ошибка".mysqli_error($dbLink));

        if($resultInsert){
          print "<script language='Javascript' type='text/javascript'>
                  function reload(){top.location = 'basket.php'};
                  setTimeout('reload()', 0);
              </script>";
        }
        
      }else {
        print "<script language='Javascript' type='text/javascript'>
                  function reload(){top.location = 'basket.php'};
                  setTimeout('reload()', 0);
              </script>";
      }
    /*если форма и начинка выбраны*/  
    }else{
      $queryAll = "SELECT * FROM basket WHERE id_product = '$idProd' AND id_user = '$idUser' AND form = '$form' AND filling = '$filling' AND weight = '$weight' AND quantity = '$col' AND price = '$summa'";
      $resultAll=mysqli_query($dbLink, $queryAll) or die("Ошибка".mysqli_error($dbLink));
      $row = mysqli_fetch_row($resultAll);
      if(!$row){
        $queryInsert = "INSERT INTO basket (id_product, id_user, weight, quantity, form, filling, price, id_decoration, in_stock) VALUES ('$idProd', '$idUser', '$weight', '$col', '$form', '$filling', '$summa', null, 1)";
        $resultInsert=mysqli_query($dbLink, $queryInsert) or die("Ошибка".mysqli_error($dbLink));

        if($resultInsert){
          print "<script language='Javascript' type='text/javascript'>
                  function reload(){top.location = 'basket.php'};
                  setTimeout('reload()', 0);
              </script>";
        }
        
      }else {
        print "<script language='Javascript' type='text/javascript'>
                  function reload(){top.location = 'basket.php'};
                  setTimeout('reload()', 0);
              </script>";
      }
    }

  /*если это не торт*/
  }else{
    $queryAll = "SELECT * FROM basket WHERE id_product = '$idProd' AND id_user = '$idUser' AND quantity = '$col' AND price = '$summa'";
      $resultAll=mysqli_query($dbLink, $queryAll) or die("Ошибка".mysqli_error($dbLink));
      $row = mysqli_fetch_row($resultAll);
      if($row==null){
        $queryInsert = "INSERT INTO basket (id_product, id_user, weight, quantity, price, id_decoration, in_stock) VALUES ('$idProd', '$idUser', '$rowPr[8]', '$col', '$summa', null, 1)";
        $resultInsert=mysqli_query($dbLink, $queryInsert) or die("Ошибка".mysqli_error($dbLink));

        if($resultInsert){
        print "<script language='Javascript' type='text/javascript'>
                  function reload(){top.location = 'basket.php'};
                  setTimeout('reload()', 0);
              </script>";
        }
        
      }else {
        print "<script language='Javascript' type='text/javascript'>
                  function reload(){top.location = 'basket.php'};
                  setTimeout('reload()', 0);
              </script>";
      }
  }
}


/*$queryAll = "SELECT * FROM basketuser WHERE id_product = '$idProd' AND id_user = '$idUser' AND form = '$form' AND filling = '$filling' AND weight = '$weight' AND quantity = '$col' AND price = '$summa'";
$resultAll=mysqli_query($dbLink, $queryAll) or die("Ошибка".mysqli_error($dbLink));
$row = mysqli_fetch_row($resultAll);
if(!$row){

}

$queryInsert = "INSERT INTO basket (id_product, id_user, weight, quantity, form, filling, price) VALUES ('$idProd', '$idUser', '$weight', '$col', '$form', '$filling', '$summa')";
$resultInsert=mysqli_query($dbLink, $queryInsert) or die("Ошибка".mysqli_error($dbLink));*/



          
mysqli_close($dbLink);        
?>
  
