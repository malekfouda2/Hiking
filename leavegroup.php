<?php
require_once("connect.php");
session_start();
$var_value = $_GET['varname'];
$userId = $_SESSION['id'];
$query="DELETE from joined where user_id=$userId and group_id= $var_value;";
$result = mysqli_query($conn,$query);
if($result){
echo "<script> alert('You succesfully left this group') </script>";
}
?>