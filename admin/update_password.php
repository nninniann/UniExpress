<?php

include('includes/nav.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

    if (isset($_POST['new_submit'])) {
        $id = $_POST['id'];
        $current = htmlentities(md5($_POST['current']));
        $new = htmlentities(md5($_POST['new']));
        $confirm = htmlentities(md5($_POST['confirm']));

        $sql = "SELECT * FROM admin WHERE adminID=:id AND admin_password = :current";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':id' => $id, ':current' => $current));
        $row = $stmt->fetchAll();
        if ( strlen($_POST["current"] < 1) || strlen($_POST["new"] < 1) || strlen($_POST["confirm"] < 1)) {
            $_SESSION['pass_fail'] = "Current Password, New Password and Confirm Password are required";
            header('Location: manage_admin.php');
            return;
        } 
        if ($row) {
            if ($new == $confirm) {
                if (strlen($_POST["new"]) < '8') {
                   $_SESSION['pass_failure'] = "Your New Password Must Contain At Least 8 Characters!";
                   header('Location: manage_admin.php');
                   return;
                 }
                elseif (!preg_match("#[0-9]+#", $_POST["new"])) {
                      $_SESSION['pass_failure'] = "Your New Password Must Contain At Least 1 Number!";
                      header('Location: manage_admin.php');
                      return;
                  }
                elseif (!preg_match("#[A-Z]+#",$_POST["new"])) {
                        $_SESSION['pass_failure'] = "Your New Password Must Contain At Least 1 Capital Letter!";
                        header('Location: manage_admin.php');
                        return;
                    }
                else {
                  $sql2 = "UPDATE admin SET admin_password = :new WHERE adminID=:id";
                  $stmt = $pdo->prepare($sql2);
                  $stmt->execute(array(':new' => $new , ':id' => $id));
                  $_SESSION['change_success'] = "Password updated successfully";
                  header("Location: manage_admin.php");
                  return;
                }
              }
            else {
                $_SESSION['not_match'] = "Password does not match";
                header("Location: manage_admin.php");
                return;
            }
        } else {
            $_SESSION['wrong_pass'] = "Wrong Password";
            header("Location: manage_admin.php");
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
                <div class="card-header text-white bg-dark"><h5 class="mt-3">Change Password<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill ms-2 mb-1" viewBox="0 0 16 16">
  <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
</svg></h5>
     </div>
        <form method="POST">
        <div class="form-floating mb-3 mt-4 ms-4 me-4">
                <input type="password"  name="current" class="form-control" aria-describedby="current password" placeholder="Current Password">
                <label for="current" class="form-label">Current Password</label>
        </div>
        <div class="form-floating mt-4 ms-4 me-4">
                <input type="password"  name="new" class="form-control" aria-describedby="new password" placeholder="New Password">
                <label for="new" class="form-label">New Password</label>
        </div>
        <div class="form-floating mt-4 ms-4 me-4">
                <input type="password"  name="confirm" class="form-control" aria-describedby="confirm password" placeholder="Confirm Password">
                <label for="confirm" class="form-label">Confirm Password</label>
         </div>
        <input type="hidden" name="id" value="<?= $id?>">
        <div class="d-flex justify-content-center">
            <button type="submit" name="new_submit" class="btn btn-dark mt-4 mb-4 me-2 ps-5 pe-5">Submit</button>
        </div>
        </form>
    <</div>
        </section>
        </section>
        </section>
        <?php include('includes/footer.php') ?>
</body>
</html>
