<?php 
	require_once("../../../private/initialize.php");
	require_login();

	$subjects_set = find_all_subjects();
	
	if (is_post_request()) {
		$page = [];
		$page['menu_name'] = $_POST['menu_name'];
		$page['position'] = $_POST['position'];
		$page['visible'] = $_POST['visible'];
		$page['content'] = $_POST['content'];
		$page['subject_id'] = $_POST['subject_id'];

		$result = create_new_page($page);

		if ($result === true) {
			$_SESSION['message'] = "<em>'" . $page['menu_name'] . "'</em> has been successfully created";
			$new_id = mysqli_insert_id($db);
			redirect_to(url_to("/staff/pages/show.php?id=" . $new_id));
		} else {
			$errors = $result;
		}
	}

?>

<?php 
	$page_title = "Create New Page"; 
?>

<?php include(SHARED_PATH . "/staff_header.php"); ?>

<div id="content">

	<div class="subject new">

		<h1>Create New Page</h1>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

		  <dl>
		    <dt>Menu Name</dt>
		    <dd><input type="text" name="menu_name" value="<?php echo h($page['menu_name']); ?>" /></dd>
		    <span class="err_display">
		    	<?php
					echo display_errors('menu_name') ?? '';
				?>
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
						for ($i = 1; $i <= count_pages(); $i++) { 
							echo "<option value=\"{$i}\"";
							echo $i == $page['position'] ? "selected" : '';
							echo ">{$i}</option>";
						} 
					?>
					<option value="<?php echo count_pages() + 1; ?>" selected><?php echo count_pages() + 1; ?></option>
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
		  		<textarea name="content" id="edit_content_field" placeholder="Markdown code here"></textarea>
		  	</dd>
		  </dl>

		  <div id="operations">
		    <input type="submit" name="submit" value="Submit" />
		  </div>
		</form>
	</div>

</div>

<?php include(SHARED_PATH . "/staff_footer.php"); ?>

