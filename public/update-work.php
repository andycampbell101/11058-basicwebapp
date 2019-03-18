<?php

	// Include files to help conenct to the database and solve errors
	require "../config.php";
	require "common.php";

	// Run the command when the submit button is pressed
	if (isset($_POST['submit'])) {
		try {

			// Connect to the database
			$connection = new PDO($dsn, $username, $password, $options);

			$game =[
				"id" => $_POST['id'],
				"gamename" => $_POST['gamename'],
				"gameconsolebrand" => $_POST['gameconsolebrand'],
				"gameconsolename" => $_POST['gameconsolename'],
				"gameyear" => $_POST['gameyear'],
			];

			// Create the SQl statement to be run
			$sql = "UPDATE `games`
				SET id = :id,
					gamename = :gamename,
					gameconsolebrand = :gameconsolebrand,
					gameconsolename = :gameconsolename,
					gameyear = :gameyear,
					WHERE id = :id";

			// Prepare the SQL statement to be run
			$statement = $connection->prepare($sql);

			// Execute the SQL statement to be run into the database
			$statement->$execute($game);

		}

		// Add a statement if the code tried to run and was unsuccessful, spit out the error onto the screen
		catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	}

	// Code to pull the data from the database to be changed
	if (isest($_GET['id'])) {
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
			$statement->bind_value(':id', $id);

			// Execute the SQL statement
			$statement->$execute;

			// Use the SQL statement to fill the contents of the form with info from the database
			$game = $connection->$fetch(PDO::FETCH_ASSOC);

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
	<p>Work successfully updated.</p>
<?php endif; ?>

	<h2>Edit a work</h2>

		<form method="post">
		    
		    <label for="id">ID</label>
		    <input type="text" name="id" id="id" value="<?php echo escape($work['id']); ?>" >
		    
		    <label for="gamename">Artist Name</label>
		    <input type="text" name="gamename" id="gamename" value="<?php echo $work['gamename']; ?>">

		    <label for="gameconsolebrand">Work Title</label>
		    <input type="text" name="gameconsolebrand" id="gameconsolebrand" value="<?php echo $work['gameconsolebrand']; ?>">

		    <label for="gameconsolename">Work Date</label>
		    <input type="text" name="gameconsolename" id="gameconsolename" value="<?php echo $work['gameconsolename']; ?>">

		    <label for="gameyear">Work Type</label>
		    <input type="text" name="gameyear" id="gameyear" value="<?php echo $work['gameyear']; ?>">

		    <input type="submit" name="submit" value="Save">

		</form>