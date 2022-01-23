  <?php

session_start();

require_once("connect.php");

$receiver = 58;

$getReceiver = "SELECT * FROM users WHERE claim = '1'";
$getReceiverResult = mysqli_query($conn,$getReceiver) or die(mysqli_error($conn));
$getReceiverRow = mysqli_fetch_array($getReceiverResult);
?>
  <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Live Chat</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/style.css">
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
        



        ?>
        <li class="nav-item active">
          <a class="nav-link" href="products.php">Products</a>
        </li>

    </div>
  </nav>

<center>
<div style="font-size: 30px;">
<strong>Chatting with Admin:  <?=$getReceiverRow['name'] ?></strong>
</div>
</center>
<br>
<table class="table table-striped">
<?php
$getMessage = "SELECT  chat.* ,users.name FROM chat INNER JOIN users on sentBy=users.id  WHERE sentBy = '$receiver' AND recievedBy = ".$_SESSION['id']." OR sentBy = ".$_SESSION['id']." AND recievedBy = '$receiver' ORDER BY createdAt asc";
$getMessageResult = mysqli_query($conn,$getMessage) or die(mysqli_error($conn));
if(mysqli_num_rows($getMessageResult) > 0) {
	while($getMessageRow = mysqli_fetch_array($getMessageResult)) {	?>
	<tr><div style = "margin: 10;">
	<td>	<h4 style = "color: #FFF;display:inline"><?=$getMessageRow['name']?></h4></td>
	<td>	<p class="text-center" style = "color:#FFF" "display:inline"><?=$getMessageRow['message']?></p></td>
		</div>
		</tr>
<?php } 
} 

else { 
	echo "<tr><td><p>No messages yet! Say 'Hi'</p></td></tr>";
}

?>
</table>
<form class="form-inline" action="" method = "POST">
	<input type="hidden" name = "sentBy" value = "<?=$_SESSION['id']?>"/>
	<input type="hidden" name = "recievedBy" value = "<?=$receiver?>"/>
	<input type="text" name = "message" class="form-control" placeholder = "Type your message here" required/>
	<input type = "submit" style= "color:#FFF"value='send' name='submit' class="btn btn-default" >
</form>
<?php
if(isset($_POST['submit'])) {
	$createdAt = date("Y-m-d h:i:sa");
	$sent_by = $_POST['sentBy'];
	$receiver = $_POST['recievedBy'];
	$message = $_POST['message'];
	$sendMessage = "INSERT INTO chat(sentBy,recievedBy,message,createdAt) VALUES('$sent_by','$receiver','$message','$createdAt')";
	mysqli_query($conn,$sendMessage) or die(mysqli_error($conn));
}
?>
</body>