<?php

	function find_user_by_email($email) {
		global $db;

		$errors = validate_email($email);

		if (!empty($errors)) {
			return $errors;
		}

		$sql = "SELECT * FROM users ";
		$sql .= "WHERE ";
		$sql .= "email='" . db_escape($db, $email) . "'";

		$result_set = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($result_set);
		mysqli_free_result($result_set);

		return $result;
	}

	function find_all_pages($option = []) {
		global $db;
		$visible = $option['visible'] ?? false;

		$sql = "SELECT * FROM pages ";
		if ($visible) {
			$sql .= "WHERE visible = '1' ";	
		}
		$sql .= "ORDER BY subject_id ASC, position ASC";

		$result_set = mysqli_query($db, $sql);
		confirm_result_set($result_set);
		return $result_set;
	}

	function find_page_by_id($id) {
		global $db;

		$sql = "SELECT * FROM pages ";
		$sql .= "WHERE id='" . db_escape($db, $id) . "'";

		$result_set = mysqli_query($db, $sql);
		confirm_result_set($result_set);
		$result = mysqli_fetch_assoc($result_set);
		mysqli_free_result($result_set);

		return $result;
	}

	function find_pages_by_subject_id($subject_id, $option = []) {
		global $db;
		$visible = $option['visible'] ?? false;


		$sql = "SELECT * FROM pages ";
		$sql .= "WHERE subject_id='" . db_escape($db, $subject_id) . "'";
		if ($visible) {
			$sql .= " AND visible = '1'";	
		}

		$result_set = mysqli_query($db, $sql);
		confirm_result_set($result_set);

		return $result_set;
	}

	function create_new_page($page) {
		global $db;

		$errors = validate_page($page);

		if (!empty($errors)) {
			return $errors;
		}

		$sql = "INSERT INTO pages ";
		$sql .= "(menu_name, position, visible, content, subject_id) ";
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $page['menu_name']) . "', ";
		$sql .= "'" . db_escape($db, $page['position']) . "', ";
		$sql .= "'" . db_escape($db, $page['visible']) . "', ";
		$sql .= "'" . db_escape($db, $page['content']) . "', ";
		$sql .= "'" . db_escape($db, $page['subject_id']) . "')";

		var_dump($result);
		$result = mysqli_query($db, $sql);
		if ($result) {
			return true;	
		} else {
			echo mysqli_error($db);
			db_disconnect($db);
			exit();
		}
	}

	function delete_page_by_id($id) {
		global $db;

		$sql = "DELETE FROM pages ";
		$sql .= "WHERE id='" . db_escape($db, $id) . "' ";
		$sql .= "LIMIT 1";

		$result = mysqli_query($db, $sql);

		if ($result) {
			return true;
		} else {
			echo mysqli_error($db);
		}
		return $result;
	}

	function update_page($page) {
		global $db;

		$errors = validate_page($page);

		if (!empty($errors)) {
			return $errors;
		}

		$sql = "UPDATE pages ";
		$sql .= "SET ";
		$sql .= "menu_name='" . db_escape($db, $page['menu_name']) . "', ";
		$sql .= "position='" . db_escape($db, $page['position']) . "', ";
		$sql .= "visible='" . db_escape($db, $page['visible']) . "', ";
		$sql .= "subject_id='" . db_escape($db, $page['subject_id']) . "', ";
		$sql .= "content='" . db_escape($db, $page['content']) . "' ";
		$sql .= "WHERE id='" . db_escape($db, $page['id']) . "' ";
		$sql .= "LIMIT 1";

		echo $sql;
		$result = mysqli_query($db, $sql);
		confirm_update($result);

		return $result;
	}

	function count_pages() {
		$count = mysqli_num_rows(find_all_pages());

		return $count;
	}

	function find_all_subjects($option = []) {
		global $db;
		$visible = $option['visible'] ?? false;
		
		$sql = "SELECT * FROM subjects ";
		if ($visible) {
			$sql .= "WHERE visible = '1' ";	
		}
		$sql .= "ORDER BY position ASC, id ASC";

		$result_set = mysqli_query($db, $sql);
		confirm_result_set($result_set);

		return $result_set;
	}

	function find_subject_by_id($id) {
		global $db;

		$sql = "SELECT * FROM subjects ";
		$sql .= "WHERE id='" . db_escape($db, $id) . "'";

		$result_set = mysqli_query($db, $sql);
		confirm_result_set($result_set);
		$result = mysqli_fetch_assoc($result_set);
		mysqli_free_result($result_set);

		return $result;
	}

	function create_new_subject($subject) {
		global $db;

		$errors = validate_subject($subject);

		if (!empty($errors)) {
			return $errors;
		}

		$sql = "INSERT INTO subjects ";
		$sql .= "(menu_name, position, visible) ";
		$sql .= "VALUES (";
		$sql .= "'" . db_escape($db, $subject['menu_name']) . "', ";
		$sql .= "'" . db_escape($db, $subject['position']) . "', ";
		$sql .= "'" . db_escape($db, $subject['visible']) . "')";

		$result = mysqli_query($db, $sql);

		if ($result) {
			return true;	
		} else {
			echo mysqli_error($db);
			db_disconnect($db);
			exit();
		}		
	}

	function delete_subject_by_id($id) {
		global $db;

		$sql = "DELETE FROM subjects ";
		$sql .= "WHERE id='" . db_escape($db, $id) . "' ";
		$sql .= "LIMIT 1";

		$result = mysqli_query($db, $sql);
		
		if ($result) {
			return true;
		} else {
			echo mysqli_error($db);
		}
	}

	function update_subject($subject) {
		global $db;

		$errors = validate_subject($subject);

		if (!empty($errors)) {
			return $errors;
		}

		$sql = "UPDATE subjects ";
		$sql .= "SET ";
		$sql .= "menu_name='" . db_escape($db, $subject['menu_name']) . "', ";
		$sql .= "position='" . db_escape($db, $subject['position']) . "', ";
		$sql .= "visible='" . db_escape($db, $subject['visible']) . "' ";
		$sql .= "WHERE id='" . db_escape($db, $subject['id']) . "' ";
		$sql .= "LIMIT 1";

		$result = mysqli_query($db, $sql);
		//confirm_update($result);
		return $result;
	}

	function count_subjects() {
		$count = mysqli_num_rows(find_all_subjects());
		return $count;
	}	

?>