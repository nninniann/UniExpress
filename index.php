<?php
  require_once "admin/pdo.php";
  session_start();
  include("contactemail.php");

    $sql = "SELECT * FROM food LIMIT 3";
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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Midlights</title>
  </head>
  <body>
    <div class="navbar-wrapper">
    <nav class="navbar navbar-expand-md navbar-dark trans-nav fixed-top py-3">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">
          <img src="images/Midlights.png" alt="midlights logo" width="40" height="40" class="d-inline-block me-1"><span>Midlights</span></a>
          <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#main-navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="main-navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="menu.php">Menu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#Services">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#About">About Us</a>
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
        </div>
        </div>
    </div>
    </nav>
  </div>
  <?php include("admin/includes/modal.php")?>
    <section class="showcase">
      <video src="images/video1.mp4" muted loop autoplay></video>
      <div class="overlay"> </div>
        <div class="text">
          <h2>Feeling <span class="hungry-text">Hungry</span></h2> 
          <h3>At Night?</h3>
          <p>Don’t starve, just order Midlights!<br> We will deliver it hot and yummy within minutes</p>
          <a href="menu.php" class="menu-button">Browse our Menu</a>
        </div>
    </section>
    
      <section id="Menu">
        <div class="menu-title d-flex justify-content-between align-items-center">
        <h3 class="popular-text ms-5 mt-5">Popular Foods</h3>
        <a href="menu.php"><span class="menu-button">View More</span></a>
        </div>
        <div class="container mt-5 mb-5">
          <div class="row">
          <?php foreach($rows as $row)  { 
            $id = $row['foodID']; ?>
            <div class="col-md-4">
              <div class="card food-card shadow mt-3">
                <div class="align-items-center p-2 text-center">
                <?php if ($row['food_image'] == "") { ?>
                  <div class="img-container">No image added</div>
                <?php } else { ?>
              <img class="img-fluid" src="images/food/<?php echo $row['food_image']; ?>">
              <?php } ?>
                <div class="info d-flex justify-content-around">
                  <div class="mt-3 ms-3 desc text-start">
                    <h5><?= htmlentities($row['food_name']); ?></h5>
                    <span><?= htmlentities($row['food_description']); ?></span>
                    <h6>RM<?= htmlentities($row['food_price']); ?></h6>
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
      <section id="Services">
      <h3 class="popular-text ms-5 mt-5">Our Amazing Services</h3>
      <div class="container mt-5 mb-5">
        <div class="row" data-aos="fade-right">
          <div class="col-md-4">
          <img src="images/dish.svg" class="services-icon mx-auto d-block mb-4" alt="dish">
          <div class="services-text text-center">
                  <h5>Excellent Food</h5>
                  <p class="text-justify ms-4 me-4" style="text-align: justify">Creating these great products is what we love to do. By using only the finest ingredients we ensure that the taste is perfect to serve to each and every one of our valued customers.</p>
            </div>
             </div>
          <div class="col-md-4">
            <img src="images/take-away.svg" class="services-icon mx-auto d-block mb-4" alt="take-away">
            <div class="services-text text-center">
                  <h5>Fast Delivery</h5>
                  <p class="text-justify ms-4 me-4" style="text-align: justify">We assign the nearest rider with the highest rating to ensure a reliable delivery service. Quick, easy and efficient. Order now and we will be there within minutes!</p>
            </div>
          </div>
          <div class="col-md-4"> 
          <img src="images/satisfaction.svg" class="services-icon mx-auto d-block mb-4" alt="services">
          <div class="services-text text-center">
                  <h5>Customer Satisfaction</h5>
                  <p class="text-justify ms-4 me-4" style="text-align: justify">Our customers are the reason for our existence. We demonstrate our appreciation by providing them with high quality food and superior service, in a clean, welcoming environment, at great value.</p>
            </div>
            </div>
          </div>
         </div>
      </div>
      </section>
      <section id="About">
      <h3 class="popular-text ms-5 mt-3">About Us</h3>
      <div class="container mt-5 mb-5">
        <div class="row">
          <div class="col-md-6">
          <img src="images/img11.jpg" data-aos="fade-right" onmouseover="this.src='images/img12.jpg'" onmouseout="this.src='images/img11.jpg'" class="img-thumbnail rounded mx-auto d-block about-img" alt="fast-food">
          </div>
          <div class="col-md-6">
              <h5 class="mt-4">Experience the Asian Sensation only at Midlights</h5>
              <p class="mt-3" style="text-align: justify">Midlights began on November 26th, 2019 in the city of Serdang. Focusing on the goals of “Quality, Health, and Tradition” the company started by making each dish from scratch in Kolej Canselor UPM.
              Through hard work and dedication, Midlights began building its brand around the idea of delicious and authentic malaysian snacks.
              Everyday, without fail, before the students of UPM become insanely hungry, we prepare fresh ingredients and ensure that our food is cooked and handled in extremely hygienic conditions.
              We honor our customers by providing them with the freshest, most delicious, and authentic meal experience possible.</p>
          </div>
         </div>
        </div>
      </section>
      <script type="text/javascript" src="scripts.js"></script>
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
      <script>
        AOS.init({
          offset: 200,
          duration: 800
        });
      </script>
      </script>
      <?php include('admin/includes/footer.php') ?>
  </body>
</html>
