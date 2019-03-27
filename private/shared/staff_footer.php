		</main>
		<footer>
			&copy; <?php echo date('Y'); ?> Globe Inc.
		</footer>



		<!-- libs -->
		<script
			src="https://code.jquery.com/jquery-3.3.1.min.js"
			integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			crossorigin="anonymous"></script>
		<script 
			src="https://unpkg.com/popper.js@1.14.6/dist/umd/popper.min.js"></script>
		<script 
			src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
			integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
			crossorigin="anonymous""></script>
	</body>
</html>

<?php db_disconnect($db); ?>