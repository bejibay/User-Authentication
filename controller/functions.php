all functions
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
$sql = "SELECT* FROM user where email = :email";
$conn->prepare($sql);
$stmt->bindValue(": email", $email,PDO::PARAM_STR);
$stmt->execute();
if($rowone = $stmt->fetch()){
$sql ="SELECT* FROM user where password =:password AND
status = 1";
if(!$rowone) $accountError =" invalid entries or account not exist";
$conn->prepare($sql);
$stmt->bindValue(":password",$password);
$stmt->execute();
if($rowtwo = $stmt->fetch(PDO::FETCH_ASSOC)){
$email = $rowtwo['id'];
$firstname = $rowtwo['firstname'];
$lastname = $rowtwo['lastname'];
$_SESSION['email'] = $email;
$_SESSION['firstname'] =$firstname;
$_SESSION['lastname'] = $lastname;
header("Location:/dashboard");
}
if(!$rowtwo) $passwordError ="Password is incorrect";
}
}
include "/template/login.html";

<?php     
    session_start();
    session_destroy();
      
    header("Location:/index.php")
;?>

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
    
    <?php 
// include the configuration file
include "confg.php";
global $activationError, $activationSuccess;
if(isset($_GET['activationurl'])){
$sql = " SELECT* FROM user where activationurl =:activationurl";
$conn->prepare($sql);
$stmt->bindValue(":activationurl",$_GET['activationurl'],PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch();
if(!$row) $activationError = "Activation URL not found";
if($row){ 
$sql = "UPDATE user SET status =:status where activationurl=:activationurl";
$conn->prepare($sql);
$stmt->bindValue(":activationurl",$_GET['activationurl'],PDO::PARAM_STR);
$stmt->bindValue(":status",1,PDO::PARAM_INT);
$stmt->execute();
$activationSuccess ="Your account is now activated<br>"."Login at "."<a href ='/login.php'>Login</a>";
}
}
include "activation.html";
?>
<?php
// easy use of headers
ob_start();
define("DB_DSN", "mysql:host=localhost;dbname=user");
define("DB_USERNAME", "soowecca");
define("DB_PASSWORD", "password");
try{
$conn= new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
echo "successful connection";
}
catch(PDOException $pe){
echo "something went wrong ".$pe->getMessage():
}
?>
