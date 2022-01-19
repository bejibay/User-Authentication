<?php
// easy use of headers
ob_start();
define("DB_DSN", "mysql:host=localhost;dbname=user");
define("DB_USERNAME", "soowecca");
define("DB_PASSWORD", "password");
$conn= new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
?>
