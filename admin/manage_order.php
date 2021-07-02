<html>
<body>
    <?php include('includes/nav.php') ?>
    <div class="mt-4 mb-4 d-flex justify-content-center align-items-center">
        <h2 class="me-2">Order Management</h2>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentcolor" class="bi bi-ui-checks mb-2" viewBox="0 0 16 16">
  <path d="M7 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zM2 1a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm0 8a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2v-2a2 2 0 0 0-2-2H2zm.854-3.646a.5.5 0 0 1-.708 0l-1-1a.5.5 0 1 1 .708-.708l.646.647 1.646-1.647a.5.5 0 1 1 .708.708l-2 2zm0 8a.5.5 0 0 1-.708 0l-1-1a.5.5 0 0 1 .708-.708l.646.647 1.646-1.647a.5.5 0 0 1 .708.708l-2 2zM7 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm0-5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
</svg>
<!-- <a href="search.php" class="ms-3 btn btn-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search ms-2 me-2" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg>Search</a> -->
        </div>
    <?php 
    if (isset($_SESSION['orderup_success']) ) {
        echo('<div class="alert alert-success" role="alert">'.htmlentities($_SESSION['orderup_success']).'</div>');
        unset($_SESSION['orderup_success']);
     }
     if (isset($_SESSION['orderup_fail']) ) {
        echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['orderup_fail']).'</div>');
        unset($_SESSION['orderup_fail']);
     }
     if (isset($_SESSION['delorder_success']) ) {
      echo('<div class="alert alert-success" role="alert">'.htmlentities($_SESSION['delorder_success']).'</div>');
      unset($_SESSION['delorder_success']);
   }
     ?>
     <section class="main-content">
        <div class="container-fluid">
    <?php
    $no = 1;
    $sql = "SELECT orderID, food_name, quantity, order_price, cust_name, order_date, order_status FROM food_order JOIN customer JOIN food ON food_order.foodID = food.foodID AND food_order.customerID = customer.customerID";
    $stmt = $pdo->prepare($sql);
$stmt->execute(); ?>
<table class="table table-bordered table-hover">
   <thead class="table-dark text-center align-middle">
     <tr>
       <th scope="col">No</th>
       <th scope="col">Food Name</th>
       <th scope="col">Food Quantity</th>
      <th scope="col">Total Price</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Order Date</th>
      <th scope="col">Order Status</th>
      <th scope="col">Action</th>
     </tr>
   </thead>
<?php while( $row = $stmt->fetch()) {  
  $id=htmlentities($row['orderID']);
  ?>
   <tbody>
     <tr class="align-middle" style="text-align: center">
       <td><?= $no++ ?></td>
       <td><?= htmlentities($row['food_name']); ?></td>
       <td><?= htmlentities($row['quantity']); ?></td>
       <td><?= htmlentities($row['order_price']); ?></td>
       <td><?= htmlentities($row['cust_name']); ?></td>
       <td><?= htmlentities($row['order_date']); ?></td>
       <td><?= htmlentities($row['order_status']); ?></td>
       <td> <a href="update_order.php?id=<?= $id ?>" class="btn btn-dark order-btn mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload me-1" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
  <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
</svg>Update Order Status</a>
       <a href="delete_order.php?id=<?= $id?>"  class="btn btn-dark order-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
</svg> Delete Order</a></td>
     </tr>
  </tbody>
 <?php } ?>
</table>
</div>
</section>
<?php include('includes/footer.php') ?>
</body>
</html>