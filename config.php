<?php
// easy use of headers
ob_start();
// parameters for database login
$host = "localhost";
$username = "authuser";
$password = "123456";
$dbname = "user";
$conn = new mysqli(localhost,userauth,password,dbname);
if(!$conn){die("failed connection ". mysqli_connect_errno());
}

?>
