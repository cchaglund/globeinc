<?php 
	require_once("../../../private/initialize.php");
	require_login();

	// This is the correct way to intro this page

	$subject = find_subject_by_id($id);

	if (is_post_request()) {
		$subject = [];
		$subject['id'] = $id;
		$subject['menu_name'] = $_POST['menu_name'];
		$subject['position'] = $_POST['position'];
		$subject['visible'] = $_POST['visible'];

		$result = create_new_subject($subject);

		if ($result === true) {
			$_SESSION['message'] = "<em>'" . $subject['menu_name'] . "'</em> has been successfully created";
			$new_id = mysqli_insert_id($db);
			redirect_to(url_to("/staff/subjects/index.php"));
		} else {
			$errors = $result;
		}
	}

?>

<?php $page_title = "Create New Subject"; ?>

<?php include(SHARED_PATH . "/staff_header.php"); ?>

<div id="content">

	<div class="subject new">

		<h1>Create New Subject</h1>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		  
		  <dl>
		    <dt>Menu Name</dt>
		    <dd><input type="text" name="menu_name" value="<?php echo h($subject['menu_name']); ?>" /></dd>
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
					<option value="<?php echo count_subjects() + 1; ?>" selected><?php echo count_subjects() + 1; ?></option>
				</select>
		    </dd>
		  </dl>

		  <dl>
		    <dt>Visible</dt>
		    <dd>
		      <input type="hidden" name="visible" value="0" />
		      <input type="checkbox" name="visible" value="1" />
		    </dd>
		  </dl>

		  <div id="operations">
		    <input type="submit" name="submit" value="Submit" />
		  </div>
		</form>
	</div>

</div>

<?php include(SHARED_PATH . "/staff_footer.php"); ?>

