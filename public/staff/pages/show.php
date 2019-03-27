<?php 
	require_once("../../../private/initialize.php"); 
	require_login();

	$id = $_GET['id'] ?? '';
	$page = find_page_by_id($id);
	$page['content'] = db_parse_to_html($page['content']);

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

	<h2><?php echo $page['menu_name']; ?></h2>
	<p><?php echo $page['content']; ?></p>

</div>

<?php include(SHARED_PATH . "/staff_footer.php"); ?>