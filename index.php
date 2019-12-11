<?php

$server_name = "localhost";
$database_name = "sensordb";
$table_name = "sensor_data";
$connection_string = "mysql:host=$server_name;dbname=$database_name";

$username = "Logan";
$password = "Trailrider@1";

$connection = new PDO($connection_string, $username, $password);

$sql = "SELECT * FROM sensor_data";

$records = $connection->query($sql);


// Create the table and first row manually
$table = "<table>";
$table .= "<caption>Hiking Data</caption>";
$table .= "<tr>";
$table .="<th scope=\"col\">id</th>";
$table .="<th scope=\"col\">temperature</th>";
$table .="<th scope=\"col\">pressure</th>";
$table .="<th scope=\"col\">humidity</th>";
$table .="<th scope=\"col\">altitude</th>";

$table .="</tr>";





//...etc.


// Each record is a new table row
foreach( $records as $row )
{
    

    
    $table .= "<tr>";
    $table .= "<th scope=\"row\">";
    $table .= $row["id"];
    $table .= "</th>";
    
    
     
    $table .= "<td>";
    $table .= $row["temperature"];
    $table .= "</td>";
    
      
    $table .= "<td>";
    $table .= $row["pressure"];
    $table .= "</td>";
    
      
    $table .= "<td>";
    $table .= $row["humidity"];
    $table .= "</td>";


    $table .= "<td>";
    $table .= $row["altitude"];
    $table .= "</td>";




    $table .= "</tr>";
    

    
}

// Close table tag
$table .= "</table>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hkiking Stats</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	
	<link rel="stylesheet" href="css/styles.css">	
	<h1>Hiking Data</h1>

	

	
<code>
<pre>

	
</pre>
</code>

	<h2>Table</h2>

	<?php echo($table) ?>
	
</body>
</html>

