<?php

require_once("connect.php");
$var_value = $_GET['varname'];
$deleteQuery = "DELETE from users where id =$var_value; ";
$result = mysqli_query($conn, $deleteQuery);
if ($result) {
    echo "<script> alert('User succesfulyy deleted! ') </script>";
}
