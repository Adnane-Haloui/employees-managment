<?php
	require_once "./../config.php";
	require CLASSES."DB.php";
	require CLASSES."Session.php";
	Session::setUp();
	require CLASSES."Employee.php";
	Employee::RHControllAccess();
	$errors = '';
	$success = false;

	if(isset($_POST['submited'])) {
		if(!empty($_POST['cin']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['phone_number']) && !empty($_POST['job']) && !empty($_POST['service']) && !empty($_POST['username']) && !empty($_POST['password'])) {

			do {

				$DB = new DB();

				$cin = trim(mb_strtoupper($_POST['cin']));
				$email = trim($_POST['email']);
				$phone_number = trim($_POST['phone_number']);

				$data = $DB->fetch("
					SELECT id
					FROM employees
					WHERE cin = ? or email = ? or phone_number = ?
				", [
					[
						'value' => $cin,
						'type' => PDO::PARAM_STR
					],
					[
						'value' => $email,
						'type' => PDO::PARAM_STR
					],
					[
						'value' => $phone_number,
						'type' => PDO::PARAM_STR
					],
				]);
				if(!empty($data)) {
					$errors = array('CIN or EMAIL or PHONE NUMBER is already taken');
					break;
				}

				$username = trim($_POST['username']);

				$data = $DB->fetch("
					SELECT id
					FROM users
					WHERE username = ?
				", [
					[
						'value' => $username,
						'type' => PDO::PARAM_STR
					]
				]);
				if(!empty($data)) {
					$errors = array('USERNAME is already taken');
					break;
				}
				


				$employee_id = (int)$data['id'];


				$data = $DB->fetch("
					SELECT id
					FROM employees
					ORDER BY id DESC
					LIMIT 1;
				", []);
				$employee_id = (int)$data['id'];
				$employee_id++;
				unset($DB);


				$job_id = trim($_POST['job']);
				$service_id = trim($_POST['service']);
				$first_name = trim($_POST['first_name']);
				$last_name = trim(mb_strtoupper($_POST['last_name']));
				$address = trim(mb_strtoupper($_POST['address']));
				$password = trim($_POST['password']);
				// hashing password
				$password = password_hash($password, PASSWORD_DEFAULT);
				
				// uploading the avatar
				$avatar = $_FILES['avatar'];
				if($avatar) {
					$file_extention = explode('.', $avatar['name']);
					$file_extention = strtolower(end($file_extention));
					// Extention test
					$extention_valide = array('jpg', 'gif', 'png', 'ico', 'svg');
					if(!in_array($file_extention, $extention_valide)) {
						$errors = array('INVALID EXTENTION, supported extentions are: JPG, GIF, PNG, ICO, SVG');
						break;
					}
					// Retrieving the avatar test
					if($avatar['error'] != 0) {
						$errors = array('Sorry, we had a problem when retrieving the AVATAR, try again later');
						break;
					}
					// Size test (2mb)
					if($avatar['size'] > 2097152) {
						$errors = array('Sorry, the size of the avatar should not be more than 2mb');
						break;
					}
					$file_name = uniqid().'.'.$file_extention;
					$file_destination = 'avatars/'.$file_name;
					if(move_uploaded_file($avatar['tmp_name'], ROOT_URL.$file_destination)) {
						$avatar = $file_destination;
					} else {
						$avatar = 'avatar/default.png';
					}
				} else {
					$avatar = 'avatar/default.png';
				}



				$employee = new Employee();
				$employeeArgs = [
					[ 'value' => $employee_id ],
					[
						'value' => $job_id,
						'type' => PDO::PARAM_INT
					],
					[
						'value' => $service_id,
						'type' => PDO::PARAM_INT
					],
					[ 'value' => $cin ],
					[ 'value' => $first_name ],
					[ 'value' => $last_name ],
					[ 'value' => $email ],
					[ 'value' => $address ],
					[ 'value' => $phone_number ],
					[ 'value' => $avatar ],
				];
				$userArgs = [
					[ 'value' => $employee_id ],
					[ 'value' => $username ],
					[ 'value' => $password ]
				];
				$success = $employee->store($employeeArgs, $userArgs);
				if(!$success)
					$errors = array('Something went wrong, plz try again later');

			} while(false);

		} else {
			$errors = array('All fields are required');
		}
	}











	require_once INC."topHTML.php";
	require_once INC."header.php";
	require_once INC."aside.php";

	$DB = new DB();

	$jobs = $DB->fetchAll("
		SELECT id, type, title
		FROM jobs
	", []);

	$services = $DB->fetchAll("
		SELECT id, type, name, department_id
		FROM services
	", []);

	$departments = $DB->fetchAll("
		SELECT id, name
		FROM departments
	", []);

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

		                <div class="form-group">
		                  <label>Avatar</label>
		                  <input class="form-control" name="avatar" type="file">
		                </div>
		                
		                <div class="form-group">
		                  <label>Job</label>
		                  <select class=" selectpicker form-control" name="job">
							<optgroup label="Emloyees">
	                  			<?php foreach($jobs as $job): ?>
	                  				<?php if($job['type'] == "1"): ?>
							    		<option value="<?php echo $job['id']; ?>"><?php echo $job['title']; ?></option>
	                  				<?php endif; ?>
	                			<?php endforeach; ?>
							</optgroup>
							<optgroup label="Managers">
	                  			<?php foreach($jobs as $job): ?>
	                  				<?php if($job['type'] != "1"): ?>
							    		<option value="<?php echo $job['id']; ?>"><?php echo $job['title']; ?></option>
	                  				<?php endif; ?>
	                			<?php endforeach; ?>
							</optgroup>
		                  </select>
		                </div>
		                <div class="form-group">
		                	<label for="service">Services</label>
			                <select class="selectpicker form-control" style="display: block !important;" name="service">
		                  	<?php foreach($departments as $department): ?>
		                  		<optgroup label="<?php echo $department['name']; ?>">
		                  			<?php foreach($services as $service): ?>
		                  				<?php if($service['department_id'] == $department['id']): ?>
								    		<option value="<?php echo $service['id']; ?>"><?php echo $service['name']; ?></option>
		                  				<?php endif; ?>
		                			<?php endforeach; ?>
								</optgroup>
		                	<?php endforeach; ?>
		                	<optgroup label="RH">
			                	<?php foreach($services as $service): ?>
						    		<?php if(!$service['department_id']): ?>
							    		<option value="<?php echo $service['id']; ?>"><?php echo $service['name']; ?></option>
						    		<?php endif; ?>
						    	<?php endforeach; ?>
					    	</optgroup>
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