<?php

require_once("connect.php");


if (isset($_POST['submit'])) {

  $productName = $_POST["productName"];
  if (empty($_POST["productName"])) {

    echo '<script>alert ("product name is required")</script>';
    return false;
  }
  if (!preg_match("/[a-zA-Z- ]*$/", $productName)) {
    //$nameErr = "Only letters and white space allowed";
    echo '<script> alert("Only letters and numbers are allowed") </script> ';
    return false;
  }



  $productDesc = $_POST["productDesc"];
  if (empty($_POST["productDesc"])) {

    echo '<script>alert ("product describtion is required")</script>';
    return false;
  }

  if (!preg_match("/[a-zA-Z- ]*$/", $productDesc)) {
    //$nameErr = "Only letters and white space allowed";
    echo '<script> alert("Only letters and numbers are allowed") </script> ';
    return false;
  }




  $productPrice = $_POST["productPrice"];
  if (empty($_POST["productPrice"])) {

    echo '<script>alert ("product price is required")</script>';
  }
  if (!preg_match("/[a-zA-Z- ]*/", $productPrice)) {
    //$nameErr = "Only letters and white space allowed";
    echo '<script> alert("Only numbers and $  are allowed") </script> ';
  }



  $productPhoto = $_FILES['productPhoto']['name'];
  $target = "images/" . $productPhoto;
  move_uploaded_file($_FILES['productPhoto']['tmp_name'], $target);


  $resultset_1 = mysqli_query($conn, "select * from products where productName='" . $productName . "'  ");
  $count = mysqli_num_rows($resultset_1);



  if ($count > 0) {
    echo '<script> alert("this product already Exist ")</script>';
  } else {
    $sql = "INSERT INTO products(productName,productDesc,productPrice,productPhoto) values('$productName','$productDesc','$productPrice','$productPhoto')";
    $result = mysqli_query($conn, $sql);
    try{
    if(!$result)
    throw new Exception("Error occured!!");
    
  
} catch (Exception $e) {
  echo "Message:",$e->getMessage();
}

    echo '<script> alert("Done :) ")</script>';
    mysqli_close($conn);
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Product</title>

  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

</head>

<body class="myhome">
  <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <a class="navbar-brand" href="#">MIU HIKING</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
        <li class="nav-item active">
          <a class="nav-link" href="admin-panel.php">Home <span class="sr-only">(current)</span></a>
        </li>


        <li class="nav-item">
          <a class="nav-link disabled">Admin Panel</a>
        </li>
      </ul>

    </div>
  </nav>
  <div class="container">
    <div class="jumbotron">
      <form action='' method='POST' enctype='multipart/form-data'>
        <div class="form-group">
          <label>Name</label>
          <input name="productName" type="text" class="form-control" placeholder="Enter Product Name" required>
        </div>
        <div class="form-group">
          <label>Desc</label>
          <input name="productDesc" type="text" class="form-control" placeholder="Enter Product Description" required>
        </div>
        <div class="form-group">
          <label>Price</label>
          <input name="productPrice" type="text" class="form-control" placeholder="Enter Product Price" required>
        </div>
        <div class="form-group">
          <label>Image</label>
          <input name="productPhoto" type="file" class="form-control">
        </div>
        <center>
          <button name="submit" type="submit" value="upload" class="btn btn-primary mybtn">Submit</button>
        </center>
      </form>
    </div>
  </div>

</body>

</html>