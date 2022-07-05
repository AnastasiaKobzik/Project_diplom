<?php
include "../../db/dbConnect.php";
global $dbLink;

  if(!empty($_POST["email"]) && !empty($_POST["password"])){
    $url = $_POST["url"];
    $password = md5($_POST["password"]).$salt;
    $name = $_POST["name"];
    $email = $_POST["email"];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($dbLink, $query) or die("Ошибка БД");
    $resultRow = mysqli_fetch_assoc($result);          
    if (!empty($resultRow["id_user"])){             
          
        if ($resultRow["password"] == $password){      
          if(session_status()!=PHP_SESSION_ACTIVE) session_start();        
          
          $_SESSION["name"] = $resultRow["name"];            
          $_SESSION["login"] = $email;                
          $_SESSION["id_user"] = $resultRow["id_user"];                    
          mysqli_close($dbLink);                    
          print "<script language='Javascript' type='text/javascript'>
                  location.reload();
                </script>";
        }
        else{
          echo "Неверный пароль";
        }
      
    }
    else{
      $queryAdmin = "SELECT * FROM admin WHERE email = '$email'";
      $resultAdmin = mysqli_query($dbLink, $queryAdmin) or die("Ошибка БД");
      $resultRowAdmin = mysqli_fetch_assoc($resultAdmin);
      if (!empty($resultRowAdmin["id_admin"])){
        
          if ($resultRowAdmin["password"] == $password){
            if(session_status()!=PHP_SESSION_ACTIVE) session_start();

            $_SESSION["adminName"] = $resultRowAdmin["name"];
            $_SESSION["id_admin"] = $resultRowAdmin["id_admin"];
            mysqli_close($dbLink);
            print "<script language='Javascript' type='text/javascript'>
                    function reload(){top.location = 'indexAdmin.php'};
                    setTimeout('reload()', 0);
                  </script>";
          }else{
            echo "Неверный пароль*";
          }
      }else{
        $queryCourier = "SELECT * FROM couriers WHERE email = '$email'";
        $resultCourier = mysqli_query($dbLink, $queryCourier) or die("Ошибка БД");
        $resultRowCourier = mysqli_fetch_assoc($resultCourier);
        if (!empty($resultRowCourier["id_courier"])){
          
            if ($resultRowCourier["password"] == $password){
              if(session_status()!=PHP_SESSION_ACTIVE) session_start();

              $_SESSION["courierName"] = $resultRowCourier["name"];
              $_SESSION["id_courier"] = $resultRowCourier["id_courier"];
              mysqli_close($dbLink);
              print "<script language='Javascript' type='text/javascript'>
                      function reload(){top.location = 'indexCourier.php'};
                      setTimeout('reload()', 0);
                    </script>";
            }else{
              echo "Неверный пароль*";
            }
        }else{
          echo "Такого пользователя не существует";
        }
      }
    }    
  }else{
  echo "Заполните все поля";
  }

?>