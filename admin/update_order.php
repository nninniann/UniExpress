
<?php include('includes/nav.php');
     
     $orderid = $_GET['id'];
     $sql = "SELECT orderID, food_name, quantity, order_price, cust_name, order_date, order_status FROM food_order JOIN customer JOIN food ON food_order.foodID = food.foodID AND food_order.customerID = customer.customerID WHERE orderID = :orderID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':orderID' => $orderid)); 
     while( $row = $stmt->fetch()) {
         if ($row > 0) {
            $foodname = $row['food_name'];
            $quantity = $row['quantity'];
            $orderprice = $row['order_price'];
            $custname = $row['cust_name'];
            $orderdate = $row['order_date'];
            $orderstatus = $row['order_status'];
         } else {
             header("Location: manage_order.php");
         }
     }
 
    if (isset($_POST['orderup_submit'])) {
        $orderid = $_POST['orderid'];
        $foodname = $_POST['foodname'];
        $quantity = $_POST['quantity'];
        $orderprice = $_POST['orderprice'];
        $custname = $_POST['custname'];
        $orderdate = $_POST['orderdate'];
        $orderstatus = $_POST['orderstatus'];

        $sql = "UPDATE food_order SET order_status= :orderstatus WHERE orderID=:orderid";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ":orderid" => $orderid,
            ":orderstatus" => $orderstatus,
        ));
        $count = $stmt->rowCount();
        if($count == 0){
            $_SESSION['orderup_fail'] = "Record update failed"; 
            header("Location: manage_order.php");
            return;
        }
        else{
            $_SESSION['orderup_success'] = "Record updated";   
        }
        if (isset($_SESSION['orderup_success']) ) {
            header("Location: manage_order.php");
            return;
         }
    }
    ?>
<html>
<body>
<section class="container-fluid">
		<section class="row justify-content-center">
			<section class="col-lg-6 col-md-6 col-sm-6 mt-5">
				<div class="card shadow-sm p-3 mb-5 rounded">
                <div class="card-header text-white bg-dark"><h5 class="mt-3">Update Order Status<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload ms-2" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
  <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
</svg></h5>
</div>
    <form method="POST" enctype="multipart/form-data">

                <label class="mt-4 ms-4 me-4">Order Status</label>
                <select class="form-select mb-3 mt-1 ms-4 me-4" name="orderstatus">
                    <option <?php if($orderstatus == "Order Placed"){echo "selected";} ?> value="Order Placed">Order Placed</option>
                    <option <?php if($orderstatus == "Preparing Order"){echo "selected";} ?> value="Preparing Order">Preparing Order</option>
                    <option <?php if($orderstatus == "On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                    <option <?php if($orderstatus == "Order Completed"){echo "selected";} ?> value="Order Completed">Order Completed</option>
                </select>  
             
                <div class="form-floating mb-3 mt-4 ms-4 me-4">
                    <input type="text" value="<?=$foodname?>" name="foodname" class="form-control" placeholder="Food Name" disabled>
                    <label for="floatingInput">Food Name</label>
                </div>
                <div class="form-floating mb-3 mt-4 ms-4 me-4">
                    <input type="text" value="<?=$quantity?>" name="quantity" class="form-control" placeholder="Quantity" disabled>
                    <label for="floatingPassword">Quantity</label>
                </div>
                <div class="form-floating mb-3 mt-4 ms-4 me-4">
                    <input type="text" value="<?=$orderprice?>" name="orderprice" class="form-control" placeholder="Order Price" disabled>
                    <label for="floatingPassword">Order Price</label>
                </div>
                <div class="form-floating mb-3 mt-4 ms-4 me-4">
                    <input type="text" value="<?=$custname?>" name="custname" class="form-control" placeholder="Customer Name" disabled>
                    <label for="floatingPassword">Customer Name</label>
                </div>
                <div class="form-floating mb-3 mt-4 ms-4 me-4">
                    <input type="text" value="<?=$orderdate?>" name="orderdate" class="form-control" placeholder="Order Date" disabled>
                    <label for="floatingPassword">Order Date</label>
                </div>
            <input type="hidden" name="orderid" value="<?=$orderid?>">
            <div class="d-flex justify-content-center">
             <button type="submit" name="orderup_submit" class="btn btn-dark mt-4 mb-4 ps-5 pe-5">Submit</button>
             </div>
            </form>
            </div>
        </section>
        </section>
        </section>
        <?php include('includes/footer.php') ?>
</body>
</html>
