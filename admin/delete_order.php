<?php session_start();
require_once("pdo.php");

      if (isset($_GET['id'])) {
          $id = $_GET['id'];

          $sql = "DELETE FROM food_order WHERE orderID=:id";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(':id' => $id));
          $_SESSION['delorder_success'] = "Record deleted";
          if (isset($_SESSION['delorder_success']) ) {
              header("Location: manage_order.php");
              return;
           }
      }
  ?>