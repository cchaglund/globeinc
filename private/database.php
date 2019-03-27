<?php

	require_once('db_credentials.php');

	function db_connect() {
		$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		confirm_db_connection();
		return $connection;
	}

	function db_disconnect($connection) {
		if (isset($connection)) {
			mysqli_close($connection);
		}
	}

	function confirm_db_connection() {
		if (mysqli_connect_errno()) {
			$msg = "Database connection failed: ";
			$msg .= mysqli_connect_error();
			$msg .= " (" . mysqli_connect_errno() . ") ";
			exit($msg);
		}
	}

	function confirm_result_set($result_set) {
		if (!$result_set) {
			$msg = "Database query failed";
			$msg .= mysqli_connect_error();
			$msg .= " (" . mysqli_connect_errno() . ") ";
			exit($msg);
		}
	}

	function confirm_creation($result) {
		if (!$result) {
			$msg = "Failed to create new subject in database";
			$msg .= mysqli_connect_error();
			$msg .= " (" . mysqli_connect_errno() . ") ";
			exit($msg);	
		}
	}

	function confirm_update($result) {
		if (!$result) {
			$msg = "Failed to update database";
			$msg .= mysqli_connect_error();
			$msg .= " (" . mysqli_connect_errno() . ") ";
			exit($msg);
		}
	}

	function db_escape($connection, $string) {
		return mysqli_real_escape_string($connection, $string);
	}

	function db_parse_to_html($content) {
		$Parsedown = new Parsedown();
		
		$converted = $Parsedown->text($content); 

		return $converted;
	}

?>