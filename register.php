<?php require_once "admin/pdo.php";
    session_start();

    if(isset($_POST['reg_submit'])) {
        $name = htmlentities($_POST['name']);
        $email = htmlentities($_POST['email']);
        $phone = htmlentities($_POST['phone']);
        $room = htmlentities($_POST['room']);
        $password = htmlentities(md5($_POST['password']));
        if ( strlen($name) < 1 || strlen($email) < 1 || strlen($phone) < 1 || strlen($room) < 1 || strlen($password) < 1) {
          $_SESSION['not_reg'] = "Full Name, Email, Phone Number, Room Number and Password are required";
          header('Location: register.php');
          return;
        }
        else if (!preg_match("/^[a-zA-Z ]*$/",$name)){
          $_SESSION['not_reg'] = "Please enter your Full Name correctly";
          header('Location: register.php');
          return;
        }
        elseif (!strpos($email,'@') ){
          $_SESSION['not_reg'] = "Email must have an at-sign (@)";
          header('Location: register.php');
          return;
        }
        else if (!is_numeric($phone)) {
          $_SESSION['not_reg'] = "Please enter a valid Phone Number with numeric values only";
          header('Location: register.php');
          return;
        }
        else if (!is_numeric($room)){
          $_SESSION['not_reg'] = "Please enter a valid Room Number with numeric values only";
          header('Location: register.php');
          return;
        }
        else {

            if (strlen($_POST["password"]) < '8') {
               $_SESSION['not_reg'] = "Your Password Must Contain At Least 8 Characters!";
               header('Location: register.php');
               return;
             }
            elseif (!preg_match("#[0-9]+#", $_POST["password"])) {
                  $_SESSION['not_reg'] = "Your Password Must Contain At Least 1 Number!";
                  header('Location: register.php');
                  return;
              }
            elseif (!preg_match("#[A-Z]+#",$_POST["password"])) {
                    $_SESSION['not_reg'] = "Your Password Must Contain At Least 1 Capital Letter!";
                    header('Location: register.php');
                    return;
                }
                else {
                  try {
                  $sql = "INSERT INTO customer (cust_name, cust_email, cust_phone, cust_address, cust_password) VALUES (:name, :email, :phone, :room, :password)";
                  $stmt = $pdo->prepare($sql);
                  $stmt->execute(array(
                      ':name'=> $name,
                      ':email'=> $email,
                      ':phone'=> $phone,
                      ':room'=> $room,
                      ':password'=> $password,
                  )
                );
              } catch(PDOException $e) {
                if ($e->getCode() == 23000) {
                  $_SESSION['duplicate'] = "This email account has been registered before";
                  header("Location: register.php");
                  return;
                } else {
                  error_log("error.php, SQL error=".$e->getMessage());
                }
              }
                  $_SESSION['reg_success'] = "Register successfully";
                  if (isset($_SESSION['reg_success']) ) {
                      header("Location: login.php");
                      return;
                   }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
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
         margin-top: .5rem;
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
    </style>
</head>
<body class="login-bg">
<section class="container-fluid">
		<section class="row justify-content-center">
			<section class="col-lg-5 col-md-5 col-sm-6">
				<div class="card border-light shadow-sm mb-5 rounded">
                <div class="card-header">
                <div class="d-flex">
                <h5 class="mt-3">Join Midlights</h5>
                <lottie-player class="walking-taco" src="https://assets5.lottiefiles.com/packages/lf20_yjL4ri.json"  background="transparent"  speed="1"  style="width: 100px; height: 100px;"  loop  autoplay></lottie-player>
                </div>
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
                      if (isset($_SESSION['not_reg']) ) {
                         echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['not_reg']).'</div>');
                         unset($_SESSION['not_reg']);
                       }
                       if (isset($_SESSION['duplicate']) ) {
                        echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['duplicate']).'</div>');
                        unset($_SESSION['duplicate']);
                      }
                ?>
			<form method="POST">
                <div class="form-floating  mt-2 ms-4 me-4">
                    <input type="text" name="name" class="form-control" placeholder="Name">
                    <label for="floatingInput">Full Name</label>
                </div>
                <div class="form-floating mt-2 ms-4 me-4">
                    <input type="text" name="email" class="form-control" placeholder="Email">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating mt-2 ms-4 me-4">
                    <input type="tel" name="phone" class="form-control" placeholder="Phone">
                    <label for="floatingInput">Tel no</label>
                </div>
                <div class="form-floating mt-2 ms-4 me-4">
                    <input type="text" name="room" class="form-control" placeholder="Room">
                    <label for="floatingInput">Room Number</label>
                </div>
                <div class="form-floating mt-2 ms-4 me-4">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="d-flex justify-content-center">
             <button type="submit" name="reg_submit" class="btn btn-order price-btn mt-4 mb-4">Sign Up</button>
                </div>
            </form>
            <div class="card-footer">
            <a href="index.php">Back to Main Menu</a>
            <p> Have an account? <a href="login.php">Login now</a></p>
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
