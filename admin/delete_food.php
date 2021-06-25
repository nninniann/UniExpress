<?php session_start();
require_once("pdo.php");

      if (isset($_GET['id']) && isset($_GET['image'])) {
          $id = $_GET['id'];
          $image = $_GET['image'];
  
          if ($image != "") {
              $path = "../images/food/".$image;
              $del = unlink($path);
          }
  
          $sql = "DELETE FROM food WHERE foodID=:id";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(':id' => $id));
          $_SESSION['delfood_success'] = "Record deleted";
          if (isset($_SESSION['delfood_success']) ) {
              header("Location: manage_food.php");
              return;
           }
      }
  ?>