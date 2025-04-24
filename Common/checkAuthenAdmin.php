<?php 
    session_start();
    if(
        !isset($_SESSION["UserLogin"]) || // vị trí sai (thiếu dấu chấm than )
        $_SESSION["RoleLogin"] != 1
    )
    {
        header("location:../login.php?msg=Please Login");
    }
?>