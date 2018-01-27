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

$user = $_REQUEST['value'];

$query = "SELECT AIRCRAFTNUMBER,SEATCAPACITYECONOMY,SEATCAPACITYBUSINESS,SEATCAPACITYFIRST,FLIGHTMODEL,FLIGHTOPERATOR FROM FLIGHT WHERE FLIGHTMODEL = '$user'";


$result = mysqli_query($dbcon, $query)
	or die('Query failed: ' . mysqli_error($dbcon));

while($row = mysqli_fetch_assoc($result)){
print '<ul>';
print '<li> AIRCRAFT NUMBER: '.$row['AIRCRAFTNUMBER'];
print '<li> FLIGHT MODEL: '.$row['FLIGHTMODEL'];
print '<li> FLIGHT OPERATOR: '.$row['FLIGHTOPERATOR'];
print '<li> SEATCAPACITYECONOMY: '.$row['SEATCAPACITYECONOMY'];
print '<li> SEATCAPACITYBUSINESS: '.$row['SEATCAPACITYBUSINESS'];
print '<li> SEAT CAPACITY FIRST: '.$row['SEATCAPACITYFIRST'];
print '</ul>';
}
print 'DONE!'

?>
