<?php require_once "admin/pdo.php";
    session_start();
    $foodid = $_REQUEST['id'];
    if(!isset($_SESSION['logged_in']) && !isset($_SESSION['custID']) ) {
        $_SESSION['logged_in'] = "Please login to order";
        header("Location: login.php");
        return;
    }
    if(!isset($_SESSION['custID']) ) {
        $_SESSION['logged_in'] = "Please login to order";
        header("Location: login.php");
        return;
    }

    $custID = $_SESSION['custID'];
    $sql2 = "SELECT * FROM customer WHERE customerID=:id";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute(array(':id' => $custID));
    $result = $stmt2 -> fetch();
    $custname = $result ["cust_name"];
    $custphone = $result ["cust_phone"];
    $custemail = $result ["cust_email"];
    $custaddress = $result ["cust_address"];

    if (isset($_POST['save'])) {
      $custname2 = htmlentities($_POST["name"]);
      $custemail2 = htmlentities($_POST["email"]);
      $custphone2 = htmlentities($_POST["phone"]);
      $custaddress2 = htmlentities($_POST["room"]);
      if ( strlen($custname2) < 1 || strlen($custemail2) < 1 || strlen($custphone2) < 1 || strlen($custaddress2) < 1) {
        $_SESSION['wrong_details'] = "Full Name, Email, Phone Number and Room Number are required";
        $foodid = $_REQUEST['id'];
        header("Location: update_details.php?id=$foodid");
        return;
      }
      if (!preg_match("/^[a-zA-Z ]*$/",$custname2)){
        $_SESSION['wrong_details'] = "Please enter your Full Name correctly";
        $foodid = $_REQUEST['id'];
        header("Location: update_details.php?id=$foodid");
        return;
      }
      elseif (!strpos($custemail2,'@') ){
        $_SESSION['wrong_details'] = "Email must have an at-sign (@)";
        $foodid = $_REQUEST['id'];
        header("Location: update_details.php?id=$foodid");
        return;
      }
      else if (!is_numeric($custphone2)) {
        $_SESSION['wrong_details'] = "Please enter a valid Phone Number with numeric values only";
        $foodid = $_REQUEST['id'];
        header("Location: update_details.php?id=$foodid");
        return;
      }
      else if (!is_numeric($custaddress2)){
        $_SESSION['wrong_details'] = "Please enter a valid Room Number with numeric values only";
        $foodid = $_REQUEST['id'];
        header("Location: update_details.php?id=$foodid");
        return;
      }
      else {
      $sql = "UPDATE customer SET cust_name=:custname, cust_email=:custemail, cust_phone=:custphone, cust_address=:custaddress WHERE customerID=:id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(array(
          ":custname" => $custname2,
          ":custemail" => $custemail2,
          ":custphone" => $custphone2,
          ":custaddress" => $custaddress2,
          ":id" => $custID,
      ));
      $count = $stmt->rowCount();
      if($count > 0){
      $_SESSION['details_success'] = "Record updated";
      $foodid = $_REQUEST['id'];
      if (isset($_SESSION['details_success']) ) {
          header("Location: order.php?id=$foodid");
          return;
       }
      } else {
        $_SESSION['details_failed'] = "No changes made";
        $foodid = $_REQUEST['id'];
        header("Location: order.php?id=$foodid");
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
				<div class="card border-light shadow-sm mb-5 mt-5 rounded">
                <div class="card-header">
                <div class="d-flex">
                <h5 class="mt-3">Change Your Details</h5>
                <lottie-player class="walking-taco" src="https://assets5.lottiefiles.com/packages/lf20_yjL4ri.json"  background="transparent"  speed="1"  style="width: 100px; height: 100px;"  loop  autoplay></lottie-player>
                </div>
                </div>
                <?php
                     if (isset($_SESSION['wrong_details']) ) {
                        echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['wrong_details']).'</div>');
                        unset($_SESSION['wrong_details']);
                     }
                     ?>
			<form method="POST">
                <div class="form-floating  mt-2 ms-4 me-4">
                    <input type="text" name="name" class="form-control" value="<?=htmlentities($custname) ?>" placeholder="Name">
                    <label for="floatingInput">Full Name</label>
                </div>
                <div class="form-floating mt-2 ms-4 me-4">
                    <input type="text" name="email" class="form-control" value="<?=htmlentities($custemail) ?>" placeholder="Email">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating mt-2 ms-4 me-4">
                    <input type="tel" name="phone" class="form-control" value="<?=htmlentities($custphone) ?>" placeholder="Phone">
                    <label for="floatingInput">Tel no</label>
                </div>
                <div class="form-floating mt-2 ms-4 me-4">
                    <input type="text" name="room" class="form-control" value="<?=htmlentities($custaddress) ?>" placeholder="Room">
                    <label for="floatingInput">Room Number</label>
                </div>
                <div class="d-flex justify-content-center">
             <button type="submit" name="save" class="btn btn-order price-btn mt-4 mb-4">Save</button>
                </div>
            </form>
            <div class="card-footer">
            <p class="mt-3"><a href="order.php?id=<?=$foodid?>">Cancel</a></p>
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
