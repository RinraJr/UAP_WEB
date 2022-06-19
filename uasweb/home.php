<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">

		<?php
		include 'functions.php';
		// Your PHP code here.

		// Home Page template below.
		?>

		<?=template_header('Home')?>

		<div class="content">
			<h2>Home</h2>
			<p>Welcome to the home page!</p>
		</div>

		<?=template_footer()?>
	</body>
</html>

