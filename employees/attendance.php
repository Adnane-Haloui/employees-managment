<?php

	require_once "./../config.php";
	require CLASSES."DB.php";
	require CLASSES."Session.php";
	Session::setUp();

	if(isset($_POST['submitted'])) {
		require CLASSES."Employee.php";
		$employee = new Employee($_SESSION['id']);
		$isOK = $employee->isPresent();
		if($isOK)
			$_SESSION['isPresent'] = true;
		header('Location: '.APP_URL.'dashboard.php');
	}
