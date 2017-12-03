<?php
	if(isset($_GET['error_msg']) && !empty($_GET['error_msg']))
		echo '<h1>'.$_GET['error_msg'].'</h1>';
	else header('Location: index.php');
?>
