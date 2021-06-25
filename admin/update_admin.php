<?php
    require_once "pdo.php";

    $id = $_GET['id'];
    $sql = "SELECT * FROM admin WHERE adminID=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id' => $id));
    while( $row = $stmt->fetch()) {
        if ($row > 0) {
            $username = $row['admin_name'];
            $email = $row['admin_email'];
        } else {
            header("Location: manage_admin.php");
        }
    }

    if (isset($_POST['up_submit'])) {
        $username = htmlentities($_POST['username']);
        $email = htmlentities($_POST['email']);

        if ( strlen($username) < 1 || strlen($email) < 1) {
        $_SESSION['up_failure'] = "Username and Email are required";
        header("Location: manage_admin.php");
        return;
        }
        elseif (!strpos($email,'@') ){
          $_SESSION['up_failure'] = "Email must have an at-sign (@)";
          header('Location: manage_admin.php');
          return;
        }

         else{
          $sql = "UPDATE admin SET admin_name=:username, admin_email=:email WHERE adminID=:id";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(array(
              ":id" => $id,
              ":username" => $username,
              ":email" => $email
          ));
          $_SESSION['up_success'] = "Record updated";
          if (isset($_SESSION['up_success']) ) {
              header("Location: manage_admin.php");
              return;
           }
      }
  }
?>

<html>
<?php include('includes/nav.php') ?>
<body>
<section class="container-fluid">
		<section class="row justify-content-center">
			<section class="col-lg-6 col-md-6 col-sm-6 mt-5">
				<div class="card shadow-sm p-3 mb-5 rounded">
                <div class="card-header text-white bg-dark"><h5 class="mt-3">Update Admin<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload ms-2" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
  <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
</svg></h5>
     </div>
    <?php
        if (isset($_SESSION['success']) ) {
            header("Location: manage_admin.php");
            return;
          }
        if (isset($_SESSION['wrong_pass']) ) {
                 echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['wrong_pass']).'</div>');
                 unset($_SESSION['wrong_pass']);
               }
     ?>
        <form action="" method="POST">
        <div class="form-floating mb-3 mt-4 ms-4 me-4">
                <input type="text" value="<?= $username?>" name="username" class="form-control" aria-describedby="username" placeholder="Username">
                <label for="name" class="form-label">Username</label>
        </div>
        <div class="form-floating mt-4 ms-4 me-4">
                <input type="text" value="<?= $email?>" name="email" class="form-control" aria-describedby="email"  placeholder="Email">
                <label for="email" class="form-label">Email address</label>
        </div>
        <input type="hidden" name="id" value="<?= $id?>">
        <div class="d-flex justify-content-center">
                    <button type="submit" name="up_submit" class="btn btn-dark mt-4 mb-4 me-2 ps-5 pe-5">Submit</button>
                    <a href="update_password.php?id=<?= $id ?>"  name="pass_submit" class="btn btn-dark ms-2 mt-4 mb-4">Change Password</a>
        </div>
        </form>
        </div>
        </section>
        </section>
        </section>
        <?php include('includes/footer.php') ?>
</body>
</html>
