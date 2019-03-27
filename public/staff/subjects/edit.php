<?php 

	// This is the correct way to intro this page

	require_once("../../../private/initialize.php");
	require_login();

	if (!isset($_GET['id'])) {
		redirect_to(WWW_ROOT . '/staff/subjects/index.php');
	}

	$id = $_GET['id'];

	$subject = find_subject_by_id($id);

	if (is_post_request()) {
		$subject = [];
		$subject['id'] = $id;
		$subject['menu_name'] = $_POST['menu_name'];
		$subject['position'] = $_POST['position'];
		$subject['visible'] = $_POST['visible'];

		$result = update_subject($subject);

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

	<h1>Edit Subject</h1>
	<form action="<?php echo $_SERVER['PHP_SELF'] . "?id=" . $id; ?>" method="post">
		<dl>
			<dt>Menu Name</dt>
			<dd><input type="text" name="menu_name" value="<?php echo h($subject['menu_name']); ?>"></dd>
			<span class="err_display">
		    	<?php
					echo display_errors('menu_name') ?? '';
				?>
		    </span>
		</dl>
		<dl>
			<dt>Position</dt>
			<dd>
				<select name="position">
					<?php 
						for ($i = 1; $i <= count_subjects(); $i++) { 
							echo "<option value=\"{$i}\"";
							echo $i == $subject['position'] ? "selected" : '';
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
				<input type="checkbox" <?php if ($subject['visible'] == "1") { echo "checked"; };  ?> name="visible" value="1" />
			</dd>
			<div id="operations">
				<input type="submit" value="Submit">
			</div>
		</dl>
	</form>

</div>

<?php include(PRIVATE_PATH . '/shared/staff_footer.php'); ?>