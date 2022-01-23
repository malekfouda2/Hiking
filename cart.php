<?php
require_once("connect.php");
session_start();
$userId = $_SESSION['id'];

if (isset($_POST["query"]))
  $userId = $_SESSION['id'];
$total = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</head>

<body class="myhome">
  <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <a class="navbar-brand" href="index.php">MIU HIKING</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
        <?php
        $getotal = "SELECT SUM(products.productPrice) from products inner join cart on productID WHERE products.id = cart.productID;";
        $result =  mysqli_query($conn, $getotal);
        $tagID = mysqli_fetch_assoc($result);

        if ($result) {
          $total = implode($tagID);
        }


        if (!isset($_SESSION['id'])) {
          echo ' <li class="nav-item active">
        <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
      </li>';
        } else if (isset($_SESSION['id'])) {
          echo ' <li class="nav-item active">
        <a class="nav-link" href="profile.php">Profile <span class="sr-only">(current)</span></a>
      </li>';
        }

        if (isset($_SESSION['id'])) {
          echo ' <li class="nav-item active">
        <a class="nav-link" href="signout.php">Logout <span class="sr-only">(current)</span></a>
      </li>';
        }


        if (isset($_SESSION['id'])) {
          echo ' <li class="nav-item active">
        <a class="nav-link" href="contactus.php">Contact Us <span class="sr-only">(current)</span></a>
      </li>';
        }






        ?>
        <li class="nav-item active">
          <a class="nav-link" href="products.php">Products</a>
        </li>

    </div>
  </nav>
  <div class="container">

    <div class='row myprods'>

      <?php

      $getProducts = "SELECT * from cart  WHERE userID = $userId";
      
      $result2 =  mysqli_query($conn, $getProducts);
      if ($result2) {
        while ($rowData = mysqli_fetch_assoc($result2)) {
          $selectProducts = "SELECT * from products where id = $rowData[productID]";
          $result3 =  mysqli_query($conn, $selectProducts);
          if ($selectProducts) {
            while ($rowData2 = mysqli_fetch_assoc($result3)) {
              echo "<div style='margin-top: 3%' class='col-lg'>";
              echo    "<div class='card' style='width: 18rem;'>";
              echo        "<img src='" . $rowData2['productPhoto'] . " ' class='card-img-top' alt='...'>";
              echo        "<div class='card-body'>";
              echo          "<h5 class='card-title'>"  . $rowData2['productName'] . "</h5>";
              echo          "<p class='card-text'>" . $rowData2['productPrice'] . "</p>";
              echo          "<a href='removeCart.php?varname=$rowData2[productID]' class='btn btn-primary'>Remove From Cart</a>";

              echo        "</div>";
              echo      "</div>";
              echo      "</div>";
            }
          }
        }
      }
      ?>

      <a href='checkout.php' class='btn btn-primary' style="margin-top: 3%;">Checkout(<?php echo $total ?>)</a>
</body>

</html>