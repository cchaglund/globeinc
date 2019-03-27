<?php 
	require_once("../../private/initialize.php");

	if (is_logged_in()) {
		redirect_to(url_to("/staff/index.php"));
	}

	$page_title = 'Login';

	if (is_post_request()) {
		
		$user_creds['email'] = $_POST['email'];
		$user_creds['pass'] = $_POST['pass'];

		$result = login_user($user_creds);

		if ($result === true) {
			redirect_to(url_to('/staff/index.php'));	
		} else {
			$errors = $result;
		}
	}

	include(SHARED_PATH . "/staff_header.php");
?>

<div id="content">

	<div id="login_prompt">

		<span class="err_display">
	    	<?php
				echo display_errors('login') ?? '';
			?>
	    </span>

		<h3>Login</h3>

		<form action="login.php" method="post">

			<dl>
				<dt>Email</dt>
				<dd><input type="email" name="email"></dd>
			</dl>

			<dl>
				<dt>Password</dt>
				<dd><input type="password" name="pass"></dd>
			</dl>

			<div class="action">
				<input type="submit" name="submit" value="Submit">
			</div>

		</form>

	</div>

</div>

<?php include(SHARED_PATH . "/public_footer.php"); ?>