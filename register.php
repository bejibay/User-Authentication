<?php 
// include the configuration file
include "config.php";?>
<?php 
//variables for errors

global $fnaemeError,$lnameError,$emailError,
$passwordError, $accountError;

if(isset($_POST['signup'])){
//define variables
$firstname=isset($_POST['firstname']);
$lastname=isset($_POST['lastname']);
$email=isset($_POST['email']);
$password=isset($_POST['password']);
$confirmpassword=isset($_POST['confirmpassword']);
//set password pattern
$passwordpattern ="/^(?=.*[A-Z])(?=.*[0-9])(?=.*[@#\-_$%^&+=§!\?])
[0-9A-Za-z@#\-_$%^&+=§!\?]{8}$/";

//set the errors for email and password
if(empty($firstname)) $fnameError = "firstname cannot be empty";
if(empty($lastname)) $lnameError = "lastname cannot beg empty";
if(empty($email)) $emailError = "email cannot be empty";
if(empty($password)) $passwordError ="password cannot be empty";
if($password != $confirmpassword) $passwordError =  " passwords do not match";
if(!(filter_var($email,FILTER_VALIDATE_EMAIL)))
$emailError = "email is not valid";
if(!preg_match($passwordpattern,$password)) $passwordError = "password not valid";
                    
if(preg_match("/^[A-Za-z]*$/",$firstname)&&
preg_match("/^[A-Za-z]*$/",$lastname)&&
preg_match($passwordpattern,$password)
 && filter_var($email, FILTER_VALIDATE_EMAIL)&&
$password==$confirmpassword){
$sql="SELECT* FROM user where email=:email";
$conn->prepare($sql);
$stmt->bindValue(": email", $email,PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch();
if($row)$accountError ="email already used";
if(!$row){
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
password,date,activationurl,status)VALUES(:firstname,:lastname,:email,:password,
:date,:activationurl,:status)";
$conn->prepare($sql);
$stmt->bindValue(":firstname", $firstname, PDO::PARAM_STR);
$stmt->bindValue(":lastname", $lastname,PDO::PARAM_STR);
$stmt->bindValue(":email", $email,PDO::PARAM_STR);
$stmt->bindValue(":password", $password,PDO::PARAM_STR);
$stmt->bindValue(":date", time(),PDO::PARAM_INT);
$stmt->bindValue(":activationurl", $activationurl,PDO::PARAM_STR);
$stmt->bindValue(":status",1,PDO::PARAM_INT);
$stmt->execute();

//send activation email

$to = $_POST['email'];
$subject = " Activate your account";
$msg = 'Click on email below to activate <br>
<a href="/activation.php?activationurl='.$activationurl.'">
Click to activate</a >';
$headers = "From:bejibay@gmail.com";
mail($to,$subject,$msg,$headers);
$accountSuccess = " check your email to activate your account";
}
else{$accountError ="account not created";}
}
}


<!DOCTYPE html>
<html lang="en">
<head>
<title>Create An Account</title>
<meta name="description" content="Create An Account">
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
<h2>Create Account</h2>
<label for="firstname" class="userlogin">Firstname</label>
<label for="lastname" class="userlogin">Lastname</label>
<div>
<input type="text" class="userlogin" id="firstname" name="firstname" placeholder="John">
<i class ="fa fa-user icona"></i>
</div>
<div>
<input type="text" class="userlogin" id="lastname" name="email" placeholder="Doe">
<i class ="fa fa-user icona"></i>
</div>
<label for="email" class="userlogin">Email:</label>
<div class ="userlogin">
<input type="text" class="userlogin" id="email" name="email" placeholder="johndoe@gmail.com">
<i class ="fa fa-envelope icona"></i>
</div>
<label for="password" class="userlogin">Password</label>
<label for="confirmpassword" class="userlogin">Confirmpassword</label>
<div class ="userlogin">
<input type="text" class ="userlogin" id="password" name="password" placeholder="password">
<i class ="fa fa-key icona"></i>
</div>
<div class ="userlogin">
<input type="text" class ="userlogin" id="confirmpassword" name="confirmpassword" placeholder="password">
<i class ="fa fa-key icona"></i>
</div>
<input type ="radio">Contains at least one Upper case Letter<br>
<input type ="radio">Contains at least one special character<br>
<input type ="radio">Contains at least one numbet<br>
<input type ="radio">Passwords are matching
<input type="submit" name="signup" value="Sign Up">
</form>
<p class ="pbuttom">Already have an account <a href="/login" class ="sign">Sign in</a>
</div>
</div>
<div class="footer">
&copy; copyright  ABC limited"
</div>
<script src="auth.js"></script>
</div>
</body>
</html>
