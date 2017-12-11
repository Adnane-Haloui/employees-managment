		</div>
		<?php if(!isset($_SESSION['isPresent'])): ?>
			<div class="pull-right">
				<form action="<?php echo APP_URL; ?>employees/attendance.php" method="POST">
					<button class="btn btn-warning" name="submitted">BUTTON</button>
				</form>
			</div>
		<?php endif; ?>
		<script src="<?php echo APP_URL.'dist/js/app.js'; ?>"></script>
		<script>
			$('table.dataTable').each(function() {
				$(this).dataTable();
			});
		</script>
	</body>
</html>