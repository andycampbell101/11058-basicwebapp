<?php

	// Include files to help conenct to the database and solve errors
	require "../config.php";
	require "common.php";

	// Run the command when the submit button is pressed
	if (isset($_POST['submit'])) {
		try {

			// Connect to the database
			$connection = new PDO($dsn, $username, $password, $options);

			// Grab the elements from the forms and turn them into variables
			$game =[
				"id" 				=> $_POST['id'],
				"gamename" 			=> $_POST['gamename'],
				"gameconsolebrand" 	=> $_POST['gameconsolebrand'],
				"gameconsolename"	=> $_POST['gameconsolename'],
				"gameyear"			=> $_POST['gameyear'],
			];

			// Create the SQl statement to be run
			$sql = "UPDATE games
				SET id = :id,
					gamename = :gamename,
					gameconsolebrand = :gameconsolebrand,
					gameconsolename = :gameconsolename,
					gameyear = :gameyear
					WHERE id = :id";

			// Prepare the SQL statement to be run
			$statement = $connection->prepare($sql);

			// Execute the SQL statement to be run into the database
			$statement->execute($game);

		}

		// Add a statement if the code tried to run and was unsuccessful, spit out the error onto the screen
		catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	}

	// Code to pull the data from the database to be changed
	if (isset($_GET['id'])) {
		try {

			// Connect to the database
			$connection = new PDO($dsn, $username, $password, $options);

			// Set the ID as a variable
			$id = $_GET['id'];

			// Create a SQL statement to pull the correct data
			$sql = 'SELECT * FROM games WHERE id = :id';

			// Prepare the SQL statement to be run
			$statement = $connection->prepare($sql);

			// Bind the ID to the PDO ID
			$statement->bindValue(':id', $id);

			// Execute the SQL statement
			$statement->execute();

			// Use the SQL statement to fill the contents of the form with info from the database
			$game = $statement->fetch(PDO::FETCH_ASSOC);

		}

		// Add a statement if the code tried to run and was unsuccessful, spit out the error onto the screen
		catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}

	}

	// Throw in an else statement if the website cannot perform the operation
	else {
		echo "No ID -- something went wrong";
	};

?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<p>Game successfully updated.</p>
<?php endif; ?>

	<h2>Edit a game</h2>

		<form method="post">
		    
		    <label for="gamename">Game name</label>
		    <input type="text" name="gamename" id="gamename" value="<?php echo escape($game['gamename']); ?>">

		    <label for="gameconsolebrand">Brand</label>
		    <input type="text" name="gameconsolebrand" id="gameconsolebrand" value="<?php echo escape($game['gameconsolebrand']); ?>">

		    <label for="gameconsolename">Console</label>
		    <input type="text" name="gameconsolename" id="gameconsolename" value="<?php echo escape($game['gameconsolename']); ?>">

		    <label for="gameyear">Year</label>
		    <input type="text" name="gameyear" id="gameyear" value="<?php echo escape($game['gameyear']); ?>">

		    <input type="submit" name="submit" value="Save">

		</form>

<?php include "templates/footer.php"; ?>