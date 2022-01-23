  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php
session_start();

require_once("connect.php");

 
?>

<form class="form-inline" method = "POST" action = "">
	<input type="text" name="name" placeholder="Search" class="form-control">
	<input type="submit" value='Search' name='search' class="btn btn-default">
</form>
<?php
if(isset($_POST['search'])) {
	$search=$_POST['name'];
	$searchUser = "SELECT * FROM users WHERE name = '$search'";
	$searchUserResult = mysqli_query($conn,$searchUser);

	while($searchUserRow = mysqli_fetch_array($searchUserResult)){	?>
		<div>
		<img src = "images/<?php echo $searchUserRow[6];?>" class="img-circle" width = "100"/><br><br>

		<?php echo $searchUserRow['name'];?>
		<br><br>
		<a href="message.php?receiver=<?php echo $searchUserRow[0];?>">Send message</a><br><br>
		</div>
		
<?php }
}
?>
<div>
<?php
$lastMessage = "SELECT DISTINCT sentBy FROM chat WHERE recievedBy = ".$_SESSION['id'];
$lastMessageResult = mysqli_query($conn,$lastMessage) or die(mysqli_error($conn));
if(mysqli_num_rows($lastMessageResult) > 0) {
	while($lastMessageRow = mysqli_fetch_array($lastMessageResult)) {
		$sent_by = $lastMessageRow['sentBy'];
		$getSender = "SELECT * FROM users WHERE id = '$sent_by'";
		$getSenderResult = mysqli_query($conn,$getSender) or die(mysqli_error($conn));
		$getSenderRow = mysqli_fetch_array($getSenderResult);
		?>
		<div>
		<img src = "./images/<?=$getSenderRow['image']?>" class="img-circle" width = "40"/> 
		<?=$getSenderRow['name'];?>
		<a href="./message.php?receiver=<?=$sent_by?>">Send message</a>
		</div><br>
<?php }
} 
else {
	echo "No conversations yet!";
}
?>
</div>

