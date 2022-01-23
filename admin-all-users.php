<?php

require_once("connect.php");
$query = "SELECT * FROM users Where claim = 0";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
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
        <button type="button" class="btn btn-primary" onclick="location.href='admin-add-user.php'">Add Users</button>

    </div>
    <div class="container">
        <div class='row myprods'>

            <?php


            $result->data_seek(0);
            while ($row = $result->fetch_assoc()) {
                $imageURL = 'images/' . $row["photo"];
                echo "<form method='POST' action=''>";
                echo "<div style='margin-top: 3%' class='col-lg'>";
                echo    "<div class='card' style='width: 18rem;'>";
                echo        "<img src='" . $imageURL . " ' class='card-img-top' alt='...'>";
                echo        "<div class='card-body'>";
                echo          "<h5 class='card-title'>"  . $row['name'] . "</h5>";
                echo          "<p class='card-text'>" . $row['email'] . "</p>";
                echo          "<a href='admin-edit-users.php?varname=$row[id]' class='btn btn-primary'>Edit User</a>";
                echo "       <a name='delete' href='deleteuser.php?varname=$row[id]' type='submit' class='btn btn-primary'>Delete User</a>";
                echo        "</div>";
                echo      "</div>";
                echo      "</div>";
                echo     "</form>";
            }
            ?>

        </div>
    </div>
</body>

</html>