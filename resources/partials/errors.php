<?php if(isset($errors) && !empty($errors)): ?>
	<div class="alert alert-warning alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		
		<?php if(count($errors) == 1): ?>
			<p><?php echo $errors[0]; ?></p>
		<?php else: ?>
			<ul>
				<?php foreach ($errors as $error): ?>
					<li>$error</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	
	</div>
<?php endif; ?>
