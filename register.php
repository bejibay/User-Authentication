<?php 
// include the configuration file
include confg.php;?>
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
  <a href="/about">About</a>
  <a href="/contact">Contact</a>
 </div>
<a href="javascript:void(0);" class="icon" onclick="displayIcon()"><i class="fa fa-bars"></i></a>
</div>
<div class="row">
 <div class="col-12">
<form action ="" method ="post">
<h2>Create Account</>
<label for="firstname">Firstname</label>
<input type="text" id="firstname" name="firstname">
<label for="lastname">Lastname</label>
<input type="text" id="lastname" name="lastname">
<label for="email">Email</label>
<input type="text" id="email" name="email">
<label for="password">Password</label>
<input type="text" id="password" name="password">
<label for="confirmpassword">Confirm Password</label>
<input type="text" id="confirmpassword" name="confirmpassword">
<input type ="radio">Contains at least one upper case letter
<input type ="radio">Contains at least one special character
<input type ="radio">Contains at least one number
<input type ="radio">Passwords are matching
<input type="submit" name="signup" value="Sign up">
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
