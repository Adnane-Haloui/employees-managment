<?php

	use Carbon\Carbon;
	
	class Mission extends DB
	{
		private $date_format = 'jS \\of F Y';

		public function create($args)
		{
			$query = "
				INSERT INTO `missions`(`manager_id`, `service_id`, `title`, `description`)
				VALUES (?, 	?,	?,	?);
			";
			if(!$this->execute($query, $args)) return false;
			return true;
		}

		public function getNonAffectedMissions()
		{
			$query = "
				SELECT id, employee_id, title, description, created_at 
				FROM missions
				WHERE service_id = ? and employee_id IS NULL;
			";
			$data = $this->fetchAll($query, [
				[
			      'value' => $_SESSION['service_id'],
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

		public function getOwnMissions()
		{
			$query = "
				SELECT id, title, description, created_at 
				FROM missions
				WHERE employee_id = ?;
			";
			$data = $this->fetchAll($query, [
				[
			      'value' => $_SESSION['id'],
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


	}