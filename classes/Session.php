<?php 
	require_once ROOT_URL.'vendor/Carbon.php';
	use Carbon\Carbon;

	class Session extends DB
	{
		private $date_format = 'jS \\of F Y';
		public function getServiceInfo($id) {
			$query = "
				SELECT s.type as service_type, s.id as service_id
				FROM employees as e, services as s
				WHERE e.id = ? and e.service_id = s.id;
			";
			$data = $this->fetch($query, [
				[
			      'value' => $id,
			      'type' => PDO::PARAM_INT
			    ]
			]);
			return $data;
		}
		
		protected function getHashedPassword($username) {
			$query = "
				SELECT password
				FROM users
				WHERE username = ?;
			";
			$data = $this->fetch($query, [
				[
			      'value' => $username,
			      'type' => PDO::PARAM_STR
			    ]
			]);
			return $data;
		}

		public function login($username, $pass)
		{
			$username = trim($username);
			$pass = trim($pass);
			$hashed_pass = $this->getHashedPassword($username);
			if(!$hashed_pass) return false;
			if(!password_verify($pass, $hashed_pass['password'])) {
				return false;
			}
			$query = "
				SELECT e.id, first_name, last_name, e.avatar, j.title as job_title, j.type as job_type, e.created_at
				FROM users as u, employees as e, jobs as j
				WHERE u.username = ? and u.employee_id = e.id and e.job_id = j.id;
			";
			$data = $this->fetch($query, [
				[
			      'value' => $username,
			      'type' => PDO::PARAM_STR
			    ]
			]);
			if(!$data) return false;

			$date = new Carbon($data['created_at']);
  			$data['created_at'] = $date->format($this->date_format);

			$service_info = $this->getServiceInfo($data['id']);
			if($service_info) {
				$data['service_id'] = $service_info['service_id'] ? $service_info['service_id'] : null;
				$data['service_type'] = $service_info['service_type'] ? $service_info['service_type'] : null;
			}

			session_start();
			foreach($data as $key => $value) {
				$_SESSION[$key] = $value;
			}
			header('Location: '.APP_URL.'dashboard.php');
		}

		public static function setUp() {
			session_start();
			if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
				header('Location: '.APP_URL.'sessions/login.php');
			}
		}
		public static function logout() {
			session_start();
			session_destroy();
			header('Location: '.APP_URL.'sessions/login.php');
		}
	}
?>


