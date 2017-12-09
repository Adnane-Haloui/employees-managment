<?php
	require_once "./../config.php";
	require_once CLASSES.'DB.php';
	require_once CLASSES.'Session.php';
	
	if(isset($_POST['username']) && isset($_POST['pass'])) {
		if(!empty($_POST['username']) && !empty($_POST['pass'])) {
			$session = new Session();
			$isOK = $session->login($_POST['username'], $_POST['pass']);
			if(!$isOK)
				$errors = array('Your cridentials do not match our records');
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
