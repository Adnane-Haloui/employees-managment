<?php


require_once "./config.php";
require_once ROOT_URL."database/connect.php";
require_once SESSIONS."setUp.php";
require_once INC."topHTML.php";
require_once INC."header.php";
require_once INC."aside.php";
?>
	<div class="content-wrapper">
		<section class="content-header">
		  <h1>
		    Dashboard
		    <small>Control panel</small>
		  </h1>
		</section>
	</div>
<?php require_once INC."bottomHTML.php"; ?>
