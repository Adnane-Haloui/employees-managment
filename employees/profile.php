<?php
	require_once "./../config.php";
	require_once ROOT_URL."database/connect.php";
	require_once SESSIONS."setUp.php";
	require_once INC."topHTML.php";
	//
		/*
		 * Hanta kay Adnan, chof m3a l HTML dial adile, m3reftch mzn b7alach, wakha zedt les styles, li dar howa
		 * Mabghatch tekhdem mzn, lmhm nta ila bghiti tzid des style okhrin ola js, ila kano ghir chiwiya, dirhom ghir hna
		 * ila bsf, dirhom f l dossier inc, we jibhom, require kifma dayer lfo9
		 * a part ça, rah kolchi data kaynin f des arrays wajdin, khass ghir ytafichiw
		 */
		require_once INC."profileCSS.php";
	//
	require_once INC."header.php";
	require_once INC."aside.php";

	$employee_id = $db->real_escape_string($_SESSION['id']);

	// User INFO
	$result = $db->query("
		SELECT username
		FROM users
		WHERE employee_id = '{$employee_id}';
	") or die($db->error);
	$username = $result->fetch_array(MYSQLI_NUM)[0];

	// Employee INFO
	$result = $db->query("
		SELECT cin, first_name, last_name, email, address, phone_number, created_at
		FROM employees
		WHERE id = '{$employee_id}';
	") or die($db->error);
	$employee = $result->fetch_array(MYSQLI_ASSOC);

	// Service INFO
	$result = $db->query("
		SELECT s.id, s.name, s.description, s.manager_id, s.department_id
		FROM employees as e, services as s
		WHERE e.id = '{$employee_id}' and e.service_id = s.id;
	") or die($db->error);
	$service = $result->fetch_array(MYSQLI_ASSOC);
	$result = $db->query("
		SELECT first_name, last_name, email
		FROM employees
		WHERE id = '{$service['manager_id']}';
	") or die($db->error);
	$service['manager'] = $result->fetch_array(MYSQLI_ASSOC);


	// Department INFO
	$result = $db->query("
		SELECT name, description, location
		FROM departments
		WHERE id = '{$service['department_id']}';
	") or die($db->error);
	$department = $result->fetch_array(MYSQLI_ASSOC);


	// Career INFO
	$result = $db->query("
		SELECT title, description, created_at
		FROM careers
		WHERE employee_id = '{$employee_id}';
	") or die($db->error);
	$career = $result->fetch_array(MYSQLI_ASSOC);

	// Degrees INFO
	$result = $db->query("
		SELECT title, description, created_at
		FROM degrees
		WHERE employee_id = '{$employee_id}';
	") or die($db->error);
	$degrees = $result->fetch_array(MYSQLI_ASSOC);

	// Trainnings INFO
	$result = $db->query("
		SELECT title, description, started_at, ended_at
		FROM trainings
		WHERE employee_id = '{$employee_id}';
	") or die($db->error);
	$trainings = $result->fetch_array(MYSQLI_ASSOC);


?>
	<div class="content-wrapper">

	    <!-- Main content -->



	    <div class="container">
	      <div class="row">
	        <div class="col-md-12"> 
	        <!-- Contenedor -->
	        <ul id="accordion" class="accordion">

	          <li>
	            <div class="col col_4 iamgurdeep-pic">
	            <img class="img-responsive iamgurdeeposahan" alt="iamgurdeeposahan" src="employee.jpg">
	              <div class="username">
	                <h2>Raja Alami  <small><i class="fa fa-map-marker"></i> Maroc (Tanger)</small></h2>
	                <p><i class="fa fa-briefcase"></i> Web Design and Development.</p>
	              </div>
	            </div>
	          </li>

	          <li>
	          <div class="link"><i class="fa fa-globe"></i>About<i class="fa fa-chevron-down"></i></div>
	          <ul class="submenu">
		          <li><a href="#"><i class="fa fa-calendar left-none"></i> Date of Birth : 03/09/1994</a></li>
		          <li><a href="#">Address : Maroc,Tanger</a></li>
		          <li><a href="mailto:gurdeepjawaddi94@gmail.com">Email : RajaAlami94@gmail.com</a></li>
		          <li><a href="#">Phone : +21260000000</a></li>
		          <li><a href="#">Family Situation : Single</a></li>
		          <li><a href="#">Insurance :CNSS</a></li>
		          <li><a href="#">Grade :Technician</a></li>
	          </ul>
	          </li>

	          <li>
	          <div class="link"><i class="fa  fa-graduation-cap"></i>Formation<i class="fa fa-chevron-down"></i></div>
	          <ul class="submenu">
		          <li><a href="#"><i class="fa fa-calendar left-none"></i> DUT : 2015/2017</a></li>
		          <li><a href="#">Professional License : 2017/2018</a></li>
		          <li><a href="#"> Master in Big data : 2018/2020</a></li>
		          <li><a href="#">2 Formation Online (Cisco)</a></li>
	          </ul>
	          </li>

	          <li>
	          <div class="link"><i class="fa  fa-file"></i>Diploma<i class="fa fa-chevron-down"></i></div>
	          <ul class="submenu">
		          <li><a href="#"><i class="fa fa-calendar left-none"></i> Database Administration</a></li>
		          <li><a href="#">mobile application engineering</a></li>
		          <li><a href="#">Big Data and Information system</a></li>
		          <li><a href="#">marketing</a></li>
	          </ul>
	          </li>


				<li class="default open">
				  <div class="link">
				  	<i class="fa fa-code"></i>
				  	Professional Skills
				  	<i class="fa fa-chevron-down"></i>
				  </div>
				  <ul class="submenu">
					  <li>
					  	<a href="#">
					      <span class="tags">Adobe Photoshop</span>
					      <span class="tags">Corel Draw</span>
					      <span class="tags">CSS</span>
					      <span class="tags">Css 3</span> 
					      <span class="tags">Graphic Design</span>
					      <span class="tags">HTML</span>
					      <span class="tags">HTML5</span>
					      <span class="tags">JavaScript</span> 
					      <span class="tags">Twitter bootstrap</span>
					      <span class="tags">bootstrap</span>
					      <span class="tags">User Interface Design</span>
					      <span class="tags">Wordpress</span>
					   	</a>
					  </li>
					</ul>
				</li>

	        </ul>
	        </div>
	      </div>
	      <!-- /.content -->
	    </div>
	  <!-- /.content-wrapper -->
	  </div>
<?php require_once INC."bottomHTML.php"; ?>