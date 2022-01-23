<?php
require_once("connect.php");
session_start();
$userId = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

  <title>My Group</title>
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
        <a class="nav-link" href="login.php">Cart <span class="sr-only">(current)</span></a>
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
      $getGroups = "SELECT * from joined  WHERE user_id = $userId";
      $result2 =  mysqli_query($conn, $getGroups);
      if ($result2) {
        while ($rowData = mysqli_fetch_assoc($result2)) {
          $selectGroups = "SELECT * from groups where id = $rowData[group_id]";
          $result3 =  mysqli_query($conn, $selectGroups);
          if ($selectGroups) {
            while ($rowData2 = mysqli_fetch_assoc($result3)) {
              echo "<div style='margin-top: 3%' class='col-lg'>";
              echo    "<div class='card' style='width: 18rem;'>";
              echo        "<img src='" . $rowData2['groupPhoto'] . " ' class='card-img-top' alt='...'>";
              echo        "<div class='card-body'>";
              echo          "<h5 class='card-title'>"  . $rowData2['groupName'] . "</h5>";
              echo          "<p class='card-text'>" . $rowData2['groupDesc'] . "</p>";
              echo          "<a href='leavegroup.php?varname=$rowData2[id]' class='btn btn-primary'>leave group</a>";
              echo        "</div>";
              echo      "</div>";
              echo      "</div>";
            }
          }
        }
      } else if (!$result2) {
        echo "no data to show";
      }
      ?>
    </div>
  </div>
</body>

</html>