<?php
session_start();
if(count($_POST)>0) {
    require_once('pdo.php');
    changepassword($pdo,[$_POST['password'],$_POST['password'],$_POST['confirmpassword']]);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Change Password</title>
  </head>
  <body>
  <div class="container">
    <h1>Change your password</h1>
<form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
  <div class="form-group">
    <label>Email</label>
    <input required type="email" class="form-control" name="email">
  </div>
    <div class="form-group">
    <label>New Password</label>
    <input required type="password" class="form-control" name="password">
  </div>
  <div class="form-group">
    <label>Confirm Password</label>
    <input required type="password" class="form-control" name="confirmpassword">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>