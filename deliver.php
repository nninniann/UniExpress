
   
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
  </head>
  <body>
  <section class="container-fluid">
    <div class="text-center mt-5">
        <h5>Thank you for ordering Midlights</h5>
        <h6>An order confirmation email has been sent to you</h6>
        <h6>You will be redirected to our homepage shortly &#128516;</h6>
    </div>
  <div class="delivery-guy d-flex justify-content-center">
    <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_ilkchi9f.json"  background="transparent"  speed="1"  style="width: 400px; height: 400px;"  loop  autoplay></lottie-player>
</div>
<div class="d-flex justify-content-center">
        <a href="menu.php" class="btn btn-order price-btn mb-5">Back to Main Menu</a>
</div>
</section>
<script>
  //prevent back button
  history.pushState(null, document.title, location.href);
  window.addEventListener('popstate', function (event)
  {
  history.pushState(null, document.title, location.href);
  });
  //redirect user back to homepage
  function pageRedirect() {
        window.location.replace("index.php");
    }      
    setTimeout("pageRedirect()", 5000);
</script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<?php include('admin/includes/footer.php') ?>
  </body>