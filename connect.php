<?php 
$conn = new mysqli("localhost", "root", "", "hiking");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
