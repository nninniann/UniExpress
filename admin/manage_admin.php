<html>
<?php include('includes/nav.php') ?>
<body>
    <section class="title">
      <div class="mt-4 mb-4 d-flex justify-content-center align-items-center">
        <h2 class="me-4">Admin Management</h2>
        <a href="add_admin.php" class="btn btn-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill me-2 mb-1" viewBox="0 0 16 16">
  <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
  <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
</svg>Add Admin</a>
        </div>
        <?php
    if (isset($_SESSION['success']) ) {
        echo('<div class="alert alert-success" role="alert">'.htmlentities($_SESSION['success']).'</div>');
        unset($_SESSION['success']);
     }
     if (isset($_SESSION['del_success']) ) {
      echo('<div class="alert alert-success" role="alert">'.htmlentities($_SESSION['del_success']).'</div>');
      unset($_SESSION['del_success']);
    }
    if (isset($_SESSION['up_success']) ) {
      echo('<div class="alert alert-success" role="alert">'.htmlentities($_SESSION['up_success']).'</div>');
      unset($_SESSION['up_success']);
   }
   if (isset($_SESSION['up_failure']) ) {
     echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['up_failure']).'</div>');
     unset($_SESSION['up_failure']);
  }
   if (isset($_SESSION['not_match']) ) {
    echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['not_match']).'</div>');
    unset($_SESSION['not_match']);
  }
    if (isset($_SESSION['wrong_pass']) ) {
      echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['wrong_pass']).'</div>');
      unset($_SESSION['wrong_pass']);
    }
    if (isset($_SESSION['pass_failure']) ) {
      echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['pass_failure']).'</div>');
      unset($_SESSION['pass_failure']);
    }
    if (isset($_SESSION['change_success']) ) {
      echo('<div class="alert alert-success" role="alert">'.htmlentities($_SESSION['change_success']).'</div>');
      unset($_SESSION['change_success']);
    }
    if (isset($_SESSION['pass_fail']) ) {
      echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['pass_fail']).'</div>');
      unset($_SESSION['pass_fail']);
    }
     ?>
    </section>
    <section class="main-content">
        <div class="container-fluid">
<?php
$no = 1;
$sql = "SELECT adminID, admin_name, admin_email, admin_password FROM admin";
$stmt = $pdo->prepare($sql);
$stmt->execute(); ?>
<table class="table table-bordered table-hover">
   <thead class="table-dark text-center">
     <tr>
       <th scope="col">No</th>
       <th scope="col">Name</th>
       <th scope="col">Email</th>
      <th scope="col">Action</th>
     </tr>
   </thead>
<?php while( $row = $stmt->fetch()) {  
  $id=htmlentities($row['adminID']) ?>
   <tbody>
     <tr class="align-middle" style="text-align: center">
       <td><?php echo $no++ ?></td>
       <td><?php echo htmlentities($row['admin_name']); ?></td>
       <td><?php echo htmlentities($row['admin_email']); ?></td>
       <td> <a href="update_admin.php?id=<?= $id ?>" class="btn btn-dark mb-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
  <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
</svg> Update Admin</a>
       <a href="delete_admin.php?id=<?= $id?>"  class="btn btn-dark mb-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
</svg> Delete Admin</a></td>
</tr>
</tbody>
<?php } ?>
</table>
</div>
</section>
<?php include('includes/footer.php') ?>
</body>
</html>