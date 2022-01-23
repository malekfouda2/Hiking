<?php
require_once("connect.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</head>

<body class="myhome">
  <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <a class="navbar-brand" href="#">MIU HIKING</a>
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
        }



        if (isset($_SESSION['id'])) {
          echo ' <li class="nav-item active">
  <a class="nav-link" href="signout.php">Logout <span class="sr-only">(current)</span></a>
</li>';
        }



        ?>
        <li class="nav-item active">
          <a class="nav-link" href="admin-panel.php">Home <span class="sr-only">(current)</span></a>
        </li>


        <li class="nav-item">
          <a class="nav-link disabled">Admin Panel</a>
        </li>
      </ul>



  </nav>



  <div class="container">
    <div class="centerdiv">
      <div class="col-lg">
        <button type="button" class="btn btn-primary" onclick="location.href='admin-all-groups.php'">Manage Groups</button>
      </div>
      <div class="col-lg">
        <button type="button" class="btn btn-primary" onclick="location.href='admin-all-users.php'">Manage Hikers</button>
      </div>
      <div class="col-lg">
        <button type="button" class="btn btn-primary" onclick="location.href='admin-all-admins.php'">Manage Administrators</button>
      </div>
      <div class="col-lg">
        <button type="button" class="btn btn-primary" onclick="location.href='admin-all-products.php'">Manage Products</button>
      </div>
      <div class="col-lg">
        <button type="button" class="btn btn-primary" onclick="location.href='adminmessages.php'">View Messages</button>
      </div>
    </div>
  </div>

</body>

</html>