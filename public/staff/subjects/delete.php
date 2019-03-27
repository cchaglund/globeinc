<?php 
	require_once("../../../private/initialize.php")
	require_login();
?>

<?php
	
	$id = $_GET['id'] ?? '';
	$menu_name = $_GET['menu_name'] ?? '';

	if (is_post_request()) {
		$id = $_POST['id'];
		$result = delete_subject_by_id($id);

		if ($result === true) {
			$_SESSION['message'] = "Successfully deleted";
			redirect_to("index.php");
		}
	} 
?>

<?php include_once(SHARED_PATH . "/staff_header.php") ?>

<div id="content">
	<h3>Are you sure you want to delete this subject?</h3>
	<h4 class="ml-4" style="text-decoration: underline;"><?php echo $menu_name ?></h4>
	<form action="delete.php" method="post">
		<input type="hidden" name="id" value="<?php echo h($id) ?>">
		<input type="submit" value="Yes, delete subject" />
	</form>
</div>

<?php include_once(SHARED_PATH . "/staff_footer.php") ?>