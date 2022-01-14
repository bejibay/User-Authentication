


<?php 
// include the configuration file
include confg.php;?>
<?php 
<?php 
//set variables for errors to empty;
$emailError = $passwordError = accountError = "";
if(isset($_POST['signup'])){
//define variables
$firstname=isset($_POST['firstname']);
$lastname=isset($_POST['lastname']);
$email=isset($_POST['email']);
$password=isset($_POST['password']);
$confirmpassword=isset($_POST['confirmpassword']);
$passwordpattern ="/^(?=.*[A-Z])(?=.*[0-9])(?=.*[@#\-_$%^&+=§!\?])
[0-9A-Za-z@#\-_$%^&+=§!\?]{8}$/";
                    
if(preg_match("/^[A-Za-z]*$/",$firstname)&&
preg_match("/^[A-Za-z]*$/",$lastname)&&
preg_match($passwordpattern,$password)&&
 && filter_var($email, FILTER_VALIDATE_EMAIL)&&
$password==$confirmpassword){
$sql="SELECT* FROM user where email=$email";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)<1){

//generate activation URL
$activationurl =md5(rand(0,999).time());

//sanitise against SQL injection
$firstname = mysqli_real_escape_string($conn, $firstname);
$lastname = mysqli_real_escape_string($conn, $lastname);
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

//hash the password
$passwordhash = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO user(firstname,lastname,email,
password,date,activationurl,status)VALUES($firstname,$lastname,$email,$password,
time(),$activationurl,$status)";
mysqli_querry($conn,$sql);
if(mysqli_query($conn,$sql)){

//send activation email

$to = $_POST['email'];
$subject = " Activate jour account";
$msg = 'Click on email below to activate <br>
<a href="/activation.php?activationurl='.$activationurl.'">Click to activate</a >'
$headers = "from:bejibay@gmail.com";
mail($to,$subject,$msg,$header);
}
}
}
}
}
}
//set the errors for email, password and signup
if(empty($firstname)) $fnameError = "firstname cannot be empty";
if(empty($lastname)) $lnameError = "lastname cannot beg empty";
if(empty($email)) $emailError = "email cannot be empty";
if(empty($password)) $passwordError ="password cannot be empty";
if($password != $confirmpassword) $passwordError =  " passwords do not match";
if(!(filter_var($email,FILTER_VALIDATE_EMAIL))
$emailError = "email is not valid";
if(!preg_match($passwordpattern,$password)) $passwordError = "password not valid";
if(mysqli_num_rows(result)>1) $accountError ="email already used";
if(!mysqli_query($conn,$sql)) $accountError ="account not created";
?>
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
<div class ="userlogin">
<label for="firstname">Firstname</label>
<label for="lastname">Lastname</label>
</div>
<div>
<div class="register">
<input type="text" id="firstname" name="firstname">
<i class fa fa-user icona"></i>
</div>
<div class="register">
<input type="text" id="lastname" name="lastname">
<i class fa fa-user icona"></i>
</div>
</div>
<label for="email" class ="userlogin">Email</label>
<div class ="userlogin">
<input type="text" id="email" name="email" class "userlogin">
<i class fa fa-envelope icona"></i>
</div>
<div class =" userlogin">
<label for="password">Password</label>
<label for="confirmpassword">Confirm Password</label>
</div>
<div class ="register">
<input type="text" id="password" name="password">
<i class fa fa-key icona"></i>
</div>
<div class ="register">
<input type="text" id="confirmpassword" name="confirmpassword">
<i class fa fa-key icona"></i>
</div>
<div class="sign"><input type ="radio">Contains at least one upper case letter</div>
<input type ="radio">Contains at least one special character
<input type ="radio">Contains at least one number
<input type ="radio">Passwords are matching
<input type="submit" name="signup" value="Sign up">
</form>
<p class ="pbuttom">Already a member <a href="/login" class ="sign">Sign In </a></p>
</div>
</div>
<div class="footer">
&copy; copyright  ABC limited
</div>
<script src="landingpage.js"></script>
</div>
</body>
</html>
