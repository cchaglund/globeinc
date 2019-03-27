<div class="page_nav">
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
</div>