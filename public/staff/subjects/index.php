<?php 
	require_once("../../../private/initialize.php");
	require_login();

	$option = [];
	$subjects_set = find_all_subjects($option);

	$page_title = "Subjects";
	$menu_name = "Staff"
?>

<?php include(SHARED_PATH . "/staff_header.php"); ?>

<div id="content">
	<div class="subjects listing">

		<div class="status_message">
			<?php 
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			?>
		</div>

		<h1>Subjects</h1>

		<div class="actions">
			<a class="action" href="<?php echo WWW_ROOT . "/staff/subjects/new.php" ?>">Create new subject</a>
		</div>

		<table class="list">
			<tr>
				<th>Position</th>
				<th>Visible</th>
				<th>Name</th>
				<th>ID</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>

			<?php while($subject = mysqli_fetch_assoc($subjects_set)) { ?>
			<tr>
				<td><?php echo h($subject['position']); ?></td>
				<td><?php echo $subject['visible'] == 1 ? 'true' : 'false'; ?></td>
				<td><?php echo h($subject['menu_name']); ?></td>
				<td><?php echo h($subject['id']); ?></td>
				<td><a class="action" href="
						<?php 
							echo WWW_ROOT 
							. "/staff/subjects/show.php?id=" 
							. h(u($subject['id'])) 
							. "&menu_name=" 
							. h(u($subject['menu_name']));
						?>
					">View</a></td>
				<td><a class="action" href="
						<?php 
							echo WWW_ROOT 
							. "/staff/subjects/edit.php?id=" 
							. h(u($subject['id'])) 
							. "&menu_name=" 
							. h(u($subject['menu_name'])); 
						?>
					">Edit</a></td>
				<td><a class="action" href="
						<?php 
							echo WWW_ROOT 
							. "/staff/subjects/delete.php?id=" 
							. h(u($subject['id'])) 
							. "&menu_name=" 
							. h(u($subject['menu_name'])); 
						?>
					">Delete</a></td>
			</tr>
			<?php 
				} 
				mysqli_free_result($subjects_set);
			?>

		</table>

	</div>
</div>

<?php include(SHARED_PATH . "/staff_footer.php"); ?>