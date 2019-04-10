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
	if ($mysqli->connect_errno)
	{
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
		
	//inserts new enrollment based on form input	
	if(!($stmt = $mysqli->prepare("INSERT INTO enrollment (student_id, class_id) VALUES (?, ?)")))
	{
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt->bind_param("ii",$_POST['Student'], $_POST['Class'])))
	{
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute())
	{
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} 
	else 
	{
		echo "Updated " . $stmt->affected_rows . " row(s) on enrollment.";
	}
?>

<!--return link-->
<!DOCTYPE html>
<html>
<body>
	<br>
	<a href="enrollment.php">Return to Table</a>
</body>
</html>