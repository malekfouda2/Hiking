<?php

require_once("connect.php");
session_start();


if (isset($_POST['submit'])) {



  $name = $_POST["name"];
  if (empty($_POST["name"])) {

    echo '<script>alert ("name is required")</script>';
  }
  if (!preg_match("/[a-zA-Z- ]*$/", $name)) {
    echo '<script> alert("Only letters and numbers are allowed") </script> ';
  }


  $password = $_POST["password"];
  if (empty($_POST["password"])) {

    echo '<script>alert ("password is required")</script>';
  }
  $sql = "SELECT * from users where name ='$name' and password='$password'";
  $result = mysqli_query($conn, $sql);
  try{
if(!$result)
    throw new Exception("Error occured!!");
    
  
} catch (Exception $e) {
  echo "Message:",$e->getMessage();
}


  if ($row = mysqli_fetch_array($result)) {
    echo "Success";
    if ($row[4] == 1) {
      $_SESSION["id"] = $row[0];
      $_SESSION["name"] = $row[1];
      header('Location: admin-panel.php');
    } else {
      $_SESSION["id"] = $row[0];
      $_SESSION["name"] = $row[1];
      header('Location: index.php');
    }
  } else {
    echo "<script> alert('invalid Username or Password')</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

</head>

<body class="myhome">
  <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <a class="navbar-brand" href="index.php">MIU HIKING</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">

        <li class="nav-item">
          <a class="nav-link active" href="products.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="register.php">Register</a>
        </li>
      </ul>


    </div>
  </nav>
  <div class="container">
    <center>
      <h1 class="ml2">Login to MIU Hiking</h1>
    </center>
    <div class="jumbotron">
      <form method="POST">
        <div class="form-group">
          <label>Name</label>
          <input name="name" type="text" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input name="password" type="password" class="form-control" required>
        </div>
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
  <script>
    var textWrapper = document.querySelector('.ml2');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({
        loop: true
      })
      .add({
        targets: '.ml2 .letter',
        scale: [4, 1],
        opacity: [0, 1],
        translateZ: 0,
        easing: "easeOutExpo",
        duration: 950,
        delay: (el, i) => 70 * i
      }).add({
        targets: '.ml2',
        opacity: 0,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1000
      });
  </script>
</body>

</html>