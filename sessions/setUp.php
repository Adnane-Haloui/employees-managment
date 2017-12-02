<?php

session_start();

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
	header('Location: '.APP_URL.'sessions/login.php');
}
