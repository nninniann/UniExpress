<?php require_once "pdo.php";
    session_start();
    if(!isset($_SESSION['redirect'])) {
        $_SESSION['not_login'] = "Please login to access admin panel";
        header("Location: admin_login.php");
        return;
    }
?>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="includes/adminstyles.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
    <title>Midlights</title>
    <style>
    .form-control:focus {
        border-color: black;
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.5);
    }

    .form-select:focus {
        border-color: black;
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.5);
    }

    .p-3 {
         padding: 0!important;
    }
    </style>
</head>
<body>
<section class="menu">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top py-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                <img src="../images/Midlights.png" alt="midlights logo" width="40" height="40" class="d-inline-block me-1"><span>Midlights</span></a>
                <button class="navbar-toggler navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#main-navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="main-navigation">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_admin.php">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_food.php">Food</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_order.php">Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </nav>
    </section>
