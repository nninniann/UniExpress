<?php session_start();
require_once("pdo.php");


      if (isset($_GET['id']) && isset($_GET['image'])) {
          $foodid = $_GET['id'];
          $image = $_GET['image'];
  
          if ($image != "") {
              $path = "../images/food/".$image;
              $del = unlink($path);
          }
  
          $sql = "DELETE FROM food WHERE foodID=:id";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(':id' => $foodid));
          $_SESSION['delfood_success'] = "Record deleted";
          if (isset($_SESSION['delfood_success']) ) {
              header("Location: manage_food.php");
              return;
           }
      }
  ?>
  <script>
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>