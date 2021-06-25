<?php 
require_once "pdo.php";
session_start();

    if (isset($_POST['login_submit'])) {
        $username = htmlentities($_POST['username']);
        $password = htmlentities(md5($_POST['password']));
      if ( strlen($username) < 1 || strlen($password) < 1 ) {
          $_SESSION['error_login'] = "Username and Password are required";
          header('Location: admin_login.php');
          return;
        }
        else {
        $sql = "SELECT * FROM admin WHERE admin_name=:name AND admin_password = :password";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':name' => $username, ':password' => $password));
        $row = $stmt->fetchAll();
        if ($row) {
                $_SESSION['login'] = "Logged In successfully";
                $_SESSION['redirect'] = $username;
                header("Location: index.php");
                return;
        } else {
            $_SESSION['error_login'] = "Invalid Username and Password";
            header("Location: admin_login.php");
            return;
        }
      }
    }
?>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="includes/adminstyles.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
    <title>Midlights</title>
    <style>
    .form-control:focus {
        border-color: black;
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.5);
    }

    .p-3 {
         padding: 0!important;
    }
    </style>
</head>
<body>
<section class="container-fluid">
		<section class="row justify-content-center">
			<section class="col-lg-6 col-md-6 col-sm-6 mt-5">
				<div class="card shadow-sm p-3 mb-5 rounded">
                <div class="card-header text-white bg-dark"><h5 class="mt-3">Welcome back to Midlights, Admin<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-person-fill ms-2 mb-2" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg></h5>
            </div>
                <?php
                     if (isset($_SESSION['wrong_login']) ) {
                        echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['wrong_login']).'</div>');
                        unset($_SESSION['wrong_login']);
                     }
                     if (isset($_SESSION['not_login']) ) {
                        echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['not_login']).'</div>');
                        unset($_SESSION['not_login']);
                      }
                      if (isset($_SESSION['error_login']) ) {
                        echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['error_login']).'</div>');
                        unset($_SESSION['error_login']);
                     }
                ?>
            <div class="logo-img">
                     <img src="../images/midlights.png" class="rounded mx-auto d-block" width="200px" alt="midlights logo" >
            </div>
			<form method="POST">
                <div class="form-floating mb-3 mt-4 ms-4 me-4">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating mt-4 ms-4 me-4">
                    <input type="password" name="password" class="form-control"  placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="d-flex justify-content-center">
             <button type="submit" name="login_submit" class="btn btn-dark mt-4 mb-4 ps-5 pe-5">Login</button>
             </div>
            </form>
					</div>
				</div>
			</section>
		</section>
	</section>
    <?php include('includes/footer.php') ?>
 </body>
</html>
