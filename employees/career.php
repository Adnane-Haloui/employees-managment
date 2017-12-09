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


  // Career INFO
  $careerInfo = $employee->getCareerInfo();

?>
<div class="content-wrapper">
      <!-- Main content -->

      <section class="content">
        <?php if(!$careerInfo): ?>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h5 class="text-center">Your don't have any career at the moments</h5>
            </div>
          </div>
        <?php else: ?>
          <div class="box-header">
            <h3 class="text-center">Career</h3>
          </div>
          <div class="box-body">
            <ul class="timeline">
           
            <?php foreach($careerInfo as $career):?>
              <li class="time-label">
                  <span class="bg-blue">
                    <?php echo $career['created_at']; ?>
                  </span>
              </li>
              <li>
                <i class="fa  fa-arrow-circle-o-up  bg-gray"></i>
                <div class="timeline-item">
                  <h3 class="timeline-header">
                    <?php echo $career['title']; ?>
                  </h3>
                  <div class="timeline-body">
                     <?php echo $career['description']; ?>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
              <li>
                <i class="fa fa-clock-o bg-gray"></i>
              </li>
            </ul>
          </div>
        <?php endif; ?>
    </section>
  </div>
<?php require_once INC."bottomHTML.php"; ?>