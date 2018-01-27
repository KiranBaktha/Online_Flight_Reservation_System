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

$query = "SELECT FLIGHTNUMBER,FLIGHTOPERATOR FROM UNBOOKEDFLIGHTS";
$result = mysqli_query($dbcon, $query)
	or die('Query failed: ' . mysqli_error($dbcon));

while($row = mysqli_fetch_assoc($result)){
print '<ul>';
print '<li> FLIGHT NUMBER: '.$row['FLIGHTNUMBER'];
print '<li> FLIGHT OPERATOR: '.$row['FLIGHTOPERATOR'];
print '</ul>';
}



print 'DONE!'



?>
