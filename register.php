


<?php 
// include the configuration file
include confg.php;?>
<?php 
<?php 
if(isset($_POST['signup'])){
//define variables
$firstname=isset($_POST['firstname']);
$lastname=isset($_POST['lastname']);
$email=isset($_POST['email']);
$password=isset($_POST['password']);
$confirmpassword=isset($_POST['confirmpassword']);
if(preg_match(/^[A-Za-z]+$/,$firstname)&&
preg_match(/^[A-Za-z]+$/,$lastname)&&
preg_match(/^[A-Za-z]+$/,$password)&&
preg_match(/^[A-Za-z]+$/,$confirmpassword)&&
filter_var(FILTER_VALIDATE_EMAIL($email))&&
$password===$confirmpassword){
$sql="SELECT* FROM user where email=$email";
mysqli_query($con, $sql);
$count = mysqli_num_rows();
if($count>0){$emailError = "email already exist";}
else={

}


}
}
<?php 
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
 </div>
<a href="javascript:void(0);" class="icon" onclick="displayIcon()"><i class="fa fa-bars"></i></a>
</div>
<div class="row">
 <div class="col-12">
<form action ="" method ="post">
<h2>Create Account</>
<label for="firstname">Firstname</label>
<div>
<input type="text" id="firstname" name="firstname">
<i class fa fa-user icon"></i>
</div>
<label for="lastname">Lastname</label>
<div>
<input type="text" id="lastname" name="lastname">
<i class fa fa-user icon"></i>
</div>
<label for="email">Email</label>
<div>
<input type="text" id="email" name="email">
<i class fa fa-envelope icon"></i>
</div>
<label for="password">Password</label>
<div>
<input type="text" id="password" name="password">
<i class fa fa-key icon"></i>
</div>
<label for="confirmpassword">Confirm Password</label>
<div>
<input type="text" id="confirmpassword" name="confirmpassword">
<i class fa fa-key icon"></i>
</div>
<input type ="radio">Contains at least one upper case letter
<input type ="radio">Contains at least one special character
<input type ="radio">Contains at least one number
<input type ="radio">Passwords are matching
<input type="submit" name="signup" value="Sign up">
</form>
<p>Already a member <a href="/login">Sign In </a></p>
</div>
</div>
<div class="footer">
&copy; copyright  ABC limited
</div>
<script src="landingpage.js"></script>
</div>
</body>
</html>
