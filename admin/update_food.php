
<?php include('includes/nav.php');

$foodid = $_GET['id'];
$sql = "SELECT * FROM food WHERE foodID=:id";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':id' => $foodid));
while( $row = $stmt->fetch()) {
    if ($row > 0) {
        $foodname = $row['food_name'];
        $fooddesc = $row['food_description'];
        $foodprice = $row['food_price'];
        $foodimage = $row['food_image'];
    } else {
        header("Location: manage_admin.php");
    }
}

if (isset($_POST['update_submit'])) {
   $id = $_POST['id'];
   $foodname = $_POST['foodname'];
   $foodprice = $_POST['price'];
   $fooddesc = $_POST['desc'];
   $oldimg = $_POST['img'];
   if ( strlen($foodname) < 1 || strlen($fooddesc) < 1 || strlen($foodprice) < 1) {
     $_SESSION['up_fail'] = "Food Name, Description and Price are required";
     header('Location: manage_food.php');
     return;
   }
   else if (isset($_FILES['image'][ 'name'])) {
       $image = $_FILES['image'][ 'name'];

       if ($image != "") {
           $temp = explode('.', $image);
           $format = end($temp);
           $image = "Food-Name-".rand(0000, 9999).".".$format;

           $src = $_FILES['image']['tmp_name'];
           $dst = "../images/food/".$image;
           $upload = move_uploaded_file($src, $dst);

           if ($upload == false) {
               $_SESSION['up_fail'] = "Upload Image Failed";
               header("Location: manage_food.php");
               return;
               die();
           }

           if ($oldimg != "") {
               $path = "../images/food/".$oldimg;
               $del = unlink($path);
           }

       } else {
           $image = $oldimg;
       }
   } else {
       $image = $oldimg;
   }

   $foodid = $_GET['id'];
   $sql = "UPDATE food SET food_name=:foodname, food_description=:fooddesc, food_price=:foodprice, food_image=:foodimg WHERE foodID=:id";
   $stmt = $pdo->prepare($sql);
   echo $sql;
   $stmt->execute(array(
       ":id" => $foodid,
       ":foodname" => $foodname,
       ":fooddesc" => $fooddesc,
       ":foodprice" => $foodprice,
       ":foodimg" => $image,
   ));
   $count = $stmt->rowCount();
   if($count == 0){
       echo "Failed !";
       header("Location: manage_food.php");
       return;
   }
   else{
       $_SESSION['foodup_success'] = "Record updated";
   }
   if (isset($_SESSION['foodup_success']) ) {
       header("Location: manage_food.php");
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
                <div class="card-header text-white bg-dark"><h5 class="mt-3">Update Food<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload ms-2" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
  <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
</svg></h5>
</div>
<form method="POST" enctype="multipart/form-data">
    <div class="form-floating mb-3 mt-4 ms-4 me-4">
               <input type="text" value="<?=$foodname?>" name="foodname" class="form-control" placeholder="Food Name">
               <label for="floatingInput">Food Name</label>
    </div>
    <div class="mb-3 mt-4 ms-4 me-4">
           <label for="floatingInput">Food Description</label>
           <textarea class="form-control" name="desc" rows="5"><?=$fooddesc?></textarea>
    </div>
    <div class="form-floating mb-3 mt-4 ms-4 me-4">
    <input type="text" value="<?=$foodprice?>" name="price" class="form-control" placeholder="Price">
            <label for="floatingInput">Food Price</label>
    </div>
    <div class="mb-3 mt-4 ms-4 me-4">
                   <label for="image" class="form-label">Current Food Image</label>
                   <div class="col-md-4">
                   <?php if ($foodimage == "") {
                       echo "Image not Available";
                   } else { ?>
                   <img width="150" src="<?php echo "../"?>images/food/<?php echo $foodimage; ?>">
                   <?php  } ?>
                   </div>
    </div>
    <div class="mb-3 mt-4 ms-4 me-4">
                   <label for="image" class="form-label">Upload New Food Image</label>
                    <input type="file" name="image" class="form-control" aria-describedby="food-image">
            </div>
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="hidden" name="img" value="<?= $foodimage?>">
        <div class="d-flex justify-content-center">
            <button type="submit" name="update_submit" class="btn btn-dark mt-4 mb-4 ps-5 pe-5">Submit</button>
        </div>
    </form>
    </div>
        </section>
        </section>
        </section>
        <?php include('includes/footer.php') ?>
</body>
</html>
