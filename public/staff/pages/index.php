<?php 
	require_once("../../../private/initialize.php"); 
	require_login();
?>

<?php 
	$pages_set = find_all_pages();
?>

<?php $page_title = "Pages" ?>
<?php include(SHARED_PATH . "/staff_header.php"); ?>

<div id="content">
	<div class="pages listing">

		<div class="status_message">
			<?php 
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			?>
		</div>

		<h1>Pages</h1>

		<div class="actions">
			<a class="action" href="<?php echo WWW_ROOT . '/staff/pages/new.php' ?>">Create new page</a>
		</div>

		<table>
			<tr>
				<th>ID</th>
				<th>Subject</th>
				<th>Position</th>
				<th>Visible</th>
				<th>Menu Name</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>
			
			<?php while ($page = mysqli_fetch_assoc($pages_set)) { ?>
			<tr>
				<td><?php echo h($page['id']); ?></td>
				<td><?php 
							$subject = find_subject_by_id($page['subject_id']);
							echo $subject['menu_name']; 
						?></td>
				<td><?php echo h($page['position']); ?></td>
				<td><?php echo h($page['visible'] == 1 ? 'true' : 'false'); ?></td>
				<td><?php echo h($page['menu_name']); ?></td>
				<td><a href="
						<?php 
							echo WWW_ROOT 
							. '/staff/pages/show.php?'
							. 'id=' . h(u($page['id']));
						?>
					">View</a></td>
				<td><a href="
						<?php 
							echo WWW_ROOT 
							. '/staff/pages/edit.php?'
							. 'id=' . h(u($page['id'])); 
						?>
					">Edit</a></td>
				<td><a href="
						<?php 
							echo WWW_ROOT 
							. '/staff/pages/delete.php?'
							. 'id=' . h(u($page['id']))
							. "&menu_name=" 
							. h(u($page['menu_name'])); 
						?>
					">Delete</a></td>
			</tr>
			<?php } ?>

		</table>

	</div>
</div>

<?php include(SHARED_PATH . "/staff_footer.php"); ?>