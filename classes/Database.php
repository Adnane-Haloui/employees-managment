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

		function getHashedPassword($username) {
			$query = "
				SELECT password
				FROM users
				WHERE username = '{$username}';
			";
			$rslt = $this->con->query($query);
			$rslt = $rslt->fetch_row()[0];
			return $rslt;
		}

		function login ($username, $pass)
		{
			$username = $this->con->real_escape_string(trim(mb_strtolower($username)));
			$pass = $this->con->real_escape_string(trim($pass));
			$hashed_pass = $this->getHashedPassword($username);

			if(!password_verify($pass, $hashed_pass)) {
				return false;
			}
			$query = "
				SELECT e.id, first_name, last_name, e.avatar, j.title as job_title, j.type as job_type, e.created_at
				FROM users as u, employees as e, jobs as j
				WHERE u.username = '{$username}' and u.employee_id = e.id and e.job_id = j.id;
			";
			$rslt = $this->con->query($query) or die($this->con->error);

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


