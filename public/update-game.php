<?php 
    // include the config file that we created last week
    require "../config.php";
    require "common.php";
    // run when submit button is clicked
    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);  
            
            //grab elements from form and set as varaible
            $game =[
              "id"         => $_POST['id'],
              "gamename" => $_POST['gamename'],
              "gameconsolebrand"  => $_POST['gameconsolebrand'],
              "gameconsolename"   => $_POST['gameconsolename'],
              "gameyear"   => $_POST['gameyear'],
            ];
            
            // create SQL statement
            $sql = "UPDATE `games` 
                    SET id = :id, 
                        gamename = :gamename, 
                        gameconsolebrand = :gameconsolebrand, 
                        gameconsolename = :gameconsolename, 
                        gameyear = :gameyear
                    WHERE id = :id";
            //prepare sql statement
            $statement = $connection->prepare($sql);
            
            //execute sql statement
            $statement->execute($game);
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
    // GET data from DB
    //simple if/else statement to check if the id is available
    if (isset($_GET['id'])) {
        //yes the id exists 
        
        try {
            // standard db connection
            $connection = new PDO($dsn, $username, $password, $options);
            
            // set if as variable
            $id = $_GET['id'];
            
            //select statement to get the right data
            $sql = "SELECT * FROM games WHERE id = :id";
            
            // prepare the connection
            $statement = $connection->prepare($sql);
            
            //bind the id to the PDO id
            $statement->bindValue(':id', $id);
            
            // now execute the statement
            $statement->execute();
            
            // attach the sql statement to the new work variable so we can access it in the form
            $game = $statement->fetch(PDO::FETCH_ASSOC);
            
        } catch(PDOExcpetion $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    } else {
        // no id, show error
        echo "No id - something went wrong";
        //exit;
    };
?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<p>Game successfully updated.</p>
<?php endif; ?>

<h2>Edit a work</h2>

<form method="post">

    <label class="id" for="id">Game Name</label>
    <input type="text" name="id" class="id" value="<?php echo escape($game['id']); ?>">

    
    <label for="gamename">Game Name</label>
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