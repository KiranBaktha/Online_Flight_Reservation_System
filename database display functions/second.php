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

// Getting the input parameter (user):
$user = $_REQUEST['destination'];

// Get the attributes of the flight
$query = "SELECT FLIGHTNUMBER,FLIGHTOPERATOR,PRICE,ORIGIN,DESTINATION,TRAVELTIME,DEPARTUREDATEANDTIME,ARRIVALDATEANDTIME,NUMBEROFSTOPS FROM FLIGHTS_SCHEDULE WHERE DESTINATION = '$user'";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));


$tuple = mysqli_fetch_assoc($result)
  or die("Destination $user not found!");

//var_dump($tuple);

print '<ul>';  
print '<li> FLIGHTNUMBER: '.$tuple['FLIGHTNUMBER'];
print '<li> FLIGHTOPERATOR: '.$tuple['FLIGHTOPERATOR'];
print '<li> PRICE: '.$tuple['PRICE'];
print '<li> ORIGIN: '.$tuple['ORIGIN'];
print '<li> DESTINATION: '.$tuple['DESTINATION'];
print '<li> DEPARTURE DATE AND TIME: '.$tuple['DEPARTUREDATEANDTIME'];
print '<li> ARRIVAL DATE AND TIME: '.$tuple['ARRIVALDATEANDTIME'];
print '<li> TRAVELTIME: '.$tuple['TRAVELTIME'];
print '<li> NUMBER OF STOPS: '.$tuple['NUMBEROFSTOPS'];
print '</ul>';


// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?>
