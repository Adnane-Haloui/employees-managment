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
?>
<?php


  // Career INFO
  $result = $db->query("
    SELECT title, description, created_at
    FROM careers
    WHERE employee_id = '{$employee_id}';
  ") or die($db->error);
  $careers = $result->fetch_all(MYSQLI_ASSOC);
  if(!empty($careers)) {
    foreach($careers as $career) {
      $date = new Carbon($career['created_at']);
      $date = $date->format($date_format);
      $career['created_at'] = $date;
    }
  }



?>
<div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-10 center">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#timeline" data-toggle="tab" aria-expanded="true">Timeline</a></li>
            </ul>
            <div class="tab-content">
             
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                 
                  <!--
                    <i class="fa fa-hand-paper-o bg-gray"></i>
                    <span class="bg-red">
                    <span class="bg-green">
                    <span class="bg-yellow"> 

                  -->
               
                <?php foreach($careers as $career):?>
                   <li class="time-label">
                        <span class="bg-blue">
                          <?php echo $career['created_at']; ?>
                        </span>
                   </li>
                 
                  <!-- timeline item -->
                  <li>
                    <i class="fa  fa-arrow-circle-o-up  bg-gray"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header"> <?php echo $career['title']; ?></h3>

                      <div class="timeline-body">
                         <?php echo $career['description']; ?>
                      </div>
                    </div>
                  </li>

                  <!-- END timeline item -->
                 <?php endforeach; ?>


                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>

                </ul>
              </div>
              <!-- /.tab-pane -->
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
      </div>
    </section>
  </div>
<?php require_once INC."bottomHTML.php"; ?>