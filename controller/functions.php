// All functions
<?php

 function signin(){
if(isset($_POST['signin'])){

$email = filter_var($email, FILTER_VALIDATE_EMAIL);
$email = filter_var($email, FILTER_SANITISE_EMAIL);
$password = isset($_POST['password']);

$password = hash_password($password,PASSWORD_BCRYPT);
$_SESSION['email'] = $email;
$_SESSION['firstname'] =$firstname;
$_SESSION['lastname'] = $lastname;
header("Location:/dashboard");
}
if(!$rowtwo) $passwordError ="Password is incorrect";
}
}
include "/template/login.phpl";

function logout(){
    
    session_start();
    session_destroy();
      
    header("Location:/index.php")
    }  


function signup(){

if(isset($_POST['signup'])){

//set password pattern
$passwordpattern ="/^(?=.*[A-Z])(?=.*[0-9])(?=.*[@#\-_$%^&+=§!\?])
[0-9A-Za-z@#\-_$%^&+=§!\?]{8}$/";


if(!preg_match($passwordpattern,$password)) $passwordError = "password not valid";
                    
if(preg_match("/^[A-Za-z]*$/",$firstname)&&
preg_match("/^[A-Za-z]*$/",$lastname)&&
preg_match($passwordpattern,$password)

   function activateurl(){
//generate activation URL
$activationurl =md5(rand(0,999).time());
   }
//send activation email
   
   function sendemail(){

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
include "/template/register.php";

   }
  
   function urlactivation()
global $activationError, $activationSuccess;
if(isset($_GET['activationurl'])){

$activationSuccess ="Your account is now activated<br>"."Login at "."<a href ='/login.php'>Login</a>";
}
}
include "activation.php";
   }

?>
