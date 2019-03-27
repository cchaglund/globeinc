<?php 
	if (!isset($page_title)) {
		$page_title = "Globe Inc.";
	} else {
		$page_title = h($page_title);
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php h($page_title) ?></title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" type="text/css" href="css/style.css">

		<!-- Bootstrap core CSS -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	    <!-- Fonts -->
	    <link href="https://fonts.googleapis.com/css?family=Averia+Libre|Averia+Serif+Libre|Cabin:400,400i,700,700i|IBM+Plex+Sans|Josefin+Sans|Major+Mono+Display|Nunito:400,400i,700,700i|Pacifico|Permanent+Marker|Philosopher|Poppins|Raleway|Staatliches|VT323|Viga" rel="stylesheet">
	    
	    <!-- Icons -->
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

	    <!-- Custom styles for this template -->
	    <link href="<?php echo WWW_ROOT . "/stylesheets/staff.css" ?>" rel="stylesheet">
	</head>
	<body>

		<header>
			<div id="top">
				<div id="logo">
					<h3>Globe Inc.</h3>	
				</div>
				

				<h1 id="banner_text">Staff</h1>
			</div>

			<navigation id="staff_nav">

				<h5><a class="nav_link" href="<?php echo WWW_ROOT . '/staff/index.php' ?>">Menu</a></h5>
				<h5><a class="nav_link" href="<?php echo WWW_ROOT . '/staff/subjects/index.php' ?>">Subjects</a></h5>
				<h5><a class="nav_link" href="<?php echo WWW_ROOT . '/staff/pages/index.php' ?>">Pages</a></h5>

				<div class="user_session_toolbar">
					<span id="user_email"><?php echo $_SESSION['email'] ?? ''; ?></span>
					<?php if (isset($_SESSION['email'])) { ?>
						<a href="<?php echo url_to("/staff/logout.php"); ?>">Logout</a>
					<?php } ?>
				</div>

			</navigation>

		</header>

		<main>