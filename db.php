<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "newproject";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$db;charset=utf8", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo $e->getMessage();
}




ob_start();
session_start();


?>