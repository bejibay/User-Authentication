<>php
include config.php;
Class User{
protected $conn = null;
public $firstname = '';
public $lastname = '';
public $email = '';
public $ password = '';
public $created = null;
public $activationurl = ''
public $status = null;

public function __construct($data = array()){

)

public function connect(){
try{$this->conn = new PDO(DSN, USERNAME, PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $this->conn;
}
catch(PDOException $e){
die("falied to connect to database" . $e->getMessage());
}
}

public function fetchemail($email){
if(isset($email){
$conn = new Database();
$conn-<connect();
$sql = 'SELECT email FROM user where email =:email'; 
$stmt =  $conn->prepare($sql);
  $stmt->bindValue('email', $email);
  $stmt->execute();
  $result = $stmt->fetc();
  return $result;
  }
  
  public function insert(){
  $dbcon = $this->connect();
  #sql = 'INSERT INTO user (firstname, lastname, status, activationurl, email, password, created) VALUES(:firstname,:lastname, :password, :created, :email,
  :status, :created, :activationurl)';
  #stmt = $dbcon->prepare($sql);
  $stmt->bindValue(':firstname', $this->firstname. PDO::PARAM_STR)
   $stmt->bindValue(':lasttname', $this->lasttname. PDO::PARAM_STR)
   $stmt->bindValue(':email', $this->email. PDO::PARAM_STR)
   $stmt->bindValue(':pasword', $this->pattword. PDO::PARAM_STR)
   $stmt->bindValue(':created', $this->created. PDO::PARAM_INT)
   $stmt->bindValue(':status', $this->status. PDO::PARAM_INT)
   $stmt->bindValue(':activationurl', $this->activationurl. PDO::PARAM_STR);
  $stmt->execute();
  if($dbcon->LastInsertId()) echo "successful insert";
  }
  
  public function updatepassword(){
  $dbcon = $this->connect();
  $sql = 'UPDATE table SET password = :password  WHERE email = :email';
  $stmt = $dbcon->prepare($sql);
  $stmt-bindValue(':email", $thsi->email, PDO::PARAM_STR);
  $stmt-bindValue(':passwordl", $thsi->passwordl, PDO::PARAM_STR);
  $stmt->execute();
  
   }
  
  public function activateaccount($url){
  if(isset($url){
  $dbcon = $this->connect();
  $status - 1;
  $sql =  'UPDATE table SET status  =:status WHERE actionurl = :actionurl';
  $stmt = $dbcon->prepare($sql);
  $stmt-bindValue(':status", $status, PDO::PARAM_INT);
  $stmt-bindValue(':actionurl", $actionurl, PDO::PARAM_STR);
  
  }
  }
  
 
}





} 
