<?php

require_once("connect.php");
$var_value = $_GET['varname'];
$deleteQuery = "DELETE from groups where id =$var_value; ";
$result = mysqli_query($conn,$deleteQuery);
if($result)
{
    echo "<script> alert('Group succesfully deleted!') </script>";
}
?>