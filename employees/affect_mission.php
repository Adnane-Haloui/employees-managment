<?php
	require_once "./../config.php";
  require CLASSES."DB.php";
  require CLASSES."Session.php";
  Session::setUp();
  require CLASSES."Employee.php";
  Employee::serviceControlAccess();
  $errors = '';
  $success = false;

  if(isset($_POST['submited'])) {
    if(!empty($_POST['mission']) && !empty($_POST['employee_id_1'])) {
      do {

        $DB = new DB();

        $query = "
          UPDATE `missions`
          SET `employee_id`= ?
          WHERE `id`= ?;
        ";
        $args = [
          [
            'value' => $_POST['employee_id_1'],
            'type' => PDO::PARAM_INT
          ],
          [
            'value' => $_POST['mission'],
            'type' => PDO::PARAM_INT
          ]
        ];

        $success = $DB->execute($query, $args);
        if(!$success) {
          $errors = array('sorry, SOMETHING WENT WRONG, plz try again later');
          break;
        }

        if(empty($_POST['employee_id_2']) && empty($_POST['employee_id_3']))
          break;

        $query = "
          SELECT *
          FROM missions
          WHERE id = ?
        ";
        $args = [
          [
            'value' => $_POST['mission'],
            'type' => PDO::PARAM_INT
          ]
        ];

        $data = $DB->fetch($query, $args);
        if(!$data) {
          $errors = array('sorry, SOMETHING WENT WRONG, plz try again later');
          break;
        }

        if(!empty($_POST['employee_id_2'])) {
          $query = "
            INSERT INTO `missions`(`service_id`, `employee_id`, `manager_id`, `title`, `description`, `created_at`)
            VALUES (?, ?, ?, ?, ?, ?);
          ";
          $args = [
            [
              'value' => $_SESSION['service_id'],
              'type' => PDO::PARAM_INT
            ],
            [
              'value' => $_POST['employee_id_2'],
              'type' => PDO::PARAM_INT
            ],
            [
              'value' => $data['manager_id'],
              'type' => PDO::PARAM_INT
            ],
            [ 'value' => $data['title'] ],
            [ 'value' => $data['description'] ],
            [ 'value' => $data['created_at'] ]
          ];

          $DB->execute($query, $args);
        }

        if(!empty($_POST['employee_id_3'])) {
          $query = "
            INSERT INTO `missions`(`service_id`, `employee_id`, `manager_id`, `title`, `description`, `created_at`)
            VALUES (?, ?, ?, ?, ?, ?);
          ";
          $args = [
            [
              'value' => $_SESSION['service_id'],
              'type' => PDO::PARAM_INT
            ],
            [
              'value' => $_POST['employee_id_3'],
              'type' => PDO::PARAM_INT
            ],
            [
              'value' => $data['manager_id'],
              'type' => PDO::PARAM_INT
            ],
            [ 'value' => $data['title'] ],
            [ 'value' => $data['description'] ],
            [ 'value' => $data['created_at'] ]
          ];

          $DB->execute($query, $args);
        }

      } while(false);
    } else {
      $errors = array('All fields are required');
    }
  }


  require_once INC."topHTML.php";
  require_once INC."header.php";
  require_once INC."aside.php";

  require CLASSES."Mission.php";
  $mission = new Mission();
  $missions = $mission->getNonAffectedMissions();
  if(!$missions) $missions = [];
  $DB = new DB();

  $query = "
        SELECT e.id, cin, first_name, last_name, j.title as job_title, e.created_at
        FROM employees as e, jobs as j
        WHERE service_id = ? and e.job_id = j.id;
  ";

  $args = [
      [
          'value' => $_SESSION['service_id'],
          'type' => PDO::PARAM_INT
        ]
    ];

  $employees = $DB->fetchAll($query, $args);

?>
<div class="content-wrapper" style="min-height: 921px;">
    <!-- Content Header (Page header) -->
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
          <div class="box box-solid">
            <?php if($missions): ?>
              <div class="box-header with-border">
                  <h5 class="box-title">Affect Missions to employees</h5>
              </div>
              <div class="box-body">
                <table class="table table-striped table-bordered dataTable">
                  <thead>
                    <tr>
                      <th style="max-width: 10px">ID</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                      <tbody>
                        <?php foreach($missions as $key => $mission): ?>
                          <tr data-toggle="modal" data-target="#modal-row-<?php echo $key ?>">
                            <td><?php echo $mission['id'] ?></td>
                            <td><?php echo $mission['title'] ?></td>
                            <td><?php echo $mission['description']; ?></td>
                            <td><?php echo $mission['created_at']; ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                  </table>
              </div>
            <?php else: ?>
              <div class="box-header with-border">
                  <h5 class="text-center">There isn't any missions availble for assignment yet!</h5>
              </div>
            <?php endif; ?>
          </div>
      </div>
    </div>

    

  <?php foreach ($missions as $key => $mission): ?>
    <div class="modal fade" id="modal-row-<?php echo $key ?>" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Choose the employees</h4>
          </div>
          <div class="modal-body box-group" id="accordion">
            <div class="box box-solid panel">
              <div class="box-body">
                <form action="<?php echo APP_URL.'employees/affect_mission.php'; ?>" method="POST">
                  <input type="hidden" name="mission" value="<?php echo $mission['id']; ?>">
                  <div class="form-group col-xs-4">
                    <label>EMPLOYEE 1 ID (*)</label>
                    <input class="form-control" name="employee_id_1" type="text">
                  </div>
                  <div class="form-group col-xs-4">
                    <label>EMPLOYEE 2 ID</label>
                    <input class="form-control" name="employee_id_2" type="text">
                  </div>
                  <div class="form-group col-xs-4">
                    <label>EMPLOYEE 3 ID</label>
                    <input class="form-control" name="employee_id_3" type="text">
                  </div>
                  <div class="form-group text-center">
                    <button type="submit" name="submited" class="btn btn-primary">Affect</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="box box-solid panel">
              <div class="box-body">
                <table class="table table-striped table-bordered dataTable">
                  <thead>
                    <tr>
                      <th style="max-width: 10px">ID</th>
                      <th style="max-width: 20px;width: 100%">CIN</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Job</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($employees as $employee): ?>
                      <tr>
                        <td><?php echo $employee['id'] ?></td>
                        <td><?php echo $employee['cin']; ?></td>
                        <td><?php echo $employee['first_name']; ?></td>
                        <td><?php echo $employee['last_name']; ?></td>
                        <td><?php echo $employee['job_title']; ?></td>
                        <td><?php echo $employee['created_at']; ?></td>
                      </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>




    </section>

  </div>

<?php require_once INC."bottomHTML.php"; ?>