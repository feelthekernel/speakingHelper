<?php
	date_default_timezone_set('Europe/Istanbul');
	$server = "localhost";
	$username = "yourusename";
	$password = "yourpassword";
	$dbname = "speaking";

	// Create connection
	$mysqli = new mysqli($server, $username, $password, $dbname);

	// Check connection
	if ($mysqli->connect_errno) {
		die( "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
	}
	/* change character set to utf8 */
	if (!$mysqli->set_charset("utf8")) {
		printf("Error loading character set utf8: %s\n", $mysqli->error);
		exit();
	}
	?>
