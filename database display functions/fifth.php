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

$user = $_REQUEST['Airlines'];

$query = "SELECT FLIGHTNUMBER,FLIGHTOPERATOR,PRICE,ORIGIN,DESTINATION,TRAVELTIME,DEPARTUREDATEANDTIME,ARRIVALDATEANDTIME,NUMBEROFSTOPS FROM FLIGHTS_SCHEDULE WHERE FLIGHTOPERATOR = '$user'";


$result = mysqli_query($dbcon, $query)
	or die('Query failed: ' . mysqli_error($dbcon));

while($row = mysqli_fetch_assoc($result)){
print '<ul>';
print '<li> FLIGHT NUMBER: '.$row['FLIGHTNUMBER'];
print '<li> FLIGHT OPERATOR: '.$row['FLIGHTOPERATOR'];
print '<li> PRICE: '.$row['PRICE'];
print '<li> ORIGIN: '.$row['ORIGIN'];
print '<li> DESTINATION: '.$row['DESTINATION'];
print '<li> DEPARTURE DATE AND TIME: '.$tuple['DEPARTUREDATEANDTIME'];
print '<li> ARRIVAL DATE AND TIME: '.$tuple['ARRIVALDATEANDTIME'];
print '<li> TRAVELTIME: '.$tuple['TRAVELTIME'];
print '<li> NUMBER OF STOPS: '.$tuple['NUMBEROFSTOPS'];
print '</ul>';
}
print 'DONE!'

?>
