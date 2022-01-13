<?php 
// include the configuration file
include confg.php;?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login Page</title>
<meta name="description" content="login page">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="auth.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id="container">
<div class="topnav">
<div id="mytopnav">
  <a href="/about">About</a>
  <a href="/contact">Contact</a>
 </div>
<a href="javascript:void(0);" class="icon" onclick="displayIcon()"><i class="fa fa-bars"></i></a>
</div>
<div class="row">
 <div class="col-12">
<h1>LOGIN</h1>
</div>
<div>
<div class="col-6">
<form action ="" method ="post">
<label for="name">Name:</label>
<input type="text" id="name" name="name">
<label for="email">Email:</label>
<input type="text" id="email" name="email">
<label for="phone">Pone Number:</label>
<input type="text" id="phone" name="phone">
<input type="submit" value="SUBMIT">
</form>
</div>
</div>
<div class="footer">
&copy; copyright  ABC limited
</div>
<script src="landingpage.js"></script>
</div>
</body>
</html>
