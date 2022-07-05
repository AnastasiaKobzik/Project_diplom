<?php
if($_POST["submit"] == "Да"){
    session_start();
    if($_SESSION['name']!=''){
        unset($_SESSION['name']);
        unset($_SESSION["login"]);
        unset($_SESSION["id_user"]);
        print "<script language='Javascript' type='text/javascript'>
                
                function reload(){
                    top.location = 'index.php'};
                setTimeout('reload()', 0);
                </script>";
    }elseif($_SESSION['adminName']!=''){
        unset($_SESSION['adminName']);
        unset($_SESSION["id_admin"]);
        print "<script language='Javascript' type='text/javascript'>
                
                function reload(){
                    top.location = 'index.php'};
                setTimeout('reload()', 0);
                </script>";
    }elseif($_SESSION['courierName']!=''){
        unset($_SESSION['courierName']);
        unset($_SESSION["id_courier"]);
        print "<script language='Javascript' type='text/javascript'>
                
                function reload(){
                    top.location = 'index.php'};
                setTimeout('reload()', 0);
                </script>";
    }
}
?>
<div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-auto">
        <form method="post" class="formLogOut">
          <p>Вы уверены, что хотите Выйти?</p>
          <div class="butLogOut">
            <input name="submit" type="submit" class="btn" value="Да">
            <input name="submit" type="submit" class="btn" data-dismiss="modal" value="Нет">
          </div>
          
        </form>
      </div>
    </div>
  </div>