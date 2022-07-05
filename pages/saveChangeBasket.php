<?php

include "../db/dbConnect.php";
$idBasket = $_POST['idBasket'];
$idProd = $_POST['idProd'];
$weight = $_POST['weight'];
$col = $_POST['col'];
$form = $_POST['form'];
$filling = $_POST['filling'];
$decor = $_POST['decor'];
$summa = $_POST['summa'];
$queryBasket = "SELECT * FROM basket WHERE id_basket = $idBasket";
$resultBasket = mysqli_query($dbLink, $queryBasket) or die("Ошибка БД");
$rowBasket = mysqli_fetch_row($resultBasket);

$queryProd = "SELECT * FROM product WHERE id_product = $idProd";  
$resultProd = mysqli_query($dbLink, $queryProd) or die("Ошибка БД");
$rowProd = mysqli_fetch_row($resultProd);
/*если это торт*/
if ($rowProd[5]==1){
  /*если форма и начинка не выбраны*/
  if($filling==null && $form==null){
    /*усли декор не выбран*/
    if($decor == null){
      $queryChange = "UPDATE basket SET weight=$weight, quantity=$col, price=$summa, id_decoration=null WHERE id_basket = $idBasket";  
      $resultChange = mysqli_query($dbLink, $queryChange) or die("Ошибка БД1");

      print "<script language='Javascript' type='text/javascript'>
              location.reload();
             </script>";
    }else{

      $queryChange = "UPDATE basket SET weight=$weight, quantity=$col, price=$summa, id_decoration=$decor WHERE id_basket = $idBasket";  
      $resultChange = mysqli_query($dbLink, $queryChange) or die("Ошибка БД3");

      print "<script language='Javascript' type='text/javascript'>
              location.reload();
             </script>";
    }
  /*если форма выбрана а начинка нет*/
  }elseif($filling==null && $form!=null){
    /*усли декор не выбран*/
    if($decor == null){      
      $queryChange = "UPDATE basket SET form=$form, weight=$weight, quantity=$col, price=$summa, id_decoration=null WHERE id_basket = $idBasket";  
      $resultChange = mysqli_query($dbLink, $queryChange) or die("Ошибка БД1");

      print "<script language='Javascript' type='text/javascript'>
              location.reload();
             </script>";
    }else{

      $queryChange = "UPDATE basket SET form=$form, weight=$weight, quantity=$col, price=$summa, id_decoration=$decor WHERE id_basket = $idBasket";  
      $resultChange = mysqli_query($dbLink, $queryChange) or die("Ошибка БД3");

      print "<script language='Javascript' type='text/javascript'>
              location.reload();
             </script>";
    }
  /*если форма не выбрана а начинка выбрана*/
  }elseif($filling!=null && $form==null){
    /*усли декор не выбран*/
    if($decor == null){      
      $queryChange = "UPDATE basket SET filling=$filling, weight=$weight, quantity=$col, price=$summa, id_decoration=null WHERE id_basket = $idBasket";  
      $resultChange = mysqli_query($dbLink, $queryChange) or die("Ошибка БД1");

      print "<script language='Javascript' type='text/javascript'>
              location.reload();
             </script>";
    }else{

      $queryChange = "UPDATE basket SET filling=$filling, weight=$weight, quantity=$col, price=$summa, id_decoration=$decor WHERE id_basket = $idBasket";  
      $resultChange = mysqli_query($dbLink, $queryChange) or die("Ошибка БД3");

      print "<script language='Javascript' type='text/javascript'>
              location.reload();
             </script>";
    }
  /*если форма и начинка выбраны*/  
  }else{
    /*усли декор не выбран*/
    if($decor == null){
      $queryChange = "UPDATE basket SET form=$form, filling=$filling, weight=$weight, quantity=$col, price=$summa, id_decoration=null WHERE id_basket = $idBasket";  
      $resultChange = mysqli_query($dbLink, $queryChange) or die("Ошибка БД1");

      print "<script language='Javascript' type='text/javascript'>
              location.reload();
             </script>";
    }else{
      $queryChange = "UPDATE basket SET form=$form, filling=$filling, weight=$weight, quantity=$col, price=$summa, id_decoration=$decor WHERE id_basket = $idBasket";  
      $resultChange = mysqli_query($dbLink, $queryChange) or die("Ошибка БД3");

      print "<script language='Javascript' type='text/javascript'>
              location.reload();
             </script>";
    }
  }
/*если это не торт*/
}else{
  /*усли декор не выбран*/
  if($decor == null){
      $queryChange = "UPDATE basket SET quantity=$col, price=$summa, id_decoration=null WHERE id_basket = $idBasket";  
      $resultChange = mysqli_query($dbLink, $queryChange) or die("Ошибка БД1");

      print "<script language='Javascript' type='text/javascript'>
              location.reload();
             </script>";
  }else{

      $queryChange = "UPDATE basket SET quantity=$col, price=$summa, id_decoration=$decor WHERE id_basket = $idBasket";  
      $resultChange = mysqli_query($dbLink, $queryChange) or die("Ошибка БД3");

      print "<script language='Javascript' type='text/javascript'>
              location.reload();
             </script>";
  }
}
              
mysqli_close($dbLink);

?>