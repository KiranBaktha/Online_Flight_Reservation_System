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
$new_origin = $_REQUEST['origin'];
$new_destination = $_REQUEST['desti'];

$query1 = "UPDATE FLIGHTS_SCHEDULE SET ORIGIN = '$new_origin',DESTINATION = '$new_destination' WHERE FLIGHTNUMBER = '$fnumber'";
$result1 = mysqli_query($dbcon, $query1)
	or die('Query failed: ' . mysqli_error($dbcon));

print "The Flight Schedule has been updated successfully!";
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
?>
