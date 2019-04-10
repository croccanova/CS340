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
	    		<td><b>Wands</b></td>
	    	</tr>

	    	<tr>
	    		<td><b>ID</b></td>
	    		<td><b>Wood</b></td>
	    		<td><b>Core</b></td>
	    		<td><b>Length</b></td>
	    	</tr>

	    <!--builds wand table-->
		<?php 
			if (!($stmt = $mysqli->prepare("SELECT * FROM wand GROUP BY wand.id")))
			{
				echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
			}

			if (!($stmt->execute())){
				echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}

			if (!($stmt->bind_result($id, $wood, $core, $length)))
			{
				echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			while ($stmt->fetch())
			{
				echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $wood . "\n</td>\n<td>\n" . $core . "\n</td>\n<td>\n" . $length . "\n</td>\n</tr>";
			}
			$stmt->close();
		?>
	    </table>
    </div>
<br>


<!-- add wand -->
<div>
		<form method="post" action="addWand.php"> 
		    <fieldset>
		    	<legend>Add Wand</legend>
		    	<p>Wood: <input type="text" name="wood" />
		    	<p>Core: <input type="text" name="core" />
		    	<p>Length: <input type="text" name="length" />
		    	
		    	<input type="submit" value = "Add Wand"/></p>
		    </fieldset>
	    </form>
</div>
<br>

<!-- delete wand -->
<div>
		<form method="post" action="deleteWand.php"> 
		    <fieldset>
		    	<legend>Delete Wand</legend>

		    		<!--wand drop down-->
		    		<select name = "delWand">
					<?php
					if (!($stmt = $mysqli->prepare("SELECT id, wood, core, length FROM wand")))
					{
						echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
					}
					if (!($stmt->execute()))
					{
						echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if (!($stmt->bind_result($id, $wood, $core, $length)))
					{
						echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while ($stmt->fetch())
					{
						echo '<option value=" ' . $id . ' "> ' . $wood . ' > ' .  $core . ' > ' .  $length .'</option>\n';
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