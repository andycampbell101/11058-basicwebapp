<?php

// Code to state command to run after submit button is pressed

if (isset($_POST['submit'])) {

	// Include the file to understand connection to database
	require "../config.php";

	// Try/Catch Statement for running command
	try {

		// Connect to the database
		$connection = new PDO($dsn, $username, $password, $options);

		// Get the contents from the forms that information will have been entered by the user and store in array
		$new_game = array(
			"gamename" => $_POST['gamename'],
			"gameconsolebrand" => $_POST['gameconsolebrand'],
			"gameconsolename" => $_POST['gameconsolename'],
			"gameyear" => $_POST['gameyear'],
		);

		// Convert the array with the information provided into an SQL statement to then store the information in the database
		$sql = "INSERT INTO games (gamename, gameconsolebrand, gameconsolename, gameyear) VALUES (:gamename, :gameconsolebrand, :gameconsolename, :gameyear)";

		// Now we run the SQL statement to add the information to the database
		$statement = $connection->prepare($sql);
		$statement->execute($new_game);

	}

	// Add a statement if the code tried to run and was unsuccessful, spit out the error onto the screen
	catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}

}
?>

<?php include "templates/header.php"?>

	<h2>Add a game</h2>

<?php

	if (isset($_POST['submit']) && $statement) {

?>

	<p>Game successfully added to the catalogue.</p>

<?php 

	}

 ?>

 <!-- These are the forms which the information is going to be collected from -->

 <form method="post">
 	<label for="gamename">Name of the game</label>
 	<input type="text" name="gamename" id="gamename">

 	<label for="gameconsolebrand">Brand of console</label>
 	<select name="gameconsolebrand" id="gameconsolebrand">
 		<option>Select a brand</option>
 		<option value="Atari">Atari</option>
 		<option value="SEGA">SEGA</option>
 		<option value="Nintendo">Nintendo</option>
 		<option value="Microsoft">Microsoft</option>
 		<option value="Sony">Sony</option>
 		<option value="Other">Other</option>
 	</select>

 	<label for="gameconsolename">Console name</label>
 	<select name="gameconsolename" id="gameconsolename">
 		<option>Select a console</option>
 		<option value="Atari 2600">Atari 2600</option>
 		<option value="SEGA Genesis">SEGA Genesis</option>
 		<option value="Nintendo Game Boy/Game Boy Colour">Nintendo Game Boy/Game Boy Colour</option>
 		<option value="Nintendo Game Boy Advance">Nintendo Game Boy Advance</option>
 		<option value="Nintendo Entertainment System (NES)/NES Classic">Nintendo Entertainment System (NES)/NES Classic</option>
 		<option value="Super Nintendo Entertainment System (SNES)/SNES Classic">Super Nintendo Entertainment System (SNES)/SNES Classic</option>
 		<option value="Nintendo GameCube">Nintendo GameCube</option>
 		<option value="Nintendo DS">Nintendo DS</option>
 		<optoin value="Nintendo 3DS">Nintendo 3DS</optoin>
 		<option value="Nintendo Wii">Nintendo Wii</option>
 		<option value="Nintendo Wii U">Nintendo Wii U</option>
 		<option value="Nintendo Switch">Nintendo Switch</option>
 		<option value="Windows">Windows</option>
 		<option value="Xbox">Xbox</option>
 		<option value="Xbox 360">Xbox 360</option>
 		<option value="Xbox One">Xbox One</option>
 		<option value="PlayStation">PlayStation</option>
 		<option value="PlayStation 2">PlayStation 2</option>
 		<option value="PlayStation 3">PlayStation 3</option>
 		<option value="PlayStation 4">PlayStation 4</option>
 		<option value="PlayStation Portable (PSP)">PlayStation Portable (PSP)</option>
 		<option value="Mobile">Mobile</option>

 	</select>

 	<label for="gameyear">Year of release</label>
 	<select name="gameyear" id="gameyear">
 		<option>Select a year</option>
 		<option value="2019">2019</option>
 		<option value="2018">2018</option>
 		<option value="2017">2017</option>
 		<option value="2016">2016</option>
 		<option value="2015">2015</option>
 		<option value="2014">2014</option>
 		<option value="2013">2013</option>
 		<option value="2012">2012</option>
 		<option value="2011">2011</option>
 		<option value="2010">2010</option>
 		<option value="2009">2009</option>
 		<option value="2008">2008</option>
 		<option value="2007">2007</option>
 		<option value="2006">2006</option>
 		<option value="2005">2005</option>
 		<option value="2004">2004</option>
 		<option value="2003">2003</option>
 		<option value="2002">2002</option>
 		<option value="2001">2001</option>
 		<option value="2000">2000</option>
 		<option value="1999">1999</option>
 		<option value="1998">1998</option>
 		<option value="1997">1997</option>
 		<option value="1996">1996</option>
 		<option value="1995">1995</option>
 		<option value="1994">1994</option>
 		<option value="1993">1993</option>
 		<option value="1992">1992</option>
 		<option value="1991">1991</option>
 		<option value="1990">1990</option>
 		<option value="1989">1989</option>
 		<option value="1988">1988</option>
 		<option value="1987">1987</option>
 		<option value="1986">1986</option>
 		<option value="1985">1985</option>
 		<option value="1984">1984</option>
 		<option value="1983">1983</option>
 		<option value="1982">1982</option>
 		<option value="1981">1981</option>
 		<option value="1980">1980</option>
 		<option value="1979">1979</option>
 		<option value="1978">1978</option>
 		<option value="1977">1977</option>
 		<option value="1976">1976</option>
 		<option value="1975">1975</option>
 		<option value="1974">1974</option>
 		<option value="1973">1973</option>
 		<option value="1972">1972</option>
 		<option value="1971">1971</option>
 		<option value="1970">1970</option>
 	</select>

 	<input type="submit" name="submit" value="Submit">

 </form>

 <?php include "templates/footer.php"?>