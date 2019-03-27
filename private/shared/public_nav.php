<navigation id="public_nav">
	
	<?php 

		$subjects_set = find_all_subjects(['visible' => '1']);
 
		while ($subject = mysqli_fetch_assoc($subjects_set)) {
			echo "<ul><h5><a class='nav_subject' href=\"" . WWW_ROOT . "/show.php?id=" . h(u($subject['id'])) . "\">";
			echo h($subject['menu_name']);
			echo "</a></h5>";

			$pages_set = find_pages_by_subject_id($subject['id'], ['visible' => '1']); 
			

			while ($page = mysqli_fetch_assoc($pages_set)) {
					echo "<li><a class='nav_page' href=\"" . WWW_ROOT . "/show.php?id=" . h(u($page['id'])) . "\">";
					echo h($page['menu_name']);
					echo "</a></li>";
			}
			echo "</ul>";
		}

	?>

</navigation>