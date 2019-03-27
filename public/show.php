<?php 
	require_once("../private/initialize.php");

	$id = $_GET['id'] ?? '';
	$page = find_page_by_id($id);
	
	$page_['content'] = db_parse_to_html($page['content']);
	
	include(SHARED_PATH . "/public_header.php");
	include(SHARED_PATH . "/public_nav.php");
?>

<div id="content">
	<h2><?php echo $page['menu_name']; ?></h2>
	<p><?php echo $page_['content']; ?></p>
</div>

<?php include(SHARED_PATH . "/public_footer.php"); ?>