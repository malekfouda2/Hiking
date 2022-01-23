<?php

session_start();
require_once("connect.php");


$var_value = $_GET['varname'];

$query = "SELECT productName, productDesc, productPrice, productPhoto FROM products WHERE id = $var_value";
$result2 = mysqli_query($conn, $query);
$row = mysqli_fetch_row($result2);

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


  
    $sql = "UPDATE products set productName = '$productName', productDesc = '$productDesc', productPrice='$productPrice', productPhoto = '$productPhoto' where id=$var_value";
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Users</title>

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
        <center>
            <h1 class="ml2">Edit Product</h1>
        </center>
        <div class="jumbotron">
            <form action='' method='POST' enctype='multipart/form-data'>
                <div class="form-group">
                    <label>Product Name</label>
                    <input name="productName" type="text" class="form-control" value="<?php echo $row[0] ?>">
                </div>
                <div class="form-group">
                    <label>Product Description</label>
                    <input name="productDesc" type="text" class="form-control" value="<?php echo $row[1] ?>">
                </div>
                <div class="form-group">
                    <label>Product Price</label>
                    <input name="productPrice" type="text" class="form-control" value="<?php echo $row[2] ?>">
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input name="productPhoto" type="file" class="form-control" required>
                </div>
                <center>
                    <button name="submit" type="submit" value="upload" class="btn btn-primary mybtn">Edit</button>
                </center>
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