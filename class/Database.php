<?php 
	/**
	* 
	*/
	 	require_once './../config.php';

	 class Database
	{	
		
		public $con;
		public $error;
		
		function __construct()
		{
			$this->connect();
		}
		function connect(){
			$this->con= new mysqli(DB_HOST,DB_USER, DB_PASS,DB_NAME);
			if(!$this->con){
				$this->error= "Fatal Error cant connect".$this->con->connect_error;
				return false;
			}

		}
		function insert(){
				$stmt = $this->conn->prepare("INSERT INTO `user` (username, password, firstname, lastname) VALUES(?, ?, ?, ?)") or die($this->conn->error);
			$stmt->bind_param("ssss", $username, $password, $firstname, $lastname);
			if($stmt->execute()){
				$stmt->close();
				$this->conn->close();
				return true;
			}
		}
		function login($user,$pass){

				$query = "SELECT e.id, first_name, last_name, j.title as job_title, j.type as job_type, e.created_at FROM users as u, employees as e, jobs as j WHERE u.username = '{$user}' && u.password = '{$pass}' and u.employee_id = e.id and e.job_id = j.id;";
				$rslt = $this->con->query($query);
				if(!empty($rslt))
				   return $rslt;
				else
				 return false;
		}
	}
?>


