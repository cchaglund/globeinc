<?php 
	require_once("../../../private/initialize.php");
	require_login();

	$id = $_GET['id'] ?? '';
	$subject = find_subject_by_id($id);

	include(SHARED_PATH . "/staff_header.php");

	include_once(SHARED_PATH . "/toolbar.php");
?>

<div id="content">

	<div class="status_message">
		<?php 
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		?>
	</div>

	<h2><?php echo $subject['menu_name']; ?></h2>
	<p><?php echo $subject['content']; ?></p>

</div>

<?php include(SHARED_PATH . "/staff_footer.php"); ?>