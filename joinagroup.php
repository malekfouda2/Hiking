<?php
require_once("connect.php");
session_start();
$var_value = $_GET['varname'];
$userId = $_SESSION['id'];


$query = "INSERT into joined (user_id, group_id) values ('$userId', '$var_value')";
$duplicatesUserId = "SELECT count(*) from joined where user_id = $userId and group_id = $var_value";
$result1 = mysqli_query($conn, $duplicatesUserId);
$int = mysqli_fetch_assoc($result1);

if(implode($int) == 1)
{
    echo '<script> alert("You Have Already Joined This Group!")</script>';
}
else if($result1){
  $result=  mysqli_query($conn, $query);
  header('location:enrollInGroup.php');
}
/*$result =  mysqli_query($conn, $query);
if ($result) {
    header('location:enrollInGroup.php');
}
else{
    echo "something went wrong";
}*/
