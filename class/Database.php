<?php 
	/**
	* 
	*/
	require './../config.php';

	public class Database
	{	
		private $db_host=DB_HOST;
		private $db_user=DB_USER;
		private $pass=DB_PASS;
		private $dbname=DB_NAME;
		private $con;
		private $error;
		
		public function __construct()
		{
			$this->connect();
		}
		public function connect(){
			$this->con=mysqli($this->db_host,$this->user,$this->dbname,$this->pass);
			if(!$this->con){
				$this->error= "Fatal Error cant connect".$this->con->connect_error;
				return false;
			}
		}
		public function insert(){
				$stmt = $this->conn->prepare("INSERT INTO `user` (username, password, firstname, lastname) VALUES(?, ?, ?, ?)") or die($this->conn->error);
			$stmt->bind_param("ssss", $username, $password, $firstname, $lastname);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
		public function login($user,$pass){
				$query = "SELECT * FROM user WHERE user=".$user." && pass=".$pass";"
				$rslt = mysqli_query($this->con,$this->query);
				if($rslt.isEmpty())
				return false;
				else
				 return $rslt;
		}
	}
?>


