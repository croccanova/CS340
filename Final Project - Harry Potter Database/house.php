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
	    		<td><b>Hogwarts Houses</b></td>
	    	</tr>

	    	<tr>
	    		<td><b>ID</b></td>
	    		<td><b>Name</b></td>
	    		<td><b>Symbol</b></td>
	    	</tr>

	    	<!--builds house table-->
			<?php 
				if (!($stmt = $mysqli->prepare("SELECT * FROM house GROUP BY house.id")))
				{
					echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
				}

				if (!($stmt->execute()))
				{
					echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				
				if (!($stmt->bind_result($id, $name, $symbol)))
				{
					echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while ($stmt->fetch())
				{
					echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n" . $name . "\n</td>\n<td>\n" . $symbol . "\n</td>\n</tr>";
				}
				$stmt->close();
			?>
	    </table>
    </div>
<br>


<!-- add house -->
<div>
		<form method="post" action="addHouse.php"> 
		    <fieldset>
		    	<legend>Add House</legend>
		    	<p>Name: <input type="text" name="houseName" />
		    	<p>Symbol: <input type="text" name="symName" />
		    	
		    	<input type="submit" value = "Add House"/></p>
		    </fieldset>
	    </form>
</div>
<br>

<!-- delete house -->
<div>
		<form method="post" action="deleteHouse.php"> 
		    <fieldset>
		    	<legend>Delete House</legend>

		    	<!--house drop down-->
		    	<select name = "houseName">
				<?php
					if (!($stmt = $mysqli->prepare("SELECT id, name FROM house GROUP BY house.name")))
					{
						echo "Prepare failed: " . $stmt->connect_errno . " " . $stmt->connect_error;
					}

					if (!($stmt->execute()))
					{
						echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}

					if (!($stmt->bind_result($id, $houseName)))
					{
						echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while ($stmt->fetch())
					{
						echo '<option value=" ' . $id . ' "> ' . $houseName . '</option>\n';
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