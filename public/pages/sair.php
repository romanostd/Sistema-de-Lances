<?php
// teste de segurança
    session_start();
    unset($_SESSION["user_portal"]);
    header("location:login.php");

    if ( !isset($_SESSION["user_portal"]) ) {
        header("location:login.php");
    }
?>

