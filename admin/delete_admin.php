<?php 
    require_once "pdo.php";
    session_start();

    $id = $_GET['id'];
    $sql = "DELETE FROM admin WHERE adminID= :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id' => $id));
    $_SESSION['del_success'] = "Record deleted";
    if (isset($_SESSION['del_success']) ) {
        header("Location: manage_admin.php");
        return;
     }
?>