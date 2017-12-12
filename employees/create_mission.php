<?php
	require_once "./../config.php";
	require CLASSES."DB.php";
	require CLASSES."Session.php";
	Session::setUp();
	require CLASSES."Employee.php";
	Employee::DMControllAccess();
	$errors = '';
	$success = false;

	if(isset($_POST['submited'])) {
		if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['service'])) {
			do {

				$DB = new DB();
				$title = trim($_POST['title']);
				$description = trim($_POST['description']);

				$data = $DB->fetch("
					SELECT id
					FROM services
					WHERE id = ?
				", [
					[
						'value' => $_POST['service'],
						'type' => PDO::PARAM_INT
					]
				]);
				unset($DB);
				if(empty($data)) {
					$errors = array('INVALID FORM DATA, plz make sure you enter correct information');
					break;
				}

				require CLASSES."Mission.php";
				$mission = new Mission();
				$args = [
					[
						'value' => $_SESSION['id'],
						'type' => PDO::PARAM_INT
					],
					[
						'value' => $_POST['service'],
						'type' => PDO::PARAM_INT
					],
					[ 'value' => $title ],
					[ 'value' => $description ]
				];
				$success = $mission->create($args);
				if(!$success) {
					$errors = array('sorry, SOMETHING WENT WRONG, plz try again later');
					break;
				}



			} while(false);
		} else {
			$errors = array('All fields are required');
		}
	}


	require_once INC."topHTML.php";
	require_once INC."header.php";
	require_once INC."aside.php";

	$DB = new DB();

	$department = $DB->fetch("
		SELECT id
		FROM departments
		WHERE manager_id = ?
	", [
		[
			'value' => $_SESSION['id'],
			'type' => PDO::PARAM_INT
		]
	]);

	$services = $DB->fetchAll("
		SELECT id, name
		FROM services
		WHERE department_id = ?
	", [
		[
			'value' => $department['id'],
			'type' => PDO::PARAM_INT
		]
	]);
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
		              <h3 class="box-title">Create a new Mission</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		              <form role="form" method="POST" action="<?php echo APP_URL.'employees/create_mission.php' ?>" autocomplete="off">
		                <!-- text input -->
		                <div class="form-group">
		                  <label>Title</label>
		                  <input class="form-control" name="title" type="text">
		                </div>
		                <div class="form-group">
		                	<label for="service">Services</label>
			                <select class="form-control" name="service">
			                	<?php foreach($services as $service): ?>
									<option value="<?php echo $service['id']; ?>"><?php echo $service['name']; ?></option>
			                	<?php endforeach; ?>
							</select>
		                </div>
		                <div class="form-group">
		                  <label>Description</label>
		                  <textarea class="form-control" name="description" rows="3" placeholder="Enter a description"></textarea>
		                </div>
						<button type="submit" name="submited" class="btn btn-primary">Create</button>
		              </form>
		            </div>
		            <!-- /.box-body -->
		          </div>
			</div>
		</div>
	</section>
</div>
<?php include INC.'bottomHTML.php' ?>