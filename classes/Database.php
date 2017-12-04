<?php 

	class Database
	{	
		
		public $con;

		function __construct()
		{
			$this->connect();
		}
		function connect()
		{
			$this->con= new mysqli(DB_HOST,DB_USER, DB_PASS,DB_NAME);
			if(!$this->con){
				header("Location: ".APP_URL."error.php?error_msg=".$this->con->connect_error);
			}
		}
		function login ($username, $pass)
		{
			$username = $this->con->real_escape_string(trim(mb_strtolower($username)));
			$pass = $this->con->real_escape_string(trim($pass));
			$query = "
				SELECT e.id, first_name, last_name, e.avatar, j.title as job_title, j.type as job_type, e.created_at
				FROM users as u, employees as e, jobs as j
				WHERE u.username = '{$username}' && u.password = '{$pass}' and u.employee_id = e.id and e.job_id = j.id;
			";
			$rslt = $this->con->query($query);
			if(!empty($rslt))
			   return $rslt;
			else
				return false;
		}

		function getServiceType($id) {
			$query = "
				SELECT s.type as service_type
				FROM employees as e, services as s
				WHERE e.id = '{$id}' and e.service_id = s.id;
			";
			$rslt = $this->con->query($query);
			if(!empty($rslt))
				return $rslt;
			else
				return false;
		}
	}
?>


