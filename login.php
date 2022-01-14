<?php 
// include the configuration file
include confg.php;?>
<?php 
//set variables for errors to empty;
$emailError = $passwordError = accountNotExistError = "";

//email is not empty and verify
// password is not empty, user should remember password

if(isset($_POST['signin'])){
$email =isset($_POST['email']);
$email = filter_var($email, FILTER_SANITISE_EMAIL);
$password = isset($_POST['password']);
$password = mysqli_real_escape_string($conn,$password);
$password = hash_password($password,PASSWORD_BCRYPT);
$sql = " SELECT* FROM user where email = $email AND
password = $password AND status = 1";
$result = mysqli_querry($conn, $sql);
if(mysql_num_rows($result)>0){
while($row = mysqli_fetch_array($result)){
$email = $row['id'];
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$_SESSION['email'] = $email;
$_SESSION['firstname'] =$firstname;
$_SESSION['lastname'] = $lastname;
header("Location:/dashboard");
}
}
}
// set the errors for email, password and signin
if(empty($email)) $emailError = "email cannot be empty";
if(!(filter_var($email,FILTER_VALIDATE_EMAIL))
$emailError = "email is not valid";
if(empty($password)) $passwordError ="email cannot be empty";
if(mysqli_num_rows(result)<1) $accountNotExist =" You are not a registered user";

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
