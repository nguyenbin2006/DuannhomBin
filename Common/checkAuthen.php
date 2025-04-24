<?php 
    session_start();
    if(
        !isset($_SESSION["UserLogin"]) || // vị trí sai (thiếu dấu chấm than )
        $_SESSION["RoleLogin"] != 0
    )
    {
        header("location:../login.php?msg=Please Login");
    }
?>