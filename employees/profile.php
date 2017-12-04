<?php
	require_once "./../config.php";
	require_once ROOT_URL."database/connect.php";
	require_once SESSIONS."setUp.php";
	require_once INC."topHTML.php";
	require_once INC."header.php";
	require_once INC."aside.php";
	use Carbon\Carbon;
	$date_format = 'l jS \\of F Y';
	$employee_id = $db->real_escape_string($_SESSION['id']);

	// User INFO
	$result = $db->query("
		SELECT username, created_at
		FROM users
		WHERE employee_id = '{$employee_id}';
	") or die($db->error);
	$user = $result->fetch_array(MYSQLI_ASSOC);
	$date = new Carbon($user['created_at']);
	$date = $date->format($date_format);
	$user['created_at'] = $date;

	// Employee INFO
	$result = $db->query("
		SELECT cin, first_name, last_name, email, address, phone_number, created_at
		FROM employees
		WHERE id = '{$employee_id}';
	") or die($db->error);
	$employee = $result->fetch_array(MYSQLI_ASSOC);
	$date = new Carbon($employee['created_at']);
	$date = $date->format($date_format);
	$employee['created_at'] = $date;

	// Service INFO
	$result = $db->query("
		SELECT s.id, s.name, s.description, s.manager_id, s.department_id
		FROM employees as e, services as s
		WHERE e.id = '{$employee_id}' and e.service_id = s.id;
	") or die($db->error);
	$service = $result->fetch_array(MYSQLI_ASSOC);
	if(!empty($service)) { // here because some employees don't belong to a specific service
		$result = $db->query("
			SELECT first_name, last_name, email
			FROM employees
			WHERE id = '{$service['manager_id']}';
		") or die($db->error);
		$service['manager'] = $result->fetch_array(MYSQLI_ASSOC);
		// Department INFO
		$result = $db->query("
			SELECT id, name, description, location, manager_id
			FROM departments
			WHERE id = '{$service['department_id']}';
		") or die($db->error);
		$department = $result->fetch_array(MYSQLI_ASSOC);
		if(!empty($department)) {
			$result = $db->query("
				SELECT first_name, last_name, email
				FROM employees
				WHERE id = '{$department['manager_id']}';
			") or die($db->error);
			$department['manager'] = $result->fetch_array(MYSQLI_ASSOC);
		}
		
	}

	


	// Career INFO
	$result = $db->query("
		SELECT title, description, created_at
		FROM careers
		WHERE employee_id = '{$employee_id}';
	") or die($db->error);
	$careers = $result->fetch_array(MYSQLI_ASSOC);
	if(!empty($careers)) {
		foreach($careers as $career) {
			$date = new Carbon($career['created_at']);
			$date = $date->format($date_format);
			$career['created_at'] = $date;
		}
	}

	// Degrees INFO
	$result = $db->query("
		SELECT title, description, created_at
		FROM degrees
		WHERE employee_id = '{$employee_id}';
	") or die($db->error);
	$degrees = $result->fetch_array(MYSQLI_ASSOC);
	if(!empty($degrees)) {
		foreach($degrees as $degree) {
			$date = new Carbon($degree['created_at']);
			$date = $date->format($date_format);
			$degree['created_at'] = $date;
		}
	}

	// Trainnings INFO
	$result = $db->query("
		SELECT title, description, started_at, ended_at
		FROM trainings
		WHERE employee_id = '{$employee_id}';
	") or die($db->error);
	$trainings = $result->fetch_array(MYSQLI_ASSOC);
	if(!empty($trainings)) {
		foreach($trainings as $training) {
			$date = new Carbon($training['started_at']);
			$date = $date->format($date_format);
			$training['started_at'] = $date;
			$date = new Carbon($training['ended_at']);
			$date = $date->format($date_format);
			$training['ended_at'] = $date;
		}
	}

?>
	<div class="content-wrapper">
	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
	        <div class="col-md-12"> 
				<div class="box box-solid">
					<div class="box-header with-border">
					  <!-- <h3 class="box-title">Collapsible Accordion</h3> -->
				  		<img src="<?php echo APP_URL.$_SESSION['avatar']; ?>" class="img-circle center-block" alt="User Image">
					</div>
					<!-- /.box-header -->
					<div class="box-body">
					  <div class="box-group" id="accordion">
					    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
					    <div class="panel box box-solid">
					      <div class="box-header with-border">
					        <h4 class="box-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
					            User Acount Info
					          </a>
					        </h4>
					      </div>
					      <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
					        <div class="box-body">
					        	<dl class="dl-horizontal">
									<dt>username</dt>
									<dd><?php echo $user['username']; ?></dd>
									<dt>created_at</dt>
									<dd><?php echo $user['created_at'] ?></dd>
								</dl>
					        </div>
					      </div>
					    </div>
					    <div class="panel box box-solid">
					      <div class="box-header with-border">
					        <h4 class="box-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" class="">
					            Official info
					          </a>
					        </h4>
					      </div>
					      <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="true" style="">
					        <div class="box-body">
					        	<table class="table table table-striped">
					                <tbody>
						                <tr>
						                  <th style="width: 10px">CIN</th>
						                  <th>First Name</th>
						                  <th>Last Name</th>
						                  <th>Email</th>
						                  <th>Address</th>
						                  <th>Phone Number</th>
						                  <th>created_at</th>
						                </tr>
						                <tr>
						                  <td><?php echo $employee['cin']; ?></td>
						                  <td><?php echo $employee['first_name']; ?></td>
										  <td><?php echo $employee['last_name'] ?></td>
										  <td><?php echo $employee['email'] ?></td>
										  <td><?php echo $employee['address'] ?></td>
										  <td><?php echo $employee['phone_number'] ?></td>
										  <td><?php echo $employee['created_at'] ?></td>
						                </tr>
					              	</tbody>
					          	</table>
					        </div>
					      </div>
					    </div>
					    <div class="panel box box-solid">
					      <div class="box-header with-border">
					        <h4 class="box-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTree" aria-expanded="true" class="">
					            Service info
					          </a>
					        </h4>
					      </div>
					      <div id="collapseTree" class="panel-collapse collapse" aria-expanded="true" style="">
					        <div class="box-body">
					        	<table class="table table table-striped">
					                <tbody>
						                <tr>
						                  <th style="width: 10px">ID</th>
						                  <th>Name</th>
						                  <th>Description</th>
						                </tr>
						                <tr>
										  <td><?php echo $service['id'] ?></td>
						                  <td><?php echo $service['name']; ?></td>
						                  <td><?php echo $service['description']; ?></td>
						                </tr>
					              	</tbody>
					          	</table>
					          	<h5 style="margin: 30px 0 20px 0;padding: 0 0 0 20px">Service Manager: </h5>
					          	<dl class="dl-horizontal">
			        				<dt>Full Name</dt>
			        				<dd>
			        					<?php echo $service['manager']['last_name'].' '.$service['manager']['last_name']; ?>
			        				</dd>
			        				<dt>Email</dt>
			        				<dd><?php echo $service['manager']['email']; ?></dd>
			        			</dl>
					        </div>
					      </div>
					    </div>
					<?php if(!empty($careers)): ?>
					    <div class="panel box box-solid">
					      <div class="box-header with-border">
					        <h4 class="box-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" class="">
					            Department info
					          </a>
					        </h4>
					      </div>
					      <div id="collapseFour" class="panel-collapse collapse" aria-expanded="true" style="">
					        <div class="box-body">
					        	<table class="table table table-striped">
					                <tbody>
						                <tr>
						                  <th style="width: 10px">ID</th>
						                  <th>Name</th>
						                  <th>Description</th>
						                </tr>
						                <tr>
										  <td><?php echo $department['id'] ?></td>
						                  <td><?php echo $department['name']; ?></td>
						                  <td><?php echo $department['description']; ?></td>
						                </tr>
					              	</tbody>
					          	</table>
					          	<h5 style="margin: 30px 0 20px 0;padding: 0 0 0 20px">Department Manager: </h5>
					          	<dl class="dl-horizontal">
			        				<dt>Full Name</dt>
			        				<dd>
			        					<?php echo $department['manager']['last_name'].' '.$department['manager']['last_name']; ?>
			        				</dd>
			        				<dt>Email</dt>
			        				<dd><?php echo $department['manager']['email']; ?></dd>
			        			</dl>
					        </div>
					      </div>
					    </div>
					<?php endif; ?>
					<?php if(!empty($careers)): ?>
					    <div class="panel box box-solid">
					      <div class="box-header with-border">
					        <h4 class="box-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" class="">
					            Career info
					          </a>
					        </h4>
					      </div>
					      <div id="collapseFive" class="panel-collapse collapse" aria-expanded="true" style="">
					        <div class="box-body">
					        	<table class="table table table-striped">
					                <tbody>
						                <tr>
						                  <th style="width: 10px">ID</th>
						                  <th>Title</th>
						                  <th>Description</th>
						                  <th>created_at</th>
						                </tr>
						                <?php foreach($careers as $career): ?>
							                <tr>
											  <td><?php echo $career['title'] ?></td>
							                  <td><?php echo $career['description']; ?></td>
							                  <td><?php echo $career['created_at']; ?></td>
							                </tr>
						            	<?php endforeach; ?>
					              	</tbody>
					          	</table>
					        </div>
					      </div>
					    </div>
					<?php endif; ?>

					<?php if(!empty($degrees)): ?>
					    <div class="panel box box-solid">
					      <div class="box-header with-border">
					        <h4 class="box-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" class="">
					            Career info
					          </a>
					        </h4>
					      </div>
					      <div id="collapseFive" class="panel-collapse collapse" aria-expanded="true" style="">
					        <div class="box-body">
					        	<table class="table table table-striped">
					                <tbody>
						                <tr>
						                  <th style="width: 10px">ID</th>
						                  <th>Title</th>
						                  <th>Description</th>
						                  <th>created_at</th>
						                </tr>
						                <?php foreach($degrees as $degree): ?>
							                <tr>
											  <td><?php echo $degree['title'] ?></td>
							                  <td><?php echo $degree['description']; ?></td>
							                  <td><?php echo $degree['created_at']; ?></td>
							                </tr>
						            	<?php endforeach; ?>
					              	</tbody>
					          	</table>
					        </div>
					      </div>
					    </div>
					<?php endif; ?>

					<?php if(!empty($trainings)): ?>
					    <div class="panel box box-solid">
					      <div class="box-header with-border">
					        <h4 class="box-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" class="">
					            Career info
					          </a>
					        </h4>
					      </div>
					      <div id="collapseFive" class="panel-collapse collapse" aria-expanded="true" style="">
					        <div class="box-body">
					        	<table class="table table table-striped">
					                <tbody>
						                <tr>
						                  <th style="width: 10px">ID</th>
						                  <th>Title</th>
						                  <th>Description</th>
						                  <th>created_at</th>
						                </tr>
						                <?php foreach($trainings as $training): ?>
							                <tr>
											  <td><?php echo $training['title'] ?></td>
							                  <td><?php echo $training['description']; ?></td>
							                  <td><?php echo $training['started_at']; ?></td>
							                  <td><?php echo $training['ended_at']; ?></td>
							                </tr>
						            	<?php endforeach; ?>
					              	</tbody>
					          	</table>
					        </div>
					      </div>
					    </div>
					<?php endif; ?>
					  </div>
					</div>
					<!-- /.box-body -->
				</div>
	        </div>
	      </div>
	    </section>
	    <!-- /.content -->
	  </div>
	  <!-- /.content-wrapper -->
<?php require_once INC."bottomHTML.php"; ?>