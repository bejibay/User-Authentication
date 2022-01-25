<?php 
// include the configuration file
include "confg.php";
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
?>

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
<p><?php echo $activationSuccess;?></p>
</div>
<div class="footer">
&copy; copyright  ABC limited
</div>
<script src="landingpage.js"></script>
</div>
</body>
</html>
