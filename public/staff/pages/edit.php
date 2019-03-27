<?php 

	require_once("../../../private/initialize.php");
	require_login();

	if (!isset($_GET['id'])) {
		redirect_to(WWW_ROOT . '/staff/pages/index.php');
	}

	$id = $_GET['id'];
	$page = find_page_by_id($id);
	$subjects_set = find_all_subjects();

	if (is_post_request()) {
		$page = [];
		$page['id'] = $id;
		$page['menu_name'] = $_POST['menu_name'];
		$page['position'] = $_POST['position'];
		$page['visible'] = $_POST['visible'];
		$page['subject_id'] = $_POST['subject_id'];
		$page['content'] = $_POST['content'];

		$result = update_page($page);

		if ($result === true) {
			$_SESSION['message'] = "<em>'" . $subject['menu_name'] . "'</em> has been successfully updated";
			redirect_to("index.php");
		} else {
			$errors = $result;
		}
	}

	include(PRIVATE_PATH . '/shared/staff_header.php'); 

?>

<div id="content">

	<h1>Edit Page</h1>

	<form action="<?php echo $_SERVER['PHP_SELF'] . "?id=" . $id; ?>" method="post">

		<dl>
			<dt>Menu Name</dt>
			<dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']); ?>"></dd>
			<span class="err_display">
				<?php echo display_errors('menu_name') ?? ''; ?>
			</span>
		</dl>

		<dl>
			<dt>Subject</dt>
			<dd>
				<select name="subject_id">
					<?php 
						while ($subject = mysqli_fetch_assoc($subjects_set)) { 
							echo "<option value=\"{$subject['id']}\"";
							echo $subject['id'] == $page['subject_id'] ? "selected" : '';
							echo ">{$subject['menu_name']}</option>";
						 } 
						mysqli_free_result($subjects_set); 
					?>
				</select>
			</dd>
		</dl>

		<dl>
			<dt>Position</dt>
			<dd>
				<select name="position">
					<?php 
						for ($i = 1; $i <= count_subjects(); $i++) { 
							echo "<option value=\"{$i}\"";
							echo $i == $page['position'] ? "selected" : '';
							echo ">{$i}</option>";
						} 
					?>
				</select>
			</dd>
		</dl>

		<dl>
			<dt>Visible</dt>
			<dd>
				<input type="hidden" name="visible" value="0" />
				<input type="checkbox" <?php if ($page['visible'] == "1") { echo "checked"; };  ?> name="visible" value="1" />
			</dd>
		</dl>

		<dl>
		  	<dt>Content</dt>
		  	<dd>
		  		<textarea id="edit_content_field" name="content" value="<?php echo h($page['content']) ?>" placeholder="Mardown code here."><?php echo h($page['content']) ?></textarea>
		  	</dd>
		</dl>

		<dl>
			<div id="operations">
				<input type="submit" value="Submit">
			</div>
		</dl>
	</form>

</div>

<?php include(PRIVATE_PATH . '/shared/staff_footer.php'); ?>