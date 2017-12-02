<?php

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($db->connect_errno)
	header('Location: '.ROOT_URL.'error.php');

$db->set_charset('utf8');