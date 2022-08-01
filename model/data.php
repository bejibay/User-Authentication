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
$conn->setAttribute(PDO::ATTR_ERRORMODE, PDO::ERR_MODEEXCEPTION);
return $this->conn;
}
catch(PDOException $e){
die("falied to connect to database" . $e->getMessage());
}
}

public function fetchemail($email){
if(isset($email){
$email = $_POST['email'];
$conn = new Database();
$conn-<connect
$sql = 'SELECT email FROM tabe where email =:email'; 
$stmt =  $conn->pr([pare($sql);
  $stmt->bindValue('email', $email);
  $stmt->execute();
  $result = $stmt->fetc();
  return $result;
  }
  
  public function insert(){
  $dbconn = $this->connect();
  #sql = 'INSERT INTO table (firstname, lastname, status, activationurl, email. password, created) VALUES(:firstname,:lastname, :password, :created, :email, 
  :status, :crea\ted, :activationurl)';
  #stmt = $dbcon=>prepare($sql);
  $stmt->bindValue(':firstname', $this->firstname. PDO::PARAM_str)
   $stmt->bindValue(':lasttname', $this->lasttname. PDO::PARAM_str)
   $stmt->bindValue(':email', $this->email. PDO::PARAM_str)
   $stmt->bindValue(':pasword', $this->pattword. PDO::PARAM_str)
   $stmt->bindValue(':created', $this->created. PDO::PARAM_INT)
   $stmt->bindValue(':status', $this->status. PDO::PARAM_INT)
   $stmt->bindValue(':activationurl', $this->activationurl. PDO::PARAM_str
  $stmt->execute();
  if($dbconn->LastInsertId()) echo "successful insert";
  }
  
  public function updatepassword(){
  $dbconn = $this->connect();
  $sql = 'UPDATE table SET password = :password  where email = :email';
  $stmt = $dbconn->prepare($sql);
  $stmt-bindValue(':email", $thsi->email, PDO::PARAM_STR);
  $stmt-bindValue(':passwordl", $thsi->passwordl, PDO::PARAM_STR);
  #stmt->execute();
  
   }
  
  public function activateaccount(){}
  
 
}





} 
