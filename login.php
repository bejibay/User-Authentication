
<?php 
// include the configuration file
include "config.php";?>
<?php 
//variables for errors;
global $emailError, $passwordError, $accountError ;

if(isset($_POST['signin'])){
$email =isset($_POST['email']);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
$email = filter_var($email, FILTER_SANITISE_EMAIL);
$password = isset($_POST['password']);
$password = mysqli_real_escape_string($conn,$password);
$password = hash_password($password,PASSWORD_BCRYPT);

// set the errors for email, password and signin
if(empty($email)) $emailError = "email cannot be empty";
if(!filter_var($email,FILTER_VALIDATE_EMAIL))
$emailError = "email is not valid";
if(empty($password)) $passwordError ="password cannot be empty";
$sql = "SELECT* FROM user where email = $email";
$resultone = mysqli_querry($conn, $sql);
if(mysql_num_rows($resultone)>0){
$sql ="SELECT* FROM user where password =$password AND
status = 1";
if(mysqli_num_rows(resultone)<1) $accountError =" invalid entries or account not exist";
$resulttwo = mysqli_querry($conn, $sql);
if(mysql_num_rows($resulttwo)>0){
while($row = mysqli_fetch_array($resulttwo)){
$email = $row['id'];
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$_SESSION['email'] = $email;
$_SESSION['firstname'] =$firstname;
$_SESSION['lastname'] = $lastname;
header("Location:/dashboard");
}
if(mysqli_num_rows(resulttwo)<1) $passwordError ="Password is incorrect";
}
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
  <a href="#">About</a>
  <a href="#">Contact</a>
 </div>
<a href="javascript:void(0);" class="icon" onclick="displayIcon()"><i class="fa fa-bars"></i></a>
</div>
<div class="row">
 <div class="col-12">
<form action ="" method ="post">
<h2>Sign In</h2>
<label for="email" class="userlogin">Email:</label>
<div class ="userlogin">
<input type="text" class="userlogin" id="email" name="email" placeholder="johndoe@gmail.com">
<i class ="fa fa-envelope icona"></i>
<label for="password" class="userlogin">Password:</label>
</div>
<div class ="userlogin">
<input type="text" class ="userlogin" id="password" name="password" placeholder="password">
<i class ="fa fa-key icona"></i>
</div>
<input type="submit" name="signin" value="Sign In">
</form>
<p class ="pbuttom">Don't have an account <a href="/register" class ="sign">Sign up</a>
</div>
</div>
<div class="footer">
&copy; copyright  ABC limited"
</div>
<script src="landingpage.js"></script>
</div>
</body>
</html>
