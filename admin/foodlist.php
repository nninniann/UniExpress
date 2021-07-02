
<?php
session_start();

    if (isset($_POST['submit'])) {
        if ( !isset ($_SESSION['food']) ) { $_SESSION['food'] = Array();}
         $_SESSION['food'] [] = array($_POST['student'], $_POST['matric'], $_POST['datetime']);
         header("Location: index.php");
         return;

    }

    if ( isset($_POST['reset']) ) {
        $_SESSION['food'] = Array();
        header("Location: index.php");
        return;
      }


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Midlights</title>
    <style>
        .btn-dark{
            max-height: 40px;
            border: 2px solid black !important;
        }

        .btn-dark:hover {
            background-color: white !important;
            color: black !important;
        }

        .p-3 {
         padding: 0 !important;
        }
    </style>
</head>
<body>
<section class="container-fluid">
		<section class="row justify-content-center">
			<section class="col-lg-6 col-md-6 col-sm-6 mt-5">
				<div class="card shadow-sm p-3 mb-5 rounded">
                <div class="card-header text-white bg-dark"><h5 class="mt-3">Food Suggestions<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-plus-fill ms-2 me-2 mb-1" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z"/>
</svg></h5>
            </div>
        <form  method="POST" action="foodlist.php">
        <div class="form-floating mb-3 mt-4 ms-4 me-4">
                    <input type="text" name="student" class="form-control" aria-describedby="Food Name" placeholder="Food Name">
                    <label for="name" class="form-label">Food Name</label>
            </div>
            <div class="form-floating mt-4 ms-4 me-4">
                <input type="text" name="matric" class="form-control" aria-describedby="Food Description"  placeholder="Food Description">
                <label for="matric" class="form-label">Food Description</label>
             </div>
             <div class="form-floating mt-4 ms-4 me-4">
                <input type="text" name="datetime" class="form-control" aria-describedby="Food Price" placeholder="Food Price">
                <label for="datetime" class="form-label">Food Price</label>
            </div>
            <div class="d-flex justify-content-center">
                    <input type="submit" name="submit" value="Suggest" class="btn btn-dark mt-4 mb-4 me-2 ps-5 pe-5">
                    <a href="#"  data-toggle="modal" data-target="#confirm-delete" class="btn btn-dark mt-4 mb-4 ms-2 ps-5 pe-5">Reset</a>
        </div>
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0 bg-dark text-white">
                Are you sure you want to delete?
            </div>
            <div class="modal-body">
            The attendance will be permanently removed.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <input type="submit" name="reset" class="btn btn-danger" value="Delete">
            </div>
            </form>
        </div>
    </div>
</div>
    </div>
        </section>
        <section class="col-lg-6 col-md-6 col-sm-6 mt-5">
                <h5>Suggested Food List</h5>
				<div class="card shadow-sm p-3 mb-5 rounded">
                <div id="currentattandancelist"></div>
            </div>
        </section>
        </section>
        </section>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript">
        function updateFood() {
        window.console && console.log('Requesting JSON');
        $.getJSON('futurefood.php', function(rowz) {
            window.console && console.log('JSON Received');
           window.console && console.log(rowz);
           $('#currentattandancelist').empty();
               for (var i = 0; i < rowz.length; i++) {
                   entry = rowz[i];
                $('#currentattandancelist').append('<p>'+entry[0] +
                  '<br/>'+entry[1]+
                  '<br/>'+entry[2]+ "</p>\n");
            }
           setTimeout('updateFood()', 4000);
        });
    }

    $(document).ready(function() {
      $.ajaxSetup({ cache: false });
      updateFood();
    });
        </script>
        <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
      crossorigin="anonymous"
    ></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
</body>
</html>
