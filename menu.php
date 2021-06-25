<?php
  require_once "admin/pdo.php";
  session_start();
  include("contactemail.php");

    $sql = "SELECT * FROM food";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(); 
    $rows = $stmt->fetchAll();
?>
    
<html lang="en">
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
        body {
            padding-top: 60px;
        }
    </style>
    </head>
    <body>
      <div class="navbar-wrapper">
      <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top py-3">
          <div class="container-fluid">
            <a class="navbar-brand" href="index.php"> <img src="images/Midlights.png" alt="midlights logo" width="40" height="40" class="d-inline-block me-1"><span>Midlights</span></a>
            <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#main-navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-navigation">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="index.php#showcase">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Menu</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php#Services">Services</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="index.php#About">About Us</a>
              </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="modal" data-bs-target="#contactModal">Contact Us</a>
                </li>
                <li class="nav-item">
                <?php
                if(!isset($_SESSION['logged_in'])) {
                  echo '<a class="nav-link" href="login.php">Login</a>';
                } else {
                  echo '<a class="nav-link" href="logout.php">Logout</a>';
                }
                ?>
              </li>
            </ul>
              </ul>
          </div>
          </div>
      </div>
      </nav>
      </div>
      <?php include("admin/includes/modal.php")?>
    <section id="Menu">
        <h3 class="ms-5 mt-5">Our Menu</h3>
        <h6 class="ms-5">We pride ourselves on our craveable menu, along with our highest standards on food quality.</h6>
        <div class="container mt-5 mb-5">
          <div class="row">
          <?php foreach($rows as $row)  { 
            $id = $row['foodID'];
            ?>
            <div class="col-md-4">
              <div class="card food-card shadow mt-3">
                <div class="align-items-center p-2 text-center">
                <?php if ($row['food_image'] == "") { ?>
                  <div class="img-container">No image added</div>
                <?php } else { ?>
              <img class="img-fluid" src="images/food/<?php echo $row['food_image']; ?>">
              <?php } ?>
                <div class="info d-flex justify-content-around ">
                  <div class="mt-3 ms-3 desc text-start">
                    <h5><?=htmlentities($row['food_name']); ?></h5>
                    <span><?=htmlentities($row['food_description']); ?></span>
                    <h6>RM<?=htmlentities($row['food_price']); ?></h6>
                  </div>
                   <a href="order.php?id=<?=$id?>" class="btn btn-order price-btn mt-5"><i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24";transform:;-ms-filter:">
                  <path d="M21.822,7.431C21.635,7.161,21.328,7,21,7H7.333L6.179,4.23C5.867,3.482,5.143,3,4.333,3H2v2h2.333l4.744,11.385 C9.232,16.757,9.596,17,10,17h8c0.417,0,0.79-0.259,0.937-0.648l3-8C22.052,8.044,22.009,7.7,21.822,7.431z">
                  </path><circle cx="10.5" cy="19.5" r="1.5"></circle><circle cx="17.5" cy="19.5" r="1.5"></circle></svg></box-icon>
                </i>Order now</a>
                </div>
              </div>
              </div>
            </div>
            <?php }?>
        </div>
    </div>
  </section>
  <?php include('admin/includes/footer.php') ?>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  </body>
  </html>