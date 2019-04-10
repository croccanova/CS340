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
	    		<td><a href="home.php">Home Page</a></td>
	    		<td><a href="character.php">Character Table</a></td>
	    		<td><a href="class.php">Class Table</a></td>
	    		<td><a href="enrollment.php">Enrollment Table</a></td>
	    		<td><a href="house.php">House Table</a></td>
	    		<td><a href="patronus.php">Patronus Table</a></td>
	    		<td><a href="wand.php">Wand Table</a></td>
	    	<tr>
	    		<td><b>Enrollment</b></td>
	    	</tr>

	    	<tr>
	    		<td><b>Student</b></td>
	    		<td><b>Class</b></td>
	    	</tr>

	    <!--builds enrollment table-->
		<?php 
			if (!($stmt = $mysqli->prepare("SELECT characters.name, class.name FROM characters LEFT JOIN enrollment ON characters.id = enrollment.student_id LEFT JOIN class ON enrollment.class_id = class.id")))
			{
				echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
			}

			if (!($stmt->execute()))
			{
				echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}

			if (!($stmt->bind_result($student, $course)))
			{
				echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			while ($stmt->fetch())
			{
				echo "<tr>\n<td>\n" . $student . "\n</td>\n<td>\n" . $course . "\n</td>\n</tr>";
			}
			$stmt->close();
		?>
	    </table>
    </div>
<br>


<!-- filter by class -->
	<div>
		<form method="post" action="filter.php">
			<fieldset>
				<legend>Filter By Class</legend>

					<!--class drop down-->
					<select name = "class">
						<?php
							if (!($stmt = $mysqli->prepare("SELECT id, name FROM class")))
							{
								echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
							}

							if (!($stmt->execute()))
							{
								echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}

							if (!($stmt->bind_result($id, $className)))
							{
								echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
							}
							while ($stmt->fetch())
							{
								echo '<option value=" ' . $id . ' "> ' . $className . '</option>\n';
							}
							$stmt->close();
						?>			
				</select>
			<input type = "submit" value = "Filter" />
			</fieldset>
		</form>
	</div>
<br>


<!-- add enrollment -->
<div>
		<form method="post" action="addEnrollment.php"> 
		    <fieldset>
		    	<legend>Add  a Class to  a Student</legend>

		    	<!--character drop down-->
		    	<select name = "Student">
					<?php
						if (!($stmt = $mysqli->prepare("SELECT id, name FROM characters GROUP BY characters.name")))
						{
							echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
						}
						if (!($stmt->execute()))
						{
							echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						if (!($stmt->bind_result($id, $charname)))
						{
							echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						while ($stmt->fetch())
						{
							echo '<option value=" ' . $id . ' "> ' . $charname . '</option>\n';
						}
						$stmt->close();
					?>			
				</select>

				<!--class drop down-->
				<select name = "Class">
					<?php
						if (!($stmt = $mysqli->prepare("SELECT id, name FROM class")))
						{
							echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
						}

						if (!($stmt->execute()))
						{
							echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if (!($stmt->bind_result($id, $className)))
						{
							echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}						
						while ($stmt->fetch())
						{
							echo '<option value=" ' . $id . ' "> ' . $className . '</option>\n';
						}
						$stmt->close();
					?>			
				</select> 
		    <input type="submit" value = "Add Class" />
		    </fieldset>
	    </form>
</div>

<!-- delete enrollment -->
<div>
		<form method="post" action="deleteEnrollment.php"> 
		    <fieldset>
		    	<legend>Delete Enrollment</legend>

		    	<!--character drop down-->
		    	<select name = "delStudent">
					<?php
						if (!($stmt = $mysqli->prepare("SELECT id, name FROM characters GROUP BY characters.name")))
						{
							echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
						}
						if (!($stmt->execute()))
						{
							echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						if (!($stmt->bind_result($id, $charname)))
						{
							echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						while ($stmt->fetch())
						{
							echo '<option value=" ' . $id . ' "> ' . $charname . '</option>\n';
						}
						$stmt->close();
					?>			
				</select>

				<!--class drop down-->
		    	<select name = "delClass">
					<?php
						if (!($stmt = $mysqli->prepare("SELECT id, name FROM class GROUP BY class.name")))
						{
							echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
						}

						if (!($stmt->execute()))
						{
							echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}

						if (!($stmt->bind_result($id, $className)))
						{
							echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						while ($stmt->fetch())
						{
							echo '<option value=" ' . $id . ' "> ' . $className . '</option>\n';
						}
						$stmt->close();
					?>			
				</select>
		    <input type="submit" value = "Delete" />
		    </fieldset>
	    </form>
</div>

</body>
</html>