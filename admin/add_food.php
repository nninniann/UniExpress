<?php include('includes/nav.php');
    if (isset($_POST['submit'])) {
        $foodname = htmlentities($_POST['foodname']);
        $fooddesc = htmlentities($_POST['desc']);
        $foodprice = htmlentities($_POST['price']);

        if ( strlen($foodname) < 1 || strlen($fooddesc) < 1 || strlen($foodprice) < 1) {
          $_SESSION['up_fail'] = "Food Name, Description and Price are required";
          header('Location: add_food.php');
          return;
        }

        else if (isset($_FILES['image'][ 'name'])) {
            $image = $_FILES['image'][ 'name'];

            if ($image != "") {
                $format = end(explode('.', $image));
                $image = "Food-Name-".rand(0000, 9999).".".$format;

                $src = $_FILES['image']['tmp_name'];
                $dst = "../images/food/".$image;
                $upload = move_uploaded_file($src, $dst);

                if ($upload == false) {
                    $_SESSION['up_fail'] = "Upload Image Failed";
                    header("Location: add_food.php");
                    return;
                    die();
                }

            }
        } else {
            $image = "";
            echo "no upload";
        }
        $sql = "INSERT INTO food (food_name, food_description, food_price, food_image) VALUES (:name, :desc, :price, :image)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':name'=> $foodname,
            ':desc'=> $fooddesc,
            ':price'=> $foodprice,
            ':image' => $image,
        ));
        $_SESSION['food_success'] = "Record inserted";
        if (isset($_SESSION['food_success']) ) {
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
                <div class="card-header text-white bg-dark"><h5 class="mt-3">Add Food<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-plus-fill ms-2 mb-1" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z"/>
</svg></h5>
    </div>
    <?php
         if (isset($_SESSION['up_fail']) ) {
            echo('<div class="alert alert-danger" role="alert">'.htmlentities($_SESSION['up_fail']).'</div>');
            unset($_SESSION['up_fail']);
         }
    ?>
    <form method="POST" enctype="multipart/form-data">
                <div class="form-floating mb-3 mt-4 ms-4 me-4">
                    <input type="text" name="foodname" class="form-control" placeholder="Food Name">
                    <label for="floatingInput">Food Name</label>
                </div>
                <div class="mb-3 mt-4 ms-4 me-4">
                <label for="floatingInput">Food Description</label>
                <textarea class="form-control" name="desc" rows="5" placeholder="Type food description here..."></textarea>
                </div>
                <div class="form-floating mb-3 mt-4 ms-4 me-4">
                    <input type="text" name="price" class="form-control" min="0" placeholder="Price">
                    <label for="floatingInput">Food Price</label>
                </div>
                <div class="mb-3 mt-4 ms-4 me-4">
                        <label for="image" class="form-label">Food Image</label>
                        <input type="file" name="image" class="form-control" aria-describedby="food-image">
                 </div>
                 <div class="d-flex justify-content-center">
                     <button type="submit" name="submit" class="btn btn-dark mt-4 mb-4 ps-5 pe-5">Submit</button>
                </div>
                </div>
        </section>
        </section>
        </section>
        <?php include('includes/footer.php') ?>
</body>
</html>
