<?php
	require_once dirname(__DIR__).'/config.php';
	require_once ROOT_URL."database/connect.php";
	session_start();

	$errors = null;
	if(isset($_POST['username']) && isset($_POST['pass'])) {
		if(!empty($_POST['username']) && !empty($_POST['pass'])) {
			$username = $db->real_escape_string(trim(mb_strtolower($_POST['username'])));
			$pass = $db->real_escape_string(trim($_POST['pass']));
			$result = $db->query("
				SELECT e.id, first_name, last_name, job, e.created_at
				FROM users as u, employees as e 
				WHERE u.username = '{$username}' && u.password = '{$pass}' and u.id_employee = e.id;
			");
			if($result->num_rows != 0) {
				$data = $result->fetch_array(MYSQLI_ASSOC);
				foreach ($data as $key => $value) {
					$_SESSION[$key] = $value;
				}
				header('Location: '.APP_URL.'dashboard.php');
			} else {
				$errors = array('Your cridentials do not match our records');
			}
			$result->free();
			$db->close();
		} else {
			$errors = array('All fields are required');
		}
	}
?>
<?php include INC.'topHTML.php' ?>
	<div class="container">
		<?php include INC.'errors.php'; ?>
		<form action="./login.php" method="POST">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" id="username" name="username" placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="pass" placeholder="Enter password">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
<?php include INC.'bottomHTML.php' ?>
