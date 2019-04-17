<?php


	require "..config.php";

	session_start();

	if(isset($_POST['login'])) {

		try {

			$connection = new PDO($dsn, $username, $password, $options);

			$username = $_POST['username'];

			$password = $_POST['password'];

			if($username == ''){
				$errMsg = 'No username was defined';
			}

			if($password == ''){
				$errMsg = 'No password was defined';
			}

			if($errMsg == ''){

				$sql = 'SELECT id, username, password FROM users WHERE username = :username AND password = :password';

				$statement->bindParam(':username', $username);

				$statement->bindParam(':password', $password);

				$statement = $connection->prepare($sql);

				$statement->execute();

				$result = $statement->fetchAll();

				if($statement->rowCount == '1') {
					header('location:index.php');
				}

				else{
					$errMsg = 'Incorrect Username/Password entered';
				}
			}

			
		}
		
		catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	}

?>

<html>
	<body>
		<form method="post" action="login.php">
			Username:<br>
			<input type="text" name="username"><br>
			Password<br>
			<input type="password" name="password"><br>
			<input type="submit" value="Login">
		</form>
	</body>
</html>