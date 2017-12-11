		</div>
		<div class="pull-right">
			<form action="<?php echo APP_URL; ?>employees/absence.php">
				<button class="btn btn-warning" name="submitted">BUTTON</button>
			</form>
		</div>
		<script src="<?php echo APP_URL.'dist/js/app.js'; ?>"></script>
		<script>
			$('table.dataTable').each(function() {
				$(this).dataTable();
			});
		</script>
	</body>
</html>