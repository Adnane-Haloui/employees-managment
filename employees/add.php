<?php
	require_once "./../config.php";
	require_once SESSIONS."setUp.php";
	require_once ROOT_URL."database/connect.php";
	$errors = '';
	$success = false;
	if(isset($_POST['submited'])) {
		if(!empty($_POST['cin']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['phone_number']) /*&& !empty($_FILES['avatar'])*/ && !empty($_POST['job']) && !empty($_POST['service']) && !empty($_POST['username']) && !empty($_POST['password'])) {

			$cin = $db->real_escape_string(trim(mb_strtoupper($_POST['cin'])));
			$first_name = $db->real_escape_string(trim($_POST['first_name']));
			$last_name = $db->real_escape_string(trim(mb_strtoupper($_POST['last_name'])));
			$email = $db->real_escape_string(trim($_POST['email']));
			$address = $db->real_escape_string(trim(mb_strtoupper($_POST['address'])));
			$phone_number = $db->real_escape_string(trim($_POST['phone_number']));
			// $avatar = $_FILES['avatar'];
			$job_id = $db->real_escape_string(trim($_POST['job']));
			$service_id = $db->real_escape_string(trim($_POST['service']));
			$username = $db->real_escape_string(trim($_POST['username']));
			$password = $db->real_escape_string(trim($_POST['password']));
			// hashing password
			$password = password_hash($password, PASSWORD_DEFAULT);
			$file_destination = 'avatars/5a2608f3727d8.png';

			// $file_extention = explode('.', $avatar['name']);
			// $file_extention = strtolower(end($file_extention));
			// $file_name = uniqid().'.'.$file_extention;
			// $file_destination = 'avatars/'.$file_name;
			// if(!move_uploaded_file($avatar['tmp_name'], ROOT_URL.$file_destination)) {
			// 	$errors = array('Error when uploading the avatar');
			// }
			$result = $db->query("
				SELECT id
				FROM users
				ORDER BY id DESC
				LIMIT 1;
			") or die($db->error);
			$employee_id = (int)$result->fetch_row()[0];
			$employee_id++;

			$db->query("
				INSERT INTO `employees`(`id`, `job_id`, `service_id`, `cin`, `first_name`, `last_name`, `email`, `address`, `phone_number`, `avatar`)
				VALUES ('{$employee_id}', '{$job_id}','{$service_id}','{$cin}','{$first_name}','{$last_name}','{$email}','{$address}','{$phone_number}','{$file_destination}');
			") or die($db->error);
			
			$db->query("
				INSERT INTO `users`(`employee_id`, `username`, `password`)
				VALUES ('{$employee_id}','{$username}','{$password}')
			") or die($db->error);

			$success = true;

		} else {
			$errors = array('All fields are required');
		}
	}











	require_once INC."topHTML.php";
	require_once INC."header.php";
	require_once INC."aside.php";

	$result = $db->query("
		SELECT id, title
		FROM jobs
	");
	if($result != false && $result->num_rows != 0) {
		$jobs = $result->fetch_all(MYSQLI_ASSOC);
	}
	$result = $db->query("
		SELECT s.id, s.name, d.id as department_id
		FROM services as s, departments as d
		WHERE s.department_id = d.id
	");
	if($result != false && $result->num_rows != 0) {
		$services = $result->fetch_all(MYSQLI_ASSOC);
	}
	$result = $db->query("
		SELECT id, name
		FROM departments
	");
	if($result != false && $result->num_rows != 0) {
		$departments = $result->fetch_all(MYSQLI_ASSOC);
	}


?>

<div class="content-wrapper">
	    <section class="content">
	      <div class="row">
	        <div class="col-md-12">
	        	<?php include INC.'errors.php'; ?>
	        	<?php if($success): ?>
		        	<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<p>Operation done succesfully!</p>
					</div>
				<?php endif; ?>
	        	<div class="box box-warning">
		            <div class="box-header with-border">
		              <h3 class="box-title">Add a new Employee</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		              <form role="form" method="POST" action="<?php echo APP_URL.'employees/add.php' ?>" enctype="multipart/form-data">
		                <!-- text input -->
		                <div class="form-group">
		                  <label>CIN</label>
		                  <input class="form-control" name="cin" type="text">
		                </div>
		                <div class="form-group">
		                  <label>First Name</label>
		                  <input class="form-control" name="first_name" type="text">
		                </div>
		                <div class="form-group">
		                  <label>Last Name</label>
		                  <input class="form-control" name="last_name" type="text">
		                </div>
		                <div class="form-group">
		                  <label>Email</label>
		                  <input class="form-control" name="email" type="email">
		                </div>
		                <div class="form-group">
		                  <label>Address</label>
		                  <input class="form-control" name="address" type="text">
		                </div>
		                <div class="form-group">
		                  <label>Phone Number</label>
		                  <input class="form-control" name="phone_number" type="tel">
		                </div>
<!-- 
		                <div class="form-group">
		                  <label>Avatar</label>
		                  <input class="form-control" name="avatar" type="file">
		                </div>
		                 -->
		                <div class="form-group">
		                  <label>Job</label>
		                  <select class="form-control" name="job">
		                  	<?php foreach($jobs as $job): ?>
		                    	<option value="<?php echo $job['id']; ?>"><?php echo $job['title']; ?></option>
		                	<?php endforeach; ?>
		                  </select>
		                </div>
		                <div class="form-group">
		                	<label for="service">Services</label>
			                <select class="selectpicker form-control" style="display: block !important;" multiple name="service">
		                  	<?php foreach($departments as $department): ?>
		                  		<optgroup label="<?php echo $department['name']; ?>" data-max-options="2">
		                  			<?php foreach($services as $service): ?>
		                  				<?php if($service['department_id'] == $department['id']): ?>
								    		<option value="<?php echo $service['id']; ?>"><?php echo $service['name']; ?></option>
		                  				<?php endif; ?>
		                			<?php endforeach; ?>
								  </optgroup>
		                	<?php endforeach; ?>
							</select>
		                </div>
		                <div class="form-group">
		                  <label>Username</label>
		                  <input class="form-control" name="username" type="text">
		                </div>
		                <div class="form-group">
		                  <label>Password</label>
		                  <input class="form-control" name="password" type="password">
		                </div>
						<button type="submit" name="submited" class="btn btn-primary">Ajouter</button>
		              </form>
		            </div>
		            <!-- /.box-body -->
		          </div>
			</div>
		</div>
	</section>
</div>
<?php include INC.'bottomHTML.php' ?>