<?php

require_once("connect.php");


if (isset($_POST['submit'])) {

  $groupName = $_POST["groupName"];
  if (empty($_POST["groupName"])) {

    echo '<script>alert ("group  name is required")</script>';
    return false;
  }
  if (!preg_match("/[a-zA-Z- ]*$/", $groupName)) {
    //$nameErr = "Only letters and white space allowed";
    echo '<script> alert("Only letters and numbers are allowed") </script> ';
    return false;
  }




  $groupDesc = $_POST["groupDesc"];
  if (empty($_POST["groupDesc"])) {

    echo '<script>alert ("group describtion is required")</script>';
    return false;
  }




  $groupPhoto = $_FILES['groupPhoto']['name'];

  $target = "images/" . $groupPhoto;
  move_uploaded_file($_FILES['groupPhoto']['tmp_name'], $target);

  $resultset_1 = mysqli_query($conn, "select * from groups where groupName='" . $groupName . "'  ");
  $count = mysqli_num_rows($resultset_1);

  if ($count > 0) {
    echo '<script> alert("this group  already Exist ")</script>';
  } else {
    $sql = "INSERT INTO groups (groupName,groupDesc,groupPhoto) values('$groupName','$groupDesc','$groupPhoto')";
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
  <title>Add Group</title>

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
      <h1 class="ml2">Add A Group</h1>
    </center>
    <div class="jumbotron">
      <form action='' method='POST' enctype='multipart/form-data'>
        <div class="form-group">
          <label>Name</label>
          <input name="groupName" type="text" class="form-control" placeholder="Enter Group Name">
        </div>
        <div class="form-group">
          <label>Desc</label>
          <input name="groupDesc" type="text" class="form-control" placeholder="Enter Group Description">
        </div>
        <div class="form-group">
          <label>Image</label>
          <input name="groupPhoto" type="file" class="form-control">
        </div>
        <center>
          <button name="submit" type="submit" value="upload" class="btn btn-primary mybtn">Submit</button>
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