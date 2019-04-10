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
	// Checks for connection error
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
	    		<!--navigation bar-->
	    		<td><a href="home.php">Home Page</a></td>
	    		<td><a href="character.php">Character Table</a></td>
	    		<td><a href="class.php">Class Table</a></td>
	    		<td><a href="enrollment.php">Enrollment Table</a></td>
	    		<td><a href="house.php">House Table</a></td>
	    		<td><a href="patronus.php">Patronus Table</a></td>
	    		<td><a href="wand.php">Wand Table</a></td>
	    	<tr>
	    		<td><b>Master Table</b></td>
	    	</tr>

	    	<tr>
	    		
	    		<td><b>Name</b></td>
	    		<td><b>House</b></td>	
	    		<td><b>House Symbol</b></td>
	    		<td><b>Patronus</b></td>
	    		<td><b>Wand wood</b></td>
	    		<td><b>Wand core</b></td>
	    		<td><b>Wand length</b></td>
	    		
	    	</tr>

	    <!--builds master table-->
		<?php 
			if (!($stmt = $mysqli->prepare("SELECT characters.name, house.name, house.symbol, patronus.form, wand.wood, wand.core, wand.length FROM characters LEFT JOIN house ON characters.house_id = house.id LEFT JOIN enrollment ON enrollment.student_id = characters.id LEFT JOIN class ON class.id = enrollment.class_id LEFT JOIN patronus ON patronus.id = characters.patronus_id LEFT JOIN wand ON wand.id = characters.wand_id GROUP BY characters.name")))
			{
				echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
			}

			if (!($stmt->execute())){
				echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}

			if (!($stmt->bind_result($charname, $houseName, $houseSym, $pForm, $wood, $core, $length)))
			{
				echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			while ($stmt->fetch())
			{
				echo "<tr>\n<td>\n" . $charname . "\n</td>\n<td>\n" . $houseName . "\n</td>\n<td>\n" . $houseSym . "\n</td>\n<td>\n" . $pForm . "\n</td>\n<td>\n" . $wood . "\n</td>\n<td>\n" . $core . "\n</td>\n<td>\n" . $length . "\n</td>\n</tr>";
			}
			$stmt->close();
		?>
	    </table>
    </div>
<br>


<!-- add character -->
<div>
		<form method="post" action="addCharacter.php"> 
		    <fieldset>
		    	<legend>Add Character</legend>
		    	<!--name text input box-->
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
		    	
				<!--name drop down-->
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



<!-- update patronus form -->
<div>
		<form method="post" action="charUpdate.php"> 
		    <fieldset>
		    	<legend>Update Character's Patronus Animal</legend>
		    	
		    	<!--name drop down-->
		    	<select name = "name">
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
		    <input type="submit" value = "Update Patronus" />
		    </fieldset>
	    </form>
</div>

</body>
</html>