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

	// Deletes class selected from drop down menu
	if (!($stmt = $mysqli->prepare("DELETE FROM class WHERE class.id = ?")))
	{
		echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
	}
	if (!($stmt->bind_param("i", $_POST['delClass']))){
		echo "Bind failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
	}

	if (!($stmt->execute()))
	{
		echo "Execute failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
	} else 
	{
		echo "Deleted " . $stmt->affected_rows . "row(s) from class.";
	}
?>

<!--return link to previos page-->
<!DOCTYPE html>
<html>
<body>
	<br>
	<a href="class.php">Return to Table</a>
</body>
</html>