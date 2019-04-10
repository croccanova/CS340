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
		
	//inserts new house based on form input	
	if(!($stmt = $mysqli->prepare("INSERT INTO house (name, symbol) VALUES (?, ?)")))
	{
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt->bind_param("ss",$_POST['houseName'], $_POST['symName'])))
	{
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute())
	{
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} 
	else 
	{
		echo "Added " . $stmt->affected_rows . " row(s) to house.";
	}
?>

<!--return link-->
<!DOCTYPE html>
<html>
<body>
	<br>
	<a href="house.php">Return to Table</a>
</body>
</html>