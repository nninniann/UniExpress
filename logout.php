<?php 
    session_start();
    unset($_SESSION['custID']);
    unset($_SESSION['customer']);
    session_destroy();
    header("Location: index.php");
    return;
?>