<!--
	Christian Roccanova
	CS 340-400
	Final Project
	Note: PHP code is based on that found in the week 7 lecture "Live PHP Coding Recording" and it's attached files.
-->

<?php
	// Turn on error reporting
	ini_set('display_errors', 'On');
	// Connects to the database
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "roccanoc-db", "odI9AAZ9XYrENbxi", "roccanoc-db");
	
	if (!$mysqli || $mysqli->connect_errno)
	{
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	//inserts new character based on form input
	if (!($stmt = $mysqli->prepare("INSERT INTO characters (name, house_id, patronus_id, wand_id) VALUES (?, ?, ?, ?)")))
	{
		echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
	}
	
	if (!($stmt->bind_param("siii", $_POST['charname'], $_POST['house'], $_POST["patronus"], $_POST['wand'])))
	{
		echo "Bind failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
	}
	
	if (!($stmt->execute()))
	{
		echo "Execute failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
	} 	
	else 
	{
		echo "Added " . $stmt->affected_rows . "row(s) to characters.";
	}
?>

<!--return links-->
<!DOCTYPE html>
<html>
<body>
	<br>
	<a href="character.php">Return to Character Table</a>
	<br>
	<a href="home.php">Return to Home Page</a>
</body>
</html>