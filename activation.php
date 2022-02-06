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

