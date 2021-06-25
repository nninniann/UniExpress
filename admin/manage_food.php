<html>
<body>
    <?php include('includes/nav.php') ?>
    <div class="mt-4 mb-4 d-flex justify-content-center align-items-center">
        <h2 class="me-4">Food Management</h2>
        <a href="add_food.php" class="btn btn-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus-fill me-2 mb-1" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z"/>
</svg>Add Food</a>
        </div>
        <?php 
    if (isset($_SESSION['food_success']) ) {
        echo('<div class="alert alert-success" role="alert">'.htmlentities($_SESSION['food_success']).'</div>');
        unset($_SESSION['food_success']);
     }
     if (isset($_SESSION['up_fail']) ) {
        echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['up_fail']).'</div>');
        unset($_SESSION['up_fail']);
     }
     if (isset($_SESSION['del_fail']) ) {
      echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['del_fail']).'</div>');
      unset($_SESSION['del_fail']);
   }
   if (isset($_SESSION['delfood_success']) ) {
    echo('<div class="alert alert-success" role="alert">'.htmlentities($_SESSION['delfood_success']).'</div>');
    unset($_SESSION['delfood_success']);
 }
 if (isset($_SESSION['up_fail']) ) {
  echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['up_fail']).'</div>');
  unset($_SESSION['up_fail']);
}
if (isset($_SESSION['foodup_success']) ) {
  echo('<div class="alert alert-success" role="alert">'.htmlentities($_SESSION['foodup_success']).'</div>');
  unset($_SESSION['foodup_success']);
}
     ?>
<section class="main-content">
        <div class="container-fluid">
    <?php
    $no = 1;
    $sql = "SELECT * FROM food";
    $stmt = $pdo->prepare($sql);
$stmt->execute(); ?>
<table class="table table-bordered table-hover">
   <thead class="table-dark text-center">
     <tr>
       <th scope="col">No</th>
       <th scope="col">Food Name</th>
       <th scope="col">Food Description</th>
      <th scope="col">Food Price</th>
      <th scope="col">Food Image</th>
      <th scope="col">Action</th>
     </tr>
   </thead>
<?php while( $row = $stmt->fetch()) {  
  $id=htmlentities($row['foodID']);
  $foodimg=htmlentities($row['food_image']);
  ?>
   <tbody>
     <tr class="align-middle" style="text-align: center">
       <td><?php echo $no++ ?></td>
       <td><?php echo htmlentities($row['food_name']); ?></td>
       <td><?php echo htmlentities($row['food_description']); ?></td>
       <td><?php echo htmlentities($row['food_price']); ?></td>
       <td ><?php if ($row['food_image'] == "") {
           echo "No image added";
       } else { ?>
        <img width="150" src="<?php echo "../"?>images/food/<?php echo $row['food_image']; ?>">
       <?php } ?>
        </td>
       <td><a href="update_food.php?id=<?= $id ?>" class="btn btn-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
  <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
</svg> Update Food</a>
       <a href="#" data-toggle="modal" data-target="#confirm-delete" class="btn btn-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
</svg> Delete Food</a></td>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-light bg-dark text-white">
                Are you sure you want to delete?
            </div>
            <div class="modal-body">
            This record will be permanently removed.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="delete_food.php?id=<?= $id?>&image=<?= $foodimg;?>" class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>
     </tr>
  </tbody>
 <?php } ?>
</table>
</div>
</section>
<?php include('includes/footer.php') ?>
</body>
</html>