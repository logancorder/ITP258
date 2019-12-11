<?php
	// Check to make sure all the required fields are in the $_POST array,
	//	which also checks to make sure the form was used to access this page.
	$required_fields = ["temperature", "pressure", "humidity", "altitude"];
	$error = false;
	foreach($required_fields as $field)
	{
		// isset() checks if the name was found, strlen(trim()) checks for
		// empty fields (whitespace only)
		if(!isset($_POST[$field]) || strlen(trim($_POST[$field])) == 0)
			$error = true;
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Post  page</title>
</head>
<body>

	<?php
	if($error)
	{
		echo("<p>Sorry, please go back and try again.</p>");
	}
	else
	{
		// NOTE: In production code you would do rigorous
		// validation checking here.
		$temperature = trim($_POST["temperature"]);
		$pressure = trim($_POST["pressure"]);
		$humidity = trim($_POST["humidity"]);
		$altitude = trim($_POST["altitude"]);

		


		// We can do better than putting our db info directly in the
		// script! Consider using an include file outside the web root.
		$hostname = "localhost";
		$username = "Logan";
		$password = "Trailrider@1";
		$dbname = "sensordb";
		$connection_string = "mysql:host=$hostname;dbname=$dbname";

		// connect to the database
		$connection = new PDO($connection_string, $username, $password);
		// set error code attribute to throw exceptions
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// the question marks are placeholders in our prepared statement.
		// using prepared statements protects against SQL injection
		$sql = "INSERT INTO sensor_data(temperature, pressure, humidity, altitude)";
		$sql .= "VALUES(?, ?, ?, ?)";


		// Use try/catch for exception handling. All sorts of things could
		// go wrong and we need detailed error messages in development,
		// and the ability to gracefully fail in production.
		try
		{
			$statement = $connection->prepare($sql);
			$statement->execute(array($temperature, $pressure, $humidity, $altitude));
			echo("<h1>Data Added!</h1>");
		}
		catch(PDOException $e)
		{
			echo("<h1>Error!</h1><p>" . $e->getMessage() . "</p>");
		}
	}
	?>

	<a href="form.html">Back</a>
</body>
</html>
