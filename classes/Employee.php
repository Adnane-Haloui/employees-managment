<?php

	require_once ROOT_URL.'vendor/Carbon.php';
	use Carbon\Carbon;

	class Employee extends DB {
		private $id;
		private $date_format = 'jS \\of F Y';

		public function __construct($id = null) {
			parent::__construct();
			$this->id = $id;
		}

		public function getAttendancesList() {
			if(isset($_SESSION['service_id']) && !empty($_SESSION['service_id'])) {
				$query = "
					SELECT cin, a.created_at
					FROM employees as e, attendances as a
					WHERE e.service_id = ? and a.employee_id = e.id;
				";
				$data = $this->fetchAll($query, [
					[
				      'value' => $_SESSION['service_id'],
				      'type' => PDO::PARAM_INT
				    ]
				]);
			} else {
				$query = "
					SELECT cin, a.created_at
					FROM employees as e, attendances as a
					WHERE a.employee_id = e.id;
				";
				$data = $this->fetch($query, []);
			}
			if(!$data) return false;
			foreach ($data as $key => $value) {
				$date = new Carbon($value['created_at']);
				$data[$key]['created_at'] = $date->format($this->date_format);
			}
			return $data;
		}


		public function isPresent() {
			$query = "
				INSERT INTO `attendances`(`employee_id`)
				VALUES (?);
			";
			$args = [
				[
					'value' => $this->id,
					'type' => PDO::PARAM_INT
				]
			];
			if(!$this->execute($query, $args)) return false;
			return true;
		}

		public function store(array $employeeArgs, array $userArgs) {
			$query = "
				INSERT INTO `employees`(`id`, `job_id`, `service_id`, `cin`, `first_name`, `last_name`, `email`, `address`, `phone_number`, `avatar`)
				VALUES (?, 	?,	?,	?,	?,	?,	?,	?,	?,	?);
			";
			if(!$this->execute($query, $employeeArgs)) return false;

			$query = "
				INSERT INTO `users`(`employee_id`, `username`, `password`)
				VALUES (?, ?, ?);
			";
			if(!$this->execute($query, $userArgs)) return false;

			return true;
		}

		public function storeUser($query, array $args) {
			$query = "
				INSERT INTO `users`(`employee_id`, `username`, `password`)
				VALUES (?, ?, ?);
			";
			return $this->execute($query, $args);
		}
		
		public static function RHControllAccess() {
			if(!isset($_SESSION['service_type']) || $_SESSION['service_type'] != 'rh')
				header('Location: '.APP_URL);
		}


		public static function DMControllAccess() {
			if($_SESSION['job_type'] != 3)
				header('Location: '.APP_URL);
		}


		public static function serviceControlAccess() {
			if($_SESSION['job_type'] != 2)
				header('Location: '.APP_URL);
		}
		
		public static function managerControlAccess() {
			if($_SESSION['job_type'] != 3 and $_SESSION['job_type'] != 2)
				header('Location: '.APP_URL);
		}

		public function getDescandentEmployees() {
			if(isset($_SESSION['service_id'])) {
				$query = "
					SELECT e.id, cin, first_name, last_name, email, avatar, phone_number, address, s.name as service_name, j.title as job_title, e.created_at
					FROM employees as e, jobs as j, services as s
					WHERE e.service_id = s.id and e.job_id = j.id and e.service_id = ?;
				";
				$data = $this->fetchAll($query, [
					[
				      'value' => $_SESSION['service_id'],
				      'type' => PDO::PARAM_INT
				    ]
				]);
			} else {
				$query = "
					SELECT cin, e.id, first_name, last_name, email, avatar, phone_number, address, s.name as service_name, j.title as job_title, e.created_at
					FROM employees as e, jobs as j, services as s
					WHERE e.service_id = s.id and e.job_id = j.id;
				";
				$data = $this->fetchAll($query, []);
			}
			if(!$data) return false;
			foreach ($data as $key => $value) {
				$date = new Carbon($data[$key]['created_at']);
				$data[$key]['created_at'] = $date->format($this->date_format);
			}
			return $data;
		}

		public function getUserInfo() {
			$query = "
				SELECT username, created_at
				FROM users
				WHERE employee_id = ?;
			";
			$data = $this->fetch($query, [
				[
			      'value' => $this->id,
			      'type' => PDO::PARAM_INT
			    ]
			]);
			if(!$data) return false;
			$date = new Carbon($data['created_at']);
			$data['created_at'] = $date->format($this->date_format);
			return $data;
		}
		public function getEmloyeeInfo($id = false) {
			$query = "
				SELECT cin, first_name, last_name, email, address, phone_number, created_at
				FROM employees
				WHERE id = ?;
			";
			$data = $this->fetch($query, [
				[
			      'value' => $id ? $id : $this->id,
			      'type' => PDO::PARAM_INT
			    ]
			]);
			if(!$data) return false;
			$date = new Carbon($data['created_at']);
			$data['created_at'] = $date->format($this->date_format);
			return $data;
		}

		public function getManagerInfo($id) {
			$query = "
				SELECT first_name, last_name, email
				FROM employees
				WHERE id = ?;
			";
			$data = $this->fetch($query, [
				[
			      'value' => $id,
			      'type' => PDO::PARAM_INT
			    ]
			]);
			return $data;
		}


		public function getServiceInfo() {
			$query = "
				SELECT s.id, s.name, s.description, s.manager_id, s.department_id
				FROM employees as e, services as s
				WHERE e.id = ? and e.service_id = s.id;
			";
			$data = $this->fetch($query, [
				[
			      'value' => $this->id,
			      'type' => PDO::PARAM_INT
			    ]
			]);
			return $data;
		}

		public function getDepartmentInfo($department_id) {
			$query = "
				SELECT d.id, d.name, description, location, e.first_name as manager_first_name, e.last_name as manager_last_name,  e.email as manager_email
				FROM departments as d, employees as e
				WHERE d.id = ? and d.manager_id = e.id;
			";
			$data = $this->fetch($query, [
				[
			      'value' => $department_id,
			      'type' => PDO::PARAM_INT
			    ]
			]);
			return $data;
		}

		public function getManagerDepartmentInfo() {
			$query = "
				SELECT id, name, description, location
				FROM departments
				WHERE manager_id = ?;
			";
			$data = $this->fetch($query, [
				[
			      'value' => $this->id,
			      'type' => PDO::PARAM_INT
			    ]
			]);
			return $data;
		}

		public function getDegreesInfo($id = false) {
			$query = "
				SELECT title, description, created_at
				FROM degrees
				WHERE employee_id = ?;
			";
			$data = $this->fetchAll($query, [
				[
			      'value' => $id ? $id : $this->id,
			      'type' => PDO::PARAM_INT
			    ]
			]);
			if(!$data) return false;
			foreach ($data as $key => $value) {
				$date = new Carbon($data[$key]['created_at']);
				$data[$key]['created_at'] = $date->format($this->date_format);
			}
			return $data;
		}

		public function getCareerInfo($id = false) {
			$query = "
				SELECT title, description, created_at
				FROM careers
				WHERE employee_id = ?;
			";
			$data = $this->fetchAll($query, [
				[
			      'value' => $id ? $id : $this->id,
			      'type' => PDO::PARAM_INT
			    ]
			]);
			if(!$data) return false;
			foreach ($data as $key => $value) {
				$date = new Carbon($data[$key]['created_at']);
				$data[$key]['created_at'] = $date->format($this->date_format);
			}
			return $data;
		}

		public function getTrainingsInfo($id = false) {
			$query = "
				SELECT title, description, started_at, ended_at
				FROM trainings
				WHERE employee_id = ?;
			";
			$data = $this->fetchAll($query, [
				[
			      'value' => $id ? $id : $this->id,
			      'type' => PDO::PARAM_INT
			    ]
			]);
			if(!$data) return false;
			foreach ($data as $key => $value) {
				$date = new Carbon($data[$key]['started_at']);
				$data[$key]['started_at'] = $date->format($this->date_format);
				$date = new Carbon($data[$key]['ended_at']);
				$data[$key]['ended_at'] = $date->format($this->date_format);
			}
			return $data;
		}


	}