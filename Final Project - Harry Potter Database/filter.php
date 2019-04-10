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
?>


<!DOCTYPE html>
<html>
<body>
	<div>
	    <table>
	    	<tr>
	    		<td><b>Master Table filtered by Class</b></td>
	    	</tr>

	    	<tr>
	    		<td><b>Name</b></td>
	    		<td><b>House</b></td>	
	    		<td><b>House Symbol</b></td>
	    		<td><b>Patronus</b></td>
	    		<td><b>Wand wood</b></td>
	    		<td><b>Wand core</b></td>
	    		<td><b>Wand length</b></td>
	    		<td><b>Class Name</b></td>
	    		<td><b>Instructor</b></td>
	    	</tr>

	    <!--Joins all tables where characters are enrolled in a given class, building a master table of students in that class-->
		<?php 
			if (!($stmt = $mysqli->prepare("SELECT characters.name, house.name, house.symbol, patronus.form, wand.wood, wand.core, wand.length, class.name, class.instructor FROM characters LEFT JOIN house ON characters.house_id = house.id LEFT JOIN patronus ON patronus.id = characters.patronus_id LEFT JOIN wand ON wand.id = characters.wand_id LEFT JOIN enrollment ON enrollment.student_id = characters.id LEFT JOIN class ON class.id = enrollment.class_id WHERE class.id = ? GROUP BY characters.name")))
			{
				echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
			}

			if (!($stmt->bind_param("i", $_POST['class'])))
			{
				echo "Bind failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
			}

			if (!($stmt->execute())){
				echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}

			if (!($stmt->bind_result($charname, $houseName, $houseSym, $pForm, $wood, $core, $length, $className, $instructor)))
			{
				echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			while ($stmt->fetch())
			{
				echo "<tr>\n<td>\n" . $charname . "\n</td>\n<td>\n" . $houseName . "\n</td>\n<td>\n" . $houseSym . "\n</td>\n<td>\n" . $pForm . "\n</td>\n<td>\n" . $wood . "\n</td>\n<td>\n" . $core . "\n</td>\n<td>\n" . $length . "\n</td>\n<td>\n" . $className . "\n</td>\n<td>\n" . $instructor . "\n</td></tr>";
			}
			$stmt->close();
		?>


	    </table>
    </div>
    
    <!--returns links-->
    <br>
	<a href="enrollment.php">Return to Enrollment Table</a>
	<br>
	<a href="home.php">Return to Home Page</a>
</body>
</html>