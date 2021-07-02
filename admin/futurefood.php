<?php
    session_start();
    sleep(5);
    header('Content-Type: application/json; charset=utf-8');
    if ( !isset($_SESSION['food']) ) $_SESSION['food'] = array();
    echo(json_encode($_SESSION['food']));
?>