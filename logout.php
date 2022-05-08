<?php
    require_once("./modules/int.php");
    
    if (isset($_SESSION['adminID'])) {
        unset($_SESSION['adminID']);
        //setcookie("adminID", null, -1, "/");
    }
    
    Header("Location: /");
    die();
?>