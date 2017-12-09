<?php
	require_once "./../config.php";
	require CLASSES."DB.php";
	require CLASSES."Session.php";
	Session::setUp();

	require_once INC."topHTML.php";
	require_once INC."header.php";
	require_once INC."aside.php";
	
	require CLASSES."Employee.php";

	$employee = new Employee($_SESSION['id']);

	// User INFO
	$userInfo = $employee->getUserInfo();
	// Employee INFO
	$employeeInfo = $employee->getEmloyeeInfo();

	// Service INFO
	$serviceInfo = $employee->getServiceInfo();
	// Department INFO
	if(!$serviceInfo) {
		$departmentInfo = $employee->getManagerDepartmentInfo();
	} else {
		$departmentInfo = $employee->getDepartmentInfo($serviceInfo['department_id']);
		// service manager info
		$serviceInfo['manager'] = $employee->getManagerInfo($serviceInfo['manager_id']);
	}
	// Career INFO
	$careerInfo = $employee->getCareerInfo();
	// Degrees INFO
	$degreesInfo = $employee->getDegreesInfo();
	// Trainings INFO
	$trainingsInfo = $employee->getTrainingsInfo();
?>

	<div class="content-wrapper">
	    <!-- Main content -->
	    <section class="content">
	      <div class="row">
	        <div class="col-md-12"> 
				<div class="box box-solid">
					<div class="box-header with-border">
				  		<img src="<?php echo APP_URL.$_SESSION['avatar']; ?>" class="img-circle center-block" alt="User Image">
					</div>
					<div class="box-body">
					  <div class="box-group" id="accordion">
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
									<dd><?php echo $userInfo['username']; ?></dd>
									<dt>created_at</dt>
									<dd><?php echo $userInfo['created_at'] ?></dd>
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
					      <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="true">
					        <div class="box-body">
					        	<table class="table table table-striped">
					        		<thead>
					        			<tr>
						                  <th style="width: 10px">CIN</th>
						                  <th>First Name</th>
						                  <th>Last Name</th>
						                  <th>Email</th>
						                  <th>Address</th>
						                  <th>Phone Number</th>
						                  <th>created_at</th>
						                </tr>
					        		</thead>
					                <tbody>
						                <tr>
						                  <td><?php echo $employeeInfo['cin']; ?></td>
						                  <td><?php echo $employeeInfo['first_name']; ?></td>
										  <td><?php echo $employeeInfo['last_name'] ?></td>
										  <td><?php echo $employeeInfo['email'] ?></td>
										  <td><?php echo $employeeInfo['address'] ?></td>
										  <td><?php echo $employeeInfo['phone_number'] ?></td>
										  <td><?php echo $employeeInfo['created_at'] ?></td>
						                </tr>
					              	</tbody>
					          	</table>
					        </div>
					      </div>
					    </div>

					<?php if($serviceInfo): ?>
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
										  <td><?php echo $serviceInfo['id'] ?></td>
						                  <td><?php echo $serviceInfo['name']; ?></td>
						                  <td><?php echo $serviceInfo['description']; ?></td>
						                </tr>
					              	</tbody>
					          	</table>
					          	<h5 style="margin: 30px 0 20px 0;padding: 0 0 0 20px">Service Manager: </h5>
					          	<dl class="dl-horizontal">
			        				<dt>Full Name</dt>
			        				<dd>
			        					<?php echo $serviceInfo['manager']['last_name'].' '.$serviceInfo['manager']['first_name']; ?>
			        				</dd>
			        				<dt>Email</dt>
			        				<dd><?php echo $serviceInfo['manager']['email']; ?></dd>
			        			</dl>
					        </div>
					      </div>
					    </div>
					<?php endif; ?>

					<?php if($departmentInfo): ?>
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
										  <td><?php echo $departmentInfo['id'] ?></td>
						                  <td><?php echo $departmentInfo['name']; ?></td>
						                  <td><?php echo $departmentInfo['description']; ?></td>
						                </tr>
					              	</tbody>
					          	</table>
					          	<?php if(isset($departmentInfo['manager_first_name'])): ?>
						          	<h5 style="margin: 30px 0 20px 0;padding: 0 0 0 20px">Department Manager: </h5>
						          	<dl class="dl-horizontal">
				        				<dt>Full Name</dt>
				        				<dd>
				        					<?php echo $departmentInfo['manager_last_name'].' '.$departmentInfo['manager_first_name']; ?>
				        				</dd>
				        				<dt>Email</dt>
				        				<dd><?php echo $departmentInfo['manager_email']; ?></dd>
				        			</dl>
			        			<?php else: ?>
			        				<h5 style="margin: 30px 0 20px 0;padding: 0 0 0 20px">Department Manager: </h5>
						          	<dl class="dl-horizontal">
				        				<dt>Full Name</dt>
				        				<dd>Your full Name</dd>
				        				<dt>Email</dt>
				        				<dd>Your email</dd>
				        			</dl>
			        			<?php endif; ?>
					        </div>
					      </div>
					    </div>
					<?php endif; ?>

					<?php if($careerInfo): ?>
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
					        	<table class="table table-striped table-bordered dataTable">
					        		<thead>
					        			<tr>
						                  <th>Title</th>
						                  <th>Description</th>
						                  <th>created_at</th>
						                </tr>
					        		</thead>
					                <tbody>
						                <?php foreach($careerInfo as $career): ?>
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

					<?php if($degreesInfo): ?>
					    <div class="panel box box-solid">
					      <div class="box-header with-border">
					        <h4 class="box-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" class="">
					            Degrees info
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
						                <?php foreach($degreesInfo as $degree): ?>
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

					<?php if(!empty($trainingsInfo)): ?>
					    <div class="panel box box-solid">
					      <div class="box-header with-border">
					        <h4 class="box-title">
					          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" class="">
					            Trainings info
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
						                  <th>started_at</th>
						                  <th>ended_at</th>
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