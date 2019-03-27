<?php 

	require_once("../../private/initialize.php");
	require_login();

	$page_title = "Staff";

	include(SHARED_PATH . "/staff_header.php"); 

?>

<div id="content">
	<h1>
		Main Menu
	</h1>
	<li>
		<ul><a href="<?php echo WWW_ROOT . "/staff/subjects/index.php" ?>">Subjects</a></ul>
		<ul><a href="<?php echo WWW_ROOT . "/staff/pages/index.php" ?>">Pages</a></ul>
	</li>
</div>

<?php include(SHARED_PATH . "/staff_footer.php"); ?>