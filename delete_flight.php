<?php

// Connection parameters
$host = 'cspp53001.cs.uchicago.edu';
$username = 'kiranbaktha';
$password = 'rij3iaTh';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
print 'Connected successfully!<br>';

$fnumber = $_REQUEST['fnumber'];

$query1 = "SELECT * FROM FLIGHTS_SCHEDULE WHERE FLIGHTNUMBER = '$fnumber'";
$result1 = mysqli_query($dbcon, $query1)
	or die('Query failed: ' . mysqli_error($dbcon));
$countrows = mysqli_num_rows($result1);


//Check if the ticket acutally existed
if($countrows==0){
print "I'm sorry the flight number entered does not belong to the database!";
}
else{


$query2 = "DELETE FROM FLIGHTS_SCHEDULE WHERE FLIGHTNUMBER = '$fnumber'";

$result2 = mysqli_query($dbcon, $query2)
	or die('Query failed: ' . mysqli_error($dbcon));


//Delete from relation table as well
$query_ = "DELETE FROM FROM_ WHERE FLIGHTNUMBER = '$fnumber'";

$result_ = mysqli_query($dbcon, $query_)
	or die('Query failed: ' . mysqli_error($dbcon));

print "The flight has been successfully deleted!";
echo nl2br("\n");
print "The Data in FLIGHTS_SCHEDULE Table is now:";
echo nl2br("\n");
echo nl2br("\n");
$query3 = "SELECT * FROM FLIGHTS_SCHEDULE";

$result3 = mysqli_query($dbcon, $query3)
	or die('Query failed: ' . mysqli_error($dbcon));


echo "<table>
    		<tr>
    		<th>FLIGHT_NUMBER</th><th>FLIGHT_OPERATOR</th> <th>PRICE</th>
			<th>ORIGIN</th> <th>DESTINATION</th>
			<th>TRAVEL_TIME</th> <th>DEPARTURE_DATE_AND_TIME</th>
			<th>ARRIVAL_DATE_AND_TIME</th><th>NUMBER_OF_STOPS</th>
			</tr>";
    // output data of each row
    	while($row = $result3->fetch_assoc()) {
        	echo "<tr><td>"
         	. $row["FLIGHTNUMBER"]. "</td><td>" . $row["FLIGHTOPERATOR"]. "</td><td>"
         	. $row["PRICE"]. "</td><td>" . $row["ORIGIN"]. "</td><td>"
         	. $row["DESTINATION"]. "</td><td>" . $row["TRAVELTIME"]. "</td><td>". $row["DEPARTUREDATEANDTIME"]. "</td><td>". $row["ARRIVALDATEANDTIME"]. "</td><td>". $row["NUMBEROFSTOPS"]. "</td><td>" ;
    		}
    	echo "</table><hr>";


echo nl2br("\n");
print "The Data in the relation table FROM_ is now:";
echo nl2br("\n");
$query5 = "SELECT * FROM FROM_";

$result5 = mysqli_query($dbcon, $query5)
	or die('Query failed: ' . mysqli_error($dbcon));


echo "<table>
    		<tr>
    		<th>FLIGHT_NUMBER</th><th>AIRCRAFT_NUMBER</th>
			</tr>";
    // output data of each row
    	while($row = $result5->fetch_assoc()) {
        	echo "<tr><td>"
         	. $row["FLIGHTNUMBER"]. "</td><td>" . $row["AIRCRAFTNUMBER"]."</td><td>" ;
    		}
    	echo "</table><hr>";
}
?>
