<?php

	require_once "./config.php";
	require_once CLASSES."DB.php";
	require_once CLASSES."Session.php";
	Session::setUp();
	require_once INC."topHTML.php";
	require_once INC."header.php";
	require_once INC."aside.php";
?>
	<div class="content-wrapper">
		<section class="content" style="height:100vh;display:flex;justify-content:center;align-items:center;">
		 
		  <h1>
		    Welcome <?php echo $_SESSION['first_name'];?>
		  </h1>
		</section>
	</div>
<?php require_once INC."bottomHTML.php"; ?>
