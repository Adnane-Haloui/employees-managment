<?php
  require_once "./../config.php";
  require CLASSES."DB.php";
  require CLASSES."Session.php";
  Session::setUp();
  require CLASSES."Employee.php";
  $employee = new Employee($_SESSION['id']);
  $employee->managerControlAccess();
  $descandantEmployeesInfo = $employee->getDescandentEmployees();
  require_once INC."topHTML.php";
  require_once INC."header.php";
  require_once INC."aside.php";
?>
<div class="content-wrapper" style="min-height: 921px;">
  <div class="content">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Employees</h3>
      </div>
      <div class="box-body">
        <table width="100%" class="table table-striped table-bordered dataTable">
          <thead>
            <tr>
              <th>CIN</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Address</th>
              <th>Phone Number</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($descandantEmployeesInfo as $key => $value): ?>
            <tr data-toggle="modal" data-target="#modal-row-<?php echo $key ?>">
              <td><?php echo $value['cin']; ?></td>
              <td><?php echo $value['first_name']; ?></td>
              <td><?php echo $value['last_name'] ?></td>
              <td><?php echo $value['email'] ?></td>
              <td><?php echo $value['address'] ?></td>
              <td><?php echo $value['phone_number'] ?></td>
              <td><?php echo $value['created_at'] ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
  <?php foreach ($descandantEmployeesInfo as $key => $value): ?>
    <div class="modal fade" id="modal-row-<?php echo $key ?>" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body box-group" id="accordion">
            <div class="box box-solid panel">
              <div class="modal-header">
                <img src="<?php echo APP_URL.$value['avatar']; ?>" class="img-circle center-block" alt="User Image">
              </div>
            </div>
          <?php if($careerInfo = $employee->getCareerInfo($value['id'])): ?>
            <div class="panel box box-solid">
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne-<?php echo $key ?>" aria-expanded="true" class="">
                    Career Info
                  </a>
                </h4>
              </div>
              <div class="box-body">
                <div id="collapseOne-<?php echo $key ?>" class="panel-collapse collapse" aria-expanded="true" style="">
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
            </div>
          <?php else: ?>
            <div class="panel box box-solid">
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne-<?php echo $key ?>" aria-expanded="true">
                    Career Info
                  </a>
                </h4>
              </div>
              <div class="box-body">
                <div id="collapseOne-<?php echo $key ?>" class="panel-collapse collapse" aria-expanded="true">
                  <h4>No Info</h4>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if($degreesInfo = $employee->getDegreesInfo($value['id'])): ?>
            <div class="panel box box-solid">
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" class="">
                    Degrees Info
                  </a>
                </h4>
              </div>
              <div class="box-body">
                <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="true" style="">
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
            </div>
          <?php else: ?>
            <div class="panel box box-solid">
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo-<?php echo $key ?>" aria-expanded="true">
                    Degrees Info
                  </a>
                </h4>
              </div>
              <div class="box-body">
                <div id="collapseTwo-<?php echo $key ?>" class="panel-collapse collapse" aria-expanded="true">
                  <h4>No Info</h4>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if($trainingsInfo = $employee->getTrainingsInfo($value['id'])): ?>
            <div class="panel box box-solid">
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree-<?php echo $key ?>" aria-expanded="true" class="">
                    Trainings Info
                  </a>
                </h4>
              </div>
              <div class="box-body">
                <div id="collapseThree-<?php echo $key ?>" class="panel-collapse collapse" aria-expanded="true" style="">
                  <div class="box-body">
                    <table class="table table-striped table-bordered dataTable">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Description</th>
                          <th>started_at</th>
                          <th>ended_at</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($trainingsInfo as $traning): ?>
                          <tr>
                            <td><?php echo $traning['title'] ?></td>
                            <td><?php echo $traning['description']; ?></td>
                            <td><?php echo $traning['started_at']; ?></td>
                            <td><?php echo $traning['ended_at']; ?></td>
                          </tr>
                      <?php endforeach; ?>
                      </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          <?php else: ?>
            <div class="panel box box-solid">
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree-<?php echo $key ?>" aria-expanded="true">
                    Tranings Info
                  </a>
                </h4>
              </div>
              <div class="box-body">
                <div id="collapseThree-<?php echo $key ?>" class="panel-collapse collapse" aria-expanded="true">
                  <h4>No Info</h4>
                </div>
              </div>
            </div>
          <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<?php require_once INC."bottomHTML.php"; ?>