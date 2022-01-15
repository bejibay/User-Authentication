<?php
// easy use of headers
ob_start();
// parameters for database login
$host = "localhost";
$username = "user";
$password = " 123456";
$dbname = "user";
$conn = mysqli_connect($host,$username,$password,$dbname);
if(!$conn){die("failed connection ". mysqli_connect_errno());
}

?>
