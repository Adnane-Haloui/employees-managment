<?php

$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($db->connect_errno)
	header('Location: '.APP_URL.'error.php?error_msg='.$db->connect_error);

$db->set_charset('utf8');