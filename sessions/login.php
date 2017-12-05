<?php
	require_once "./../config.php";
	require_once CLASSES.'Database.php';
	
	$db = new Database();
	session_start();
	if(isset($_POST['username']) && isset($_POST['pass'])) {
		if(!empty($_POST['username']) && !empty($_POST['pass'])) {
			
			$result = $db->login($_POST['username'],$_POST['pass']);
			if($result != false && $result->num_rows != 0) {
				$data = $result->fetch_array(MYSQLI_ASSOC);
				$service_type = $db->getServiceType($data['id']);
				$service_type = $service_type->fetch_array(MYSQLI_NUM)[0];
				$_SESSION['service_type'] = $service_type ? $service_type : 'null';
				foreach ($data as $key => $value) {
					echo $key;
					$_SESSION[$key] = $value;
				}
				header('Location: '.APP_URL.'dashboard.php');
			} else {
				$errors = array('Your cridentials do not match our records');
			}
		} else {
			$errors = array('All fields are required');
		}
	}	
?>
<?php include INC.'topHTML.php' ?>
	<div class="container" style="background:white;width:100vw;height:100vh;">
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
