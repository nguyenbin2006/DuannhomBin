<?php 
    require "../Common/checkAuthenAdmin.php";
    if(session_status()== PHP_SESSION_NONE){
        session_start();//Chi khoi dong session neu chua co session nao chay
    }
    echo"<h1>Hello Admin".$_SESSION['NameLogin']."</h1>"
?>

