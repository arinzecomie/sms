<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sms_user";
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>