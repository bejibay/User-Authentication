<?php 
// include the configuration file
include "config.php";?>
<?php 
//variables for errors

global $fnameError,$lnameError,$emailError,
$passwordError, $accountError,$accountSuccess;

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
include "/template/register.html";
?
>
