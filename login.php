<?php 
// include the configuration file
include confg.php;?>
<?php 
if(isset($_POST['signin'])){
$email =isset($_POST['email']);
$password = isset($_POST['password']);
$password = hash_password($password);
$sql = " SELECT* FROM user where email = $email AND
password = $password";
mysqli_querry($conn, $sql);
if(mysql_num_rows()=1){
$_SESSION['email'];
$_SESSION['firstname'];
$_SESSION['lastname'];
header("location:/dashboard");
}

}

?>
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
<form action ="" method ="post">
<h2>Sign In</h2>
<label for="email">Email:</label>
<input type="text" id="email" name="email" placeholder="johndoe@gmail.com">
<label for="password">Password:</label>
<input type="text" id="password" name="password" placeholder="password">
<input type="submit" name="signin" value="Sign In">
</form>
<p>Don't have an account <a href="/register">Sign up</a>
</div>
</div>
<div class="footer">
&copy; copyright  ABC limited"
</div>
<script src="landingpage.js"></script>
</div>
</body>
</html>
