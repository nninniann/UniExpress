<?php require_once "admin/pdo.php";
    session_start();
    $id = $_SESSION['fid'];
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
    $sql = "SELECT * FROM food WHERE foodID=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id' => $_SESSION['fid']));
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


    if (isset($_POST['order_confirm'])) {
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $today = date("Y-m-d H:i:s");  
    $sql = "INSERT INTO food_order (foodID, order_date, quantity, order_status, customerID, order_price)VALUES (:foodID, :order_date, :quantity, :order_status, :customerID, :order_price)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':foodID' => $_SESSION['fid'], ':order_date' => $today , ':quantity' => $_SESSION['quantity'] , ':order_status' => "Order Placed", ':customerID' => $_SESSION['custID'], ':order_price' => $_SESSION['price']));
    $_SESSION['order_success'] = "Order Placed";
        if (isset($_SESSION['order_success']) ) {
            require_once('email.php');
            unset($_SESSION['fid']);
            unset($_SESSION['quantity']);
            unset($_SESSION['price']);
            unset($_SESSION['email']);
            unset($_SESSION['custname']);
            echo "<script>window.location.assign('deliver.php')</script>";
            return;
         }
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
    <section class="order-details container-fluid">
    <section class="row justify-content-center align-self-center mt-5">
            <div class="card mb-3" style="max-width: 800px;">
            <div class="card-header">
            <div class="d-flex justify-content-between"> 
                <h5 class="mt-3">Confirm your order</h5>
                <lottie-player class="tossing-pan" src="https://assets9.lottiefiles.com/packages/lf20_snmohqxj/lottie_step2/data.json"  background="transparent"  speed="1"  style="width: 100px; height: 100px;"  loop  autoplay></lottie-player>
                </div>
            </div>
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
                    
        <span class="card-text">Total Price:</span><span class="card-text fs-5 fw-bold"> RM<?= number_format((float)htmlentities($_SESSION['price']), 2, '.', '')?></span>
        
      </div> 
      <div class="order">
          <label for="quantity">Quantity:</label>
          <input type="number" class="quantity fs-5" name ="quantity" min="1" value="<?=htmlentities($_SESSION['quantity'])?>" id="quantity" disabled>
          </div> 
        </div>
      </div>
      <div class="d-flex justify-content-end me-3">
            <a href="order.php?id=<?=$id?>" class="btn btn-order price-btn ms-2 mt-4 mb-4">Cancel</a>
             <button type="submit" name="order_confirm" class="btn btn-order price-btn ms-2 me-4 mt-4 mb-4">Order Now</button>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
</section>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<?php include('admin/includes/footer.php') ?>
  </body>   
</html>