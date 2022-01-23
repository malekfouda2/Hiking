<?php

require_once("connect.php");
session_start();
$query = "SELECT * from groups";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hiking</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

  <style>
    .card-container {
      -webkit-perspective: 500px;
      perspective: 500px;
    }

    .card-container:hover .card {
      -webkit-transform: rotateY(180deg);
      transform: rotateY(180deg);
    }

    .card {
      -webkit-transition: -webkit-transform 0.7s;
      transition: transform 0.7s;
      -webkit-transform-style: preserve-3d;
      transform-style: preserve-3d;
    }

    .front,
    .back {
      -webkit-backface-visibility: hidden;
      backface-visibility: hidden;
    }

    .back {
      -webkit-transform: rotateY(180deg);
      transform: rotateY(180deg);
    }

    /*Custom Styles*/
    .cards-container {
      display: -webkit-flex;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-flex-direction: row;
      -webkit-box-orient: horizontal;
      -webkit-box-direction: normal;
      -ms-flex-direction: row;
      flex-direction: row;
      -webkit-box-pack: center;
      -webkit-justify-content: center;
      -ms-flex-pack: center;
      justify-content: center;
    }

    .card {
      width: 300px;
      height: 150px;
      margin: 10px;
    }

    .front,
    .back {
      box-shadow: 0 1px 6px 0;
      position: absolute;
      width: 100%;
      top: 0;
      bottom: 0;
    }

    img {
      display: block;
    }

    .list--centre-justify {
      display: grid;
      place-items: center;
    }

    .contents-centre-justify {
      text-align: center;
    }

    .list--no-marker {
      list-style-type: none;
    }
  </style>
</head>

<body class="myhome" style="    background-image: url('assets/img/home2.svg'); height: 100%;background-position: center;background-repeat: no-repeat;background-size: cover;">

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
        <a class="nav-link" href="cart.php">Cart <span class="sr-only">(current)</span></a>
      </li>';
        }
        if (isset($_SESSION['id'])) {
          echo ' <li class="nav-item active">
        <a class="nav-link" href="contactus.php">Contact Us <span class="sr-only">(current)</span></a>
      </li>';
        }
        if (isset($_SESSION['id'])) {
          echo ' <li class="nav-item active">
        <a class="nav-link" href="usermessage.php"> Live Chat <span class="sr-only">(current)</span></a>
      </li>';
        }




        ?>
        <li class="nav-item active">
          <a class="nav-link" href="products.php">Products</a>
        </li>

    </div>
  </nav>


  <div class="mymargins">

    <div class="row">
      <div class="col-lg-6">
        <div class="intro">
          <h2 class="introtext"> Welcome <?php
                                          if (isset($_SESSION['id'])) {
                                            echo $_SESSION['name'];
                                          }
                                          ?> to MIU Hiking, where every trip is different.</h2>
          <h6>Register to view all the availaible groups and join with the one you feel fits you the most</h6>
          <div class="mybttns">
            <?php
            if (!isset($_SESSION['id'])) {
              echo '<a class="nav-link btn btn-primary cta" href="register.php">Join Us Now <span class="sr-only">(current)</span></a>';
            }
            ?>
            <div>

            </div>
            <button type="button" class="btn btn-primary groupsbttn" onclick="location.href='groups.php'">View all Groups</button>
          </div>

        </div>
      </div>
      <div class="col-lg-6">
        <div class="group">
          <img style="width: 100%" class="myimg" src="assets/img/illustration.svg">
        </div>
      </div>
    </div>
  </div>


  <center>
    <div>
      <h1 class="ml2">Here are some of our Hiking Groups</h1>
    </div>
  </center>
  <br>
  <center>
    <div class="cards-container">
      <div class="row">
        <!--   First Card -->
        <?php
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()) {
          echo '<div class="card-container">';
          echo '<div class="card">';
          echo '<div class="front">';
          echo '<img style="width:100%; height: 100%" src="' . $row['groupPhoto'] . '">';
          echo '</div>';
          echo '<div class="back">';
          echo '<center> <h1 style="color:black; font-size:150%; padding-top:18%; ">' . $row['groupName'] . '</h1></center> ';
          echo  '</div>';
          echo '</div>';
          echo '</div>';
        }
        ?>
      </div>
    </div>
  </center>
  <br>
  <center>

    <div>
      <h1 class="ml3">Meet some of our sponsors</h1>
    </div>
  </center>

  <div class="container">
    <br>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="aboutus">
        <br>

        <div class="carousel-inner" style="margin-top: 0% important;">
          <div class="carousel-item active">
            <img src="assets/img/spons4.svg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="assets/img/spons2.svg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="assets/img/spons3.svg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="assets/img/spons5.svg" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </button>
      </div>
    </div>


    <section>
      <center>
        <h2>Hiking Tips</h2>


        <img src="assets/img/tips.jpg" style="width: 50%; height: 50%">
      </center>
      <div class="list--centre-justify">
        <ul>
          <li>
            Make sure to choose the right trail for your fitness level
          </li>
          <li>
            Check the weather few hours before you head for hiking
          </li>
          <li>
            Once you have selected a trail, familiarize yourself with the route
          </li>
          <li>
            Don’t forget to pack necessary items like sun protection, repair kit, extra food and water
          </li>
        </ul>
      </div>
    </section>


    <div class="row" style="background-color:whitesmoke !important;">


      <div>
        <center>
          <h4 class="about">About Us</h1>

            <br>
            <p class="about">
              Founded in 2011, TravelTriangle is India’s leading online holiday marketplace bringing both the travelers, and trusted & expert travel agents on a common platform. With the recent Series C funding of $12 Million from Nandan Nilekani and Sanjeev Aggarwal backed Fundamentum in early 2018, it is on its way of encompassing all the components of holiday eco-system through its highly innovative and technology-focused product. Besides, having already raised close to a cumulative funding of $20 Million from SAIF Partners, Bessemer Venture Partners and RB Investments put together, the company has already achieved operating profitability, and on track to become EBITDA profitable by next year.

              20 Lakh+
              Travelers monthly visiting us

              650+
              Network of expert travel agents

              65+
              Destinations served worldwide

              97%
              Positive quotient by travelers
            </p>
        </center>
      </div>
    </div>
    <div class="footer">
      <br>
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
    <script>
      var textWrapper2 = document.querySelector('.ml3');
      textWrapper2.innerHTML = textWrapper2.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

      anime.timeline({
          loop: true
        })
        .add({
          targets: '.ml3 .letter',
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