<?php 
// include the configuration file
include confg.php;
session_start();
if(!isset($_SESSION));
?>
<?php 
// include the configuration file
include confg.php;?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Create Accohnt</title>
<meta name="description" content="create account">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="auth.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id="container">
<div class="topnav">
<div id="mytopnav">
  <a href="#">About</a>
  <a href="#">Contact</a>
   <a href="/logout">Log Out</a>
 </div>
<a href="javascript:void(0);" class="icon" onclick="displayIcon()"><i class="fa fa-bars"></i></a>
</div>
<div class="row">
 <div class="col-12">
<?php 
if(isset($_SESSION['email'])){
echo "<h3>Welcome</h3>";
echo "you are logged in as ".$_SESSION['firstname']."".$_SESSION['lastname'];
}
?>
</div>
<div class="footer">
&copy; copyright  ABC limited
</div>
<script src="landingpage.js"></script>
</div>
</body>
</html>
