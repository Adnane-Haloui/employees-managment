<?php
	require_once "./../config.php";
	require_once ROOT_URL."database/connect.php";
	require_once SESSIONS."setUp.php";
	require_once INC."topHTML.php";
	require_once INC."header.php";
	require_once INC."aside.php";

	if(empty($_SESSION['service_id'])) {
		$query = "
			SELECT cin, e.id, first_name, last_name, email, avatar, phone_number, address, s.name as service_name, j.title as job_title, e.created_at
			FROM employees as e, jobs as j, services as s
			WHERE e.service_id = s.id and e.job_id = j.id;
		";
	} else {
		$query = "
			SELECT cin, e.id, first_name, last_name, email, avatar, phone_number, address, s.name as service_name, j.title as job_title, e.created_at
			FROM employees as e, jobs as j, services as s
			WHERE e.service_id = s.id and e.job_id = j.id and e.service_id = '{$_SESSION['service_id']}';
		";
	}
	$result = $db->query($query);
	$employees = $result->fetch_all(MYSQLI_ASSOC);

?>

<style type="text/css">
.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}#PersonalInfoHide{
	    display: none;
	}</style>
	<style type="text/css">
   .centre{

      float: none;
      
      margin-left:5%;
    
    }
  </style>
  <link rel="stylesheet" href="employee.css">
<div class="content-wrapper" style="min-height: 921px;">
    <!-- Content Header (Page header) -->

  <div class="content">
<div class="col-md-11 centre">
   <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="dataTables_length" id="example1_length">
                      <label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select> entries</label>
                    </div>
                  </div>
                      <div class="col-sm-6">
                        <div id="example1_filter" class="dataTables_filter">
                          <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 181px;">CIN</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 223px;">First Name</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 197px;">Last Name</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 155px;">Email</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 155px;">Job Title</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Service</th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Phone</th>
                   <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Adresse</th>
                  
                   <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Created_at</th>
                    


                </tr>
                </thead>
                 <tbody>
	                <?php foreach($employees as $employee): ?>
						<tr role="row" class="odd lig">
							<td class="sorting_1"><?php echo $employee['cin']; ?></td>
							<td><?php echo $employee['first_name']; ?></td>
							<td><?php echo $employee['last_name']; ?></td>
							<td><?php echo $employee['email']; ?></td>
							<td><?php echo $employee['job_title']; ?></td>
							<td><?php echo $employee['service_name']; ?></td>
							<td><?php echo $employee['phone_number']; ?></td>
							<td><?php echo $employee['address']; ?></td>
							<td><?php echo $employee['created_at']; ?></td>
						</tr>
	                <?php endforeach; ?>
         		</tbody>
                
              </table></div></div></div>
            </div>
            <!-- /.box-body -->
          </div>
  </div>
  </div>
 <!-- Old table-->
  <div class="row">
  
   <div class="col-md-12 " id="PersonalInfoHide" style="display: none;"> 
  <!-- Contenedor -->
  <ul id="accordion" class="accordion">
    <li>
<div class="col col_4 iamgurdeep-pic">
<img class="img-responsive iamgurdeeposahan" alt="iamgurdeeposahan" src="<?php echo APP_URL.$employees[0]['avatar']; ?>" style="width:100%;">

<div class="username">
    <h2><?php echo $employees[0]['first_name']; ?></h2>
    <p><i class="fa fa-briefcase"></i> <?php echo $employees[0]['job_title']; ?></p>
    
   
</div>
    
</div>

 </li>

    <li class="">
      <div class="link"><i class="fa fa-globe"></i>About<i class="fa fa-chevron-down"></i></div>
      <ul class="submenu" style="display: none;">
        <li><a href="#"><i class="fa fa-calendar left-none"></i> Date of Birth : <?php echo $employees[0]['created_at']; ?></a></li>
        <li><a href="mailto:gurdeepjawaddi94@gmail.com">Email : <?php echo $employees[0]['email']; ?></a></li>
        <li><a href="#">Phone : +21260000000</a></li>
      </ul>
    </li>

    <li>
      <div class="link"><i class="fa  fa-graduation-cap"></i>Formation<i class="fa fa-chevron-down"></i></div>
      <ul class="submenu" style="">
        <li><h1 style="margin: 10px 0">Nothing to show</h1></li>
      </ul>
    </li>
   
   <li>
      <div class="link"><i class="fa  fa-file"></i>Diploma<i class="fa fa-chevron-down"></i></div>
      <ul class="submenu" style="">
        <li><h1 style="margin: 10px 0">Nothing to show</h1></li>
      </ul>
    </li>
   

    <li>
      <div class="link"><i class="fa fa-code"></i>Professional Skills<i class="fa fa-chevron-down"></i></div>
      <ul class="submenu" style="">
        <li><h1 style="margin: 10px 0">Nothing to show</h1></li>
      </ul>
    </li>
  </ul>
  </div>

</div>




</div>
    <!-- /.content -->
  </div>
  <script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
  <script>
	$(".lig").click(function(){
	    $("#PersonalInfoHide").toggle();
	});
  </script>
  <script src="employee.js"></script>
 <?php require_once INC.'bottomHTML.php'; ?>


