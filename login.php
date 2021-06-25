<?php require_once "admin/pdo.php";
    session_start();
    if (isset($_POST['log_submit'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        if ( strlen($email) < 1 || strlen($password) < 1 ) {
            $_SESSION['incorrect_login'] = "Email and Password are required";
            header('Location: login.php');
            return;
          }
          elseif (!strpos($email,'@') ){
            $_SESSION['incorrect_login'] = "Email must have an at-sign (@)";
            header('Location: login.php');
            return;
          }
          else {
        $sql = "SELECT * FROM customer WHERE cust_email=:email AND cust_password = :password";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':email' => $email, ':password' => $password));
        $row = $stmt->fetchAll();
        $stmt2 = $pdo->prepare($sql);
        $stmt2->execute(array(':email' => $email, ':password' => $password));
        while( $row2 = $stmt2->fetch()) {
        $id=htmlentities($row2['customerID']);
        $_SESSION['custID'] = $id;
        echo $id;}
        if ($row) {
                $_SESSION['custlogin'] = "Logged In successfully";
                $_SESSION['logged_in'] = $email;
                header("Location: menu.php");
                return;
        } else {
            $_SESSION['incorrect_login'] = "Username or Password does not match";
            header("Location: login.php");
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
    <style><?php include "styles.css"; ?></style>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
      crossorigin="anonymous"
    />
    <title>Midlights</title>
    <style>
        .form-control:focus {
          border-color: #fca521;
          box-shadow: 0 0 0 0.2rem #e9bf81;
        }
      body {
        font-family: Poppins;
      }

      .card {
         order: none;
         margin-top: 2rem;
        }
      .btn-order {
        background-color: #fca521;
        color: white;
        min-width: 150px;
      }

      .btn-order:hover {
        background-color: transparent;
        border: 2px solid #fca521;
        font-weight: 800;
        color: #fca521;
      }

      .login-text {
        margin-top: -.3rem;
        font-size: .9rem;
        color: rgb(247, 101, 3)
      }
    </style>
</head>
<body class="login-bg">
<section class="container-fluid">
		<section class="row justify-content-center align-self-center mt-5">
			<section class="col-lg-5 col-md-5 col-sm-6">
				<div class="card border-light shadow-sm mb-5 rounded">
                <div class="card-header">
                <div class="d-flex">
                <div class="d-flex flex-column">
                <h5 class="mt-1">Welcome to Midlights</h5>
                <p class="login-text">Login now to order delicious meals!</p>
                </div>
                <lottie-player class="walking-burger" src="https://assets4.lottiefiles.com/packages/lf20_FXggV8.json"  background="transparent"  speed="1"  style="width: 100px; height: 100px;"  loop  autoplay></lottie-player>
                </div>
                </div>
                <?php
                  if (isset($_SESSION['incorrect_login']) ) {
                    echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['incorrect_login']).'</div>');
                    unset($_SESSION['incorrect_login']);
                 }
                   if (isset($_SESSION['reg_success']) ) {
                      echo('<div class="alert alert-success" role="alert">'.htmlentities($_SESSION['reg_success']).'</div>');
                      unset($_SESSION['reg_success']);
                   }
                ?>
			<form method="POST">
                <div class="form-floating mb-3 mt-4 ms-4 me-4">
                    <input type="text" name="email" class="form-control" placeholder="Username">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating mt-4 ms-4 me-4">
                    <input type="password" name="password" class="form-control"  placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="d-flex justify-content-center">
             <button type="submit" name="log_submit" class="btn btn-order price-btn mt-4 mb-4">Login</button>
                    </div>
            </form>
            <div class="card-footer">
                <a href="index.php">Back to Main Menu</a>
                 <p>Don't have an account? <a href="register.php">Register here</a></p>
            </div>
					</div>
				</div>
			</section>
		</section>
	</section>
   <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
   <?php include('admin/includes/footer.php') ?>
    </body>
</html>
