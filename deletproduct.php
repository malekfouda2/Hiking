<?php

require_once("connect.php");
$var_value = $_GET['varname'];
$deleteQuery = "DELETE from products where id =$var_value; ";
$result = mysqli_query($conn, $deleteQuery);
if ($result) {
    echo "<script> alert('Product succesfulyy deleted! ') </script>";
}
