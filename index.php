<?php
session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css.css">

    <title>Final Project</title>
  </head>
  <body>
    
    <?php if(!isset($_SESSION['userID'])){
    //sign in, sign up buttons
        echo 
        '<a href="/final/signin.php" class="btn btn-primary">Sign in</a>
        </hr>
        <a href="/final/signup.php" class="btn btn-primary">Sign up</a>
        </hr>';
        }
    ?>
    <?php if(isset($_SESSION['userID'])){
        //sign out button
        echo 
        '<a href="signout.php" class="btn btn-primary">Sign out</a>';
        }
    ?>
    <div class="card-container">
      <div class="card u-clearfix">
        <div class="card-body">
          <span class="card-number card-circle subtle">01</span>
          <span class="card-author subtle">John Smith</span>
          <h2 class="card-title">New Brunch Recipe</h2>
          <span class="card-description subtle">These last few weeks I have been working hard on a new brunch recipe for you all.</span>
          <div class="card-read">Read</div>
          <span class="card-tag card-circle subtle">C</span>
        </div>
        <img src="https://s15.postimg.cc/temvv7u4r/recipe.jpg" alt="" class="card-media" />
      </div>
      <div class="card-shadow"></div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

