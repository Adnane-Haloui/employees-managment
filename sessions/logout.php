<?php
	require_once './../config.php';
	require CLASSES.'DB.php';
	require CLASSES.'Session.php';

	if(isset($_POST['logout']))
		Session::logout();