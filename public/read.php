<?php 

// this code will only execute after the submit button is clicked
if (isset($_POST['submit'])) {
	
    // include the config file that we created before
    require "../config.php"; 
    
    // this is called a try/catch statement 
	try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Create the SQL 
        $sql = "SELECT * FROM games";
        
        // THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        // FOURTH: Put it into a $result object that we can access in the page
        $result = $statement->fetchAll();

	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	
}
?>

<?php include "templates/header.php"?>

<?php  
    if (isset($_POST['submit'])) {
        //if there are some results
        if ($result && $statement->rowCount() > 0) { ?>
<h2>Results</h2>

<?php 
                // This is a loop, which will loop through each result in the array
                foreach($result as $row) { 
            ?>

<p>
    ID:
    <?php echo $row["id"]; ?><br> Game Name:
    <?php echo $row['gamename']; ?><br> Game Brand:
    <?php echo $row['gameconsolebrand']; ?><br> Console:
    <?php echo $row['gameconsolename']; ?><br> Year:
    <?php echo $row['gameyear']; ?><br>
</p>
<?php 
                            // this willoutput all the data from the array
                            //echo '<pre>'; var_dump($row); 
                        ?>

<hr>
<?php }; //close the foreach
        }; 
    }; 
?>

<form method="post">

	<input type="submit" name="submit" value="View all">

</form>

<?php include "templates/footer.php"?>

