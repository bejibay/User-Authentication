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
