<?php
session_start();
if(count($_POST)>0) {
    require_once('pdo.php');
    recipeAdd($pdo, [$_SESSION['userID'], $_POST['recipeID'], $_POST['recipeName'], $_POST['timeCooked'], $_POST['instructions'], $_POST['ingredent'], $_POST['numMeasure'], $_POST['catMeasure']] );
}
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
    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
      <input type="hidden" value="'.$_SESSION['userID'].'" name="uid">
       Recipe ID : <input type="number" name="recipeID" placeholder="Enter a Whole Number" /><br />
      Recipe Name : <input type="text" name="recipeName" placeholder="Enter Your Recipe Name" /><br />
      Time to Prepare Recipe : <input type="number" name="timeCooked" placeholder="Enter in Minutes" /><br />
      Instructions : <textarea name="instructions" id="term" cols="40" rows="4" placeholder="Enter Instructions"></textarea><br />
      Ingredient 1: <input type="text" name="ingredent" placeholder="Enter Ingredient Name"/>
        <input type="number" name="numMeasure" placeholder="Enter Numeric Amount"/>
        <input type="text" name="catMeasure" placeholder="Enter measurement name (ie: cup, tbsp)" size = 35/><br />
      <input type="submit" value="Submit" />
    </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



  </body>
</html>
