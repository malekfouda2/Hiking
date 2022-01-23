<?php

require_once("connect.php");


$var_value = $_GET['varname'];

$query = "SELECT * FROM groups WHERE id = $var_value";
$result2 = mysqli_query($conn, $query);
$row = mysqli_fetch_row($result2);
$var = "a7a";

if (isset($_POST['submit'])) {

    $groupName = $_POST["groupName"];
    if (empty($_POST["groupName"])) {

        echo '<script>alert ("Group name is required")</script>';
        return false;
    }
    if (!preg_match("/[a-zA-Z- ]*$/", $groupName)) {
        //$nameErr = "Only letters and white space allowed";
        echo '<script> alert("Only letters and numbers are allowed") </script> ';
        return false;
    }


    $groupDesc = $_POST["groupDesc"];
    if (empty($_POST["groupDesc"])) {

        echo '<script>alert ("Group Describtion is required")</script>';
        return false;
    }
    if (!preg_match("/[a-zA-Z- ]*$/", $groupDesc)) {
        //$nameErr = "Only letters and white space allowed";
        echo '<script> alert("Only letters and numbers are allowed") </script> ';
        return false;
    }



    $groupPhoto = $_FILES['groupPhoto']['name'];
    $target = "images/" . $groupPhoto;
    move_uploaded_file($_FILES['groupPhoto']['tmp_name'], $target);


   $resultset_1 = mysqli_query($conn, "select * from groups where groupName='" . $groupName . "'  ");
  $count = mysqli_num_rows($resultset_1);

   
  $sql = "UPDATE groups set groupName = '$groupName', groupDesc = '$groupDesc', groupPhoto = '$groupPhoto' where id=$var_value";   
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
                    <input name="groupName" type="text"  class="form-control" value="<?php echo $row[1] ?>"required>
                </div>
                <div class="form-group">
                    <label>Desc</label>
                    <input name="groupDesc" type="text" class="form-control" value="<?php echo $row[2] ?>" required>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input name="groupPhoto" type="file" class="form-control" required>
                </div>
                <center>
                    <button name="submit" type="submit" value="upload" class="btn btn-primary mybtn">Edit</button>
                </center>
            </form>
        </div>
    </div>

</body>

</html>