<?php
	require_once "./../config.php";
	require CLASSES."DB.php";
	require CLASSES."Session.php";
	Session::setUp();
	require_once INC."topHTML.php";
	require_once INC."header.php";
	require_once INC."aside.php";

	require CLASSES."Employee.php";
	Employee::managerControlAccess();
	$employee = new Employee();
	$attendanceInfo = $employee->getAttendancesList();
?>

<div class="content-wrapper">
	<section class="content">
		<div class="row">
	        <div class="col-md-12"> 
				<div class="box box-solid">
					<?php if($attendanceInfo): ?>
					<div class="box-header with-border">
						<h5 class="box-title">Attendances List</h5>
					</div>
					<div class="box-body">
						<table class="table table-striped table-bordered dataTable">
			        		<thead>
			        			<tr>
				                  <th>CIN</th>
				                  <th>DATE</th>
				                </tr>
			        		</thead>
			                <tbody>
				                <?php foreach($attendanceInfo as $attendance): ?>
					                <tr>
									  <td><?php echo $attendance['cin'] ?></td>
					                  <td><?php echo $attendance['created_at']; ?></td>
					                </tr>
				            	<?php endforeach; ?>
			              	</tbody>
			          	</table>
					</div>
					<?php else: ?>
					<div class="box-header with-border">
		              <h5 class="text-center">We don't have any attendances yet!</h5>
		            </div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
</div>
<?php require_once INC."bottomHTML.php"; ?>