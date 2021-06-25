<?php 
    session_start();
    unset($_SESSION['redirect']);
    session_destroy();
    header("Location: admin_login.php");
    return;
?>