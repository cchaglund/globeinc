<?php

  function validate_email($email) {
  	if (!has_valid_email_format($email)) {
  		$errors['login'] = "Not a valid email format";
  	}

    return $errors;
  }

  function validate_password($pass) {
  	if (!has_length($pass, ['min' => 8])) {
  		$errors['login'] = "Passwords must be at least 8 characters long";
  	}

    return $errors;
  }

  function validate_subject($subject) {
    if (!has_presence($subject['menu_name'])) {
      $errors['menu_name'] = "Menu name can't be left blank";
    } elseif ( !has_length($subject['menu_name'], ['min' => 2, 'max' => 255]) ) {
      $errors['menu_name'] = "Menu name must be between 2 and 255 characters";
    }

    $current_id = $subject['id'] ?? "0";
    if (!has_unique_subject_menu_name($subject['menu_name'], $current_id)) {
      $errors['menu_name'] = "Subject with this name already exists. Choose new unique name.";
    }

    $position_int = (int) $subject['position'];
    if ( !has_length($subject['position'], ['min' => 1, 'max' => 999]) ) {
      $errors['position'] = "Position must be between 1 and 999";
    }

    $visible_str = (string) $subject['visible'];
    if (!has_inclusion_of($visible_str, ["0","1"])) {
      $errors['visible'] = "Visible must be true or false";
    }

    return $errors;
  }

    function validate_page($page) {
      if (!has_presence($page['menu_name'])) {
        $errors['menu_name'] = "Menu name can't be left blank";
      } elseif ( !has_length($page['menu_name'], ['min' => 2, 'max' => 255]) ) {
        $errors['menu_name'] = "Menu name must be between 2 and 255 characters";
      }

      $current_id = $page['id'] ?? "0"; 
      if (!has_unique_page_menu_name($page['menu_name'], $current_id)) {
        $errors['menu_name'] = "Page with this name already exists. Choose new unique name.";
      }

      $position_int = (int) $page['position'];
      if ( !has_length($page['position'], ['min' => 1, 'max' => 999]) ) {
        $errors['position'] = "Position must be between 1 and 999";
      }

      $visible_str = (string) $page['visible'];
      if (!has_inclusion_of($visible_str, ["0","1"])) {
        $errors['visible'] = "Visible must be true or false";
      }

      return $errors;
  }

  function has_unique_page_menu_name($menu_name, $current_id="0") {
    global $db;

    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE menu_name='" . db_escape($db, $menu_name) . "' ";
    $sql .= "AND id != '" . db_escape($db, $current_id) . "'";
  
    $result_set = mysqli_query($db, $sql);
    $count = mysqli_num_rows($result_set);
    mysqli_free_result($result_set);
   
    return $count === 0;
  }

  function has_unique_subject_menu_name($menu_name, $current_id="0") {
    global $db;

    $sql = "SELECT * FROM subjects ";
    $sql .= "WHERE menu_name='" . db_escape($db, $menu_name) . "' ";
    $sql .= "AND id != '" . db_escape($db, $current_id) . "'";

    var_dump($result_set);
    $result_set = mysqli_query($db, $sql);
    $count = mysqli_num_rows($result_set);
    mysqli_free_result($result_set);

    return $count === 0;
  }

  // is_blank('abcd')
  // * validate data presence
  // * uses trim() so empty spaces don't count
  // * uses === to avoid false positives
  // * better than empty() which considers "0" to be empty
  function is_blank($value) {
    return !isset($value) || trim($value) === '';
  }

  // has_presence('abcd')
  // * validate data presence
  // * reverse of is_blank()
  // * I prefer validation names with "has_"
  function has_presence($value) {
    return !is_blank($value);
  }

  // has_length_greater_than('abcd', 3)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
  }

  // has_length_less_than('abcd', 5)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
  }

  // has_length_exactly('abcd', 4)
  // * validate string length
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length_exactly($value, $exact) {
    $length = strlen($value);
    return $length == $exact;
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  // * validate string length
  // * combines functions_greater_than, _less_than, _exactly
  // * spaces count towards length
  // * use trim() if spaces should not count
  function has_length($value, $options) {
    if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
      return false;
    } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
      return false;
    } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // has_inclusion_of( 5, [1,3,5,7,9] )
  // * validate inclusion in a set
  function has_inclusion_of($value, $set) {
  	return in_array($value, $set);
  }

  // has_exclusion_of( 5, [1,3,5,7,9] )
  // * validate exclusion from a set
  function has_exclusion_of($value, $set) {
    return !in_array($value, $set);
  }

  // has_string('nobody@nowhere.com', '.com')
  // * validate inclusion of character(s)
  // * strpos returns string start position or false
  // * uses !== to prevent position 0 from being considered false
  // * strpos is faster than preg_match()
  function has_string($value, $required_string) {
    return strpos($value, $required_string) !== false;
  }

  // has_valid_email_format('nobody@nowhere.com')
  // * validate correct format for email addresses
  // * format: [chars]@[chars].[2+ letters]
  // * preg_match is helpful, uses a regular expression
  //    returns 1 for a match, 0 for no match
  //    http://php.net/manual/en/function.preg-match.php
  function has_valid_email_format($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
  }

?>
