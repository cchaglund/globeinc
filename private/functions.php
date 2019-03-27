<?php 

function u($string="") {
	return urlencode($string);
}

function h($string="") {
	return htmlspecialchars($string);
}

function url_to($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

function redirect_to($location) {
	header("Location: " . $location);
	exit();
}

function is_post_request() {
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}

 function display_errors($field) {
    global $errors;
    if (!empty($errors)) {
      return h($errors[$field]);
    }
  }