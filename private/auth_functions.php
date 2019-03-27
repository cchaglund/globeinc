<?php

	function login_user($user_creds) {
		session_regenerate_id();

		$failure_msg = "Login failed.";

		// Tries to find user, returns id
		$user = find_user_by_email($user_creds['email']);

		if (!isset($user['id'])) {
			$errors = $user;
			return $errors;
		}

		// Validates password
		$errors = validate_password($user_creds['pass']);

		if (!empty($errors)) {
			return $errors;
		}
		
		// Compares user given password with db hashed password
		$hashed_password = $user['hashed_password'];
		$password = $user_creds['pass'];

		$login_granted = password_verify($password, $hashed_password);
		
		if (!$login_granted) {
			$errors['login'] = $failure_msg;
			return $errors;
		}

		// Sets an email variable in the session to indicate user is logged in
		$_SESSION['email'] = $user_creds['email'];
		return true;
	}

	function is_logged_in() {
		return isset($_SESSION['email']);
	}

	function require_login() {
		if (!isset($_SESSION['email'])) {
			redirect_to(url_to("/staff/login.php"));
		}
	}

?>