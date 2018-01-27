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
$foperator = $_REQUEST['foperator'];
$price = $_REQUEST['price'];
$origin = $_REQUEST['origin'];
$desti = $_REQUEST['desti'];
$stop = $_REQUEST['stop'];
$Aircraft = $_REQUEST['Aircraft'];


$query1 = "SELECT * FROM FLIGHTS_SCHEDULE WHERE FLIGHTNUMBER = '$fnumber'";
$result1 = mysqli_query($dbcon, $query1)
	or die('Query failed: ' . mysqli_error($dbcon));
$countrows = mysqli_num_rows($result1);


//Check if Flight already exists
if($countrows>0){
print "Flight Number already exists. You can't add existing flights again into the database!";
}
else{
$query2 = "INSERT INTO FLIGHTS_SCHEDULE VALUES('$fnumber','$foperator',$price,'$origin','$desti','3h30m','7/14/17/12:00','7/14/17/3:30',$stop)";

$result2 = mysqli_query($dbcon, $query2)
	or die('Query failed2: ' . mysqli_error($dbcon));
print "The Flight schedule has been successfully added into the database!";

//Insert Data into the Relation Table as well
$query3 = "INSERT INTO FROM_ VALUES('$fnumber','$Aircraft')";
$result3 = mysqli_query($dbcon, $query3)
	or die('Query failed2: ' . mysqli_error($dbcon));

echo nl2br("\n");
print "The Data in the FLIGHTS_SCHEDULE Table is now:";
echo nl2br("\n");
$query4 = "SELECT * FROM FLIGHTS_SCHEDULE";

$result4 = mysqli_query($dbcon, $query4)
	or die('Query failed: ' . mysqli_error($dbcon));


echo "<table>
    		<tr>
    		<th>FLIGHT_NUMBER</th><th>FLIGHT_OPERATOR</th> <th>PRICE</th>
			<th>ORIGIN</th> <th>DESTINATION</th>
			<th>TRAVEL_TIME</th> <th>DEPARTURE_DATE_AND_TIME</th>
			<th>ARRIVAL_DATE_AND_TIME</th><th>NUMBER_OF_STOPS</th>
			</tr>";
    // output data of each row
    	while($row = $result4->fetch_assoc()) {
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
