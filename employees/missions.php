<?php
	require_once "./../config.php";
	require CLASSES."DB.php";
	require CLASSES."Session.php";
	Session::setUp();
	require_once INC."topHTML.php";
	require_once INC."header.php";
	require_once INC."aside.php";


	require CLASSES."Mission.php";
	$mission = new Mission();
	$missions = $mission->getOwnMissions();

?>

<div class="content-wrapper" style="min-height: 921px;">
    <!-- Content Header (Page header) -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <?php if($missions): ?>
              <div class="box-header with-border">
                  <h5 class="box-title">Affected Missions</h5>
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
                          <tr>
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

	</section>
</div>

<?php require_once INC."bottomHTML.php"; ?>