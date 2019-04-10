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
	    		<td><b>Patronuses</b></td>
	    	</tr>

	    	<tr>
	    		<td><b>ID</b></td>
	    		<td><b>Form</b></td>	    		
	    	</tr>

	    <!--builds patronus table-->
		<?php 
			if (!($stmt = $mysqli->prepare("SELECT * FROM patronus GROUP BY patronus.id")))
			{
				echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
			}

			if (!($stmt->execute()))
			{
				echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}

			if (!($stmt->bind_result($id, $form)))
			{
				echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			while ($stmt->fetch())
			{
				echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $form . "\n</td>\n</tr>";
			}
			$stmt->close();
		?>
	    </table>
    </div>
<br>


<!-- add patronus -->
<div>
		<form method="post" action="addPatronus.php"> 
		    <fieldset>
		    	<legend>Add Patronus</legend>
		    	<p>Form: <input type="text" name="pForm" />
		    			    	
		    	<input type="submit" value = "Add Patronus"/></p>
		    </fieldset>
	    </form>
</div>
<br>

<!-- delete patronus -->
<div>
		<form method="post" action="deletePatronus.php"> 
		    <fieldset>
		    	<legend>Delete Patronus</legend>

		    	<!--patronus drop down-->
		    	<select name = "delPatronus">
				<?php
					if (!($stmt = $mysqli->prepare("SELECT id, form FROM patronus GROUP BY patronus.form")))
					{
						echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
					}

					if (!($stmt->execute()))
					{
						echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					if (!($stmt->bind_result($id, $pForm)))
					{
						echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while ($stmt->fetch())
					{
						echo '<option value=" ' . $id . ' "> ' . $pForm . '</option>\n';
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