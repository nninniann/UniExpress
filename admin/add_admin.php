<?php include('includes/nav.php');

    if(isset($_POST['submit'])) {
    $username = htmlentities($_POST['username']);
    $email = htmlentities($_POST['email']);
    $password = htmlentities(md5($_POST['password']));


      if ( strlen($username) < 1 || strlen($email) < 1 || strlen($password) < 1) {
        $_SESSION['failure'] = "Username, Email and Password are required";
        header('Location: add_admin.php');
        return;
      }
      elseif (!strpos($_POST['email'],'@') ){
        $_SESSION['failure'] = "Email must have an at-sign (@)";
        header('Location: add_admin.php');
        return;
      }
      else {

          if (strlen($_POST["password"]) < '8') {
             $_SESSION['failure'] = "Your Password Must Contain At Least 8 Characters!";
             header('Location: add_admin.php');
             return;
           }
          elseif (!preg_match("#[0-9]+#", $_POST["password"])) {
                $_SESSION['failure'] = "Your Password Must Contain At Least 1 Number!";
                header('Location: add_admin.php');
                return;
            }
          elseif (!preg_match("#[A-Z]+#",$_POST["password"])) {
                  $_SESSION['failure'] = "Your Password Must Contain At Least 1 Capital Letter!";
                  header('Location: add_admin.php');
                  return;
              }
              else {
                $sql = "INSERT INTO admin (admin_name, admin_email, admin_password) VALUES (:username, :email, :password)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':username'=> $username,
                    ':email'=> $email,
                    ':password'=> $password,
                ));
                $_SESSION['success'] = "Record inserted";
                if (isset($_SESSION['success']) ) {
                    header("Location: manage_admin.php");
                    return;
                 }
              }
        }
      }

?>
<html>
<body>
<section class="container-fluid">
		<section class="row justify-content-center">
			<section class="col-lg-6 col-md-6 col-sm-6 mt-5">
				<div class="card shadow-sm p-3 mb-5 rounded">
                <div class="card-header text-white bg-dark"><h5 class="mt-3">Add Admin<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-person-fill ms-2 mb-2" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg></h5>
            </div>
      <?php
           if (isset($_SESSION['failure']) ) {
              echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['failure']).'</div>');
              unset($_SESSION['failure']);
           }
      ?>
        <form action="" method="POST">
        <div class="form-floating mb-3 mt-4 ms-4 me-4">
                    <input type="text" name="username" class="form-control" aria-describedby="username" placeholder="Username">
                    <label for="name" class="form-label">Username</label>
            </div>
            <div class="form-floating mt-4 ms-4 me-4">
                <input type="text" name="email" class="form-control" aria-describedby="email"  placeholder="Email">
                <label for="name" class="form-label">Email address</label>
             </div>
             <div class="form-floating mt-4 ms-4 me-4">
                <input type="password" name="password" class="form-control" aria-describedby="password" placeholder="Password">
                <label for="password" class="form-label">Password</label>
            </div>
            <div class="d-flex justify-content-center">
                    <button type="submit" name="submit" class="btn btn-dark mt-4 mb-4 ps-5 pe-5">Submit</button>
        </div>
        </form>
    </div>
        </section>
        </section>
        </section>
        <?php include('includes/footer.php') ?>
</body>
</html>
