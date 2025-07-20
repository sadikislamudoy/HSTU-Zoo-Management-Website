<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "zoo_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);

}
$conn = new mysqli("localhost", "root", "", "zoo_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>