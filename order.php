<?php require_once "admin/pdo.php";
    session_start();
  
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
    $id = $_GET['id'];
    $_SESSION['fid'] = $id;
    $sql = "SELECT * FROM food WHERE foodID=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id' => $id));
    while( $row = $stmt->fetch()) {
        if ($row > 0) {
            $foodname = $row['food_name'];
            $fooddesc = $row['food_description'];
            $foodprice = $row['food_price'];
            $foodimage = $row['food_image'];
        } else {
            header("Location: menu.php");
        }
    }
    $sql2 = "SELECT * FROM customer WHERE customerID=:id";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute(array(':id' => $custID));
    $result = $stmt2 -> fetch();
    $custname = $result ["cust_name"];
    $custphone = $result ["cust_phone"];
    $custemail = $result ["cust_email"];
    $custaddress = $result ["cust_address"];
    $_SESSION['email'] = $custemail;
    $_SESSION['custname'] = $custname;

    if (isset($_POST['order_submit'])) {
      $fname = $_POST['fname'];
      $fprice = $_POST['fprice'];
      $fquantity = $_POST['quantity'];
      $ftotal = (float)$fprice * (float)$fquantity;
      $_SESSION['price'] = $ftotal;
      $_SESSION['quantity'] = $fquantity;
      header("Location: checkout.php");
      return;
    }

?>
<html>
    <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
        crossorigin="anonymous"
      />
      <style><?php include "styles.css"; ?></style>
      <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
      <title>Midlights</title>
      <style> 
    </style>
    </head>
  <body>
    <section class="container-fluid">
    <h5 class="text-center mt-5">Your Food is waiting for you, <?=htmlentities($custname) ?> &#128523;</h5>
		<section class="row justify-content-center align-self-center mt-5">
            <div class="card mb-3" style="max-width: 800px;">
        <div class="row g-0">
         <div class="col-md-4">
       <?php  if ($foodimage == "") { ?>
                  <div class="img-container">No image added</div>
                <?php } else { ?>
              <img class="img-fluid" src="images/food/<?= htmlentities($foodimage); ?>">
              <?php } ?>
        </div>
    <div class="col-md-8">
      <div class="card-body">
      <div class="d-flex">
      <div class="d-flex flex-column align-self-center justify-content-center">
      <form method="POST">
        <h5 class="card-title mt-4"><?= htmlentities($foodname)?></h5>
        <input type="hidden" name="fname" value="<?= htmlentities($foodname)?>">

        <p class="card-text"><?= htmlentities($fooddesc)?></p>

        <p class="card-text fs-5 fw-bold">RM<?= htmlentities($foodprice)?></p>
        <input type="hidden" name="fprice" value="<?= htmlentities($foodprice)?>">
        
      </div>
      
      <div class="quantityy">
          <label for="quantity">Quantity:</label>
          <input type="number" class="quantity fs-5" name ="quantity" min="1" value="1" id="quantity" required>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>    
		</section>
   <section class="customer-details">
		<section class="row justify-content-center">
				<div class="card border-light shadow-sm mb-5 rounded" style="max-width: 800px;">
                <div class="card-header">  
                <div class="d-flex"> 
                <h5 class="mt-3">Confirm your details</h5>
                <lottie-player class="walking-burger" src="https://assets4.lottiefiles.com/packages/lf20_FXggV8.json"  background="transparent"  speed="1"  style="width: 100px; height: 100px;"  loop  autoplay></lottie-player>
                </div>
                </div>
                <div class="form-floating  mt-2 ms-4 me-4">
                    <input type="text" name="name" value="<?=htmlentities($custname) ?>" class="form-control" placeholder="Name" disabled>
                    <label for="floatingInput">Full Name</label>
                </div>
                <div class="form-floating mt-2 ms-4 me-4">
                    <input type="email" name="email" value="<?=htmlentities($custemail) ?>" class="form-control" placeholder="Email" disabled>
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating mt-2 ms-4 me-4">
                    <input type="tel" name="phone" value="<?=htmlentities($custphone) ?>" class="form-control" placeholder="Phone" disabled>
                    <label for="floatingInput">Tel no</label>
                </div>
                <div class="form-floating mt-2 ms-4 me-4">
                    <input type="text" name="room" value="<?=htmlentities($custaddress) ?>" class="form-control" placeholder="Room" disabled>
                    <label for="floatingInput">Room Number</label>
                </div>
                <div class="d-flex justify-content-center">
             <button type="submit" name="order_submit" class="btn btn-order price-btn mt-4 mb-4">Proceed to Checkout</button>
                </div>
            </form>
            <div class="card-footer">
            <p class="mt-3">Incorrect Details? <a href="update_details.php?id=<?=$id?>">Change now</a></p>
            </div>
				</div>   
				</div>
        </section>
		</section>
	</section>
	</section> 
     <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  </body>
  <?php include('admin/includes/footer.php') ?>
  </html>