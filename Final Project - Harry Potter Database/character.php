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
	    		<td><b>Characters</b></td>
	    	</tr>

	    	<tr>
	    		<td><b>ID</b></td>
	    		<td><b>Name</b></td>
	    		<td><b>House_ID</b></td>
	    		<td><b>Patronus_ID</b></td>
	    		<td><b>Wand_ID</b></td>	    		
	    	</tr>

	    	<!--builds character table-->
			<?php 
				if (!($stmt = $mysqli->prepare("SELECT * FROM characters GROUP BY characters.id")))
				{
					echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
				}

				if (!($stmt->execute()))
				{
					echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}

				if (!($stmt->bind_result($id, $name, $house_id, $patronus_id, $wand_id)))
				{
					echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while ($stmt->fetch())
				{
					echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $name . "\n</td>\n<td>\n" . $house_id . "\n</td>\n<td>\n" . $patronus_id . "\n</td>\n<td>\n" . $wand_id . "\n</td>\n</tr>";
				}
				$stmt->close();
			?>
	    </table>
    </div>
<br>


<!-- add Character -->
<div>
		<form method="post" action="addCharacter.php"> 
		    <fieldset>
		    	<legend>Add Character</legend>
		    	<p>Name: <input type="text" name="charname" /></p>
				<p>Houses: 
					<!--house drop down-->
					<select name = "house">
					<?php
						if (!($stmt = $mysqli->prepare("SELECT id, name FROM house")))
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
				</p> 

				<p>Patronuses: 
					<!--patronus drop down-->
					<select name = "patronus">
					<?php
						if (!($stmt = $mysqli->prepare("SELECT id, form FROM patronus")))
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
				</p>

				<p>Wands: 
					<!--wand drop down-->
					<select name = "wand">
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
				</p> 

				 

		    <p><input type="submit" value = "Add Character"/></p>
		    </fieldset>
	    </form>
</div>
<br>

<!-- delete character -->
<div>
		<form method="post" action="deleteChar.php"> 
		    <fieldset>
		    	<legend>Delete Character</legend>

		    	<!--character drop down-->
		    	<select name = "charname">
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
		    <input type="submit" value = "Delete" />
		    </fieldset>
	    </form>
</div>




</body>
</html>