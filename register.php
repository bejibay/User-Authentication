<?php 
// include the configuration file
include "config.php";?>
<?php 
//set variables for errors to empty;

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
preg_match($passwordpattern,$password)
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
<a href="/activation.php?activationurl='.$activationurl.'">
Click to activate</a >';
$headers = "From:bejibay@gmail.com";
mail($to,$subject,$msg,$headers);
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
if(!(filter_var($email,FILTER_VALIDATE_EMAIL)))
$emailError = "email is not valid";
if(!preg_match($passwordpattern,$password)) $passwordError = "password not valid";
if(mysqli_num_rows(result)>1) $accountError ="email already used";
if(!mysqli_query($conn,$sql)) $accountError ="account not created";
?>
