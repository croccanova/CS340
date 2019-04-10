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
		
	//UPDATE syntax as per example at https://www.w3schools.com/sql/sql_update.asp	
	if(!($stmt = $mysqli->prepare("UPDATE characters SET patronus_id = ? WHERE id = ?")))
	{
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt->bind_param("ii",$_POST['patronus'], $_POST['name'])))
	{
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute())
	{
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} 
	else 
	{
		echo "Updated " . $stmt->affected_rows . " row(s) on characters.";
	}
?>