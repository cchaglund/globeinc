<?php 

	require_once("../../private/initialize.php");

	unset($_SESSION['email']);
	unset($_SESSION['pass']);

	redirect_to(url_to("/index.php"));
?>