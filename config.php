<?php
// easy use of headers
ob_start();
// parameters for database login
$host = "localhost";
$username = "authuser";
$password = "123456";
$dbname = "user";
$conn = new mysqli($host,$username,$password,$dbname);
if(!$conn){die("failed connection ". $conn->connect_errno());
}

?>
