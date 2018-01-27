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

$to = $_REQUEST['value1'];
$from = $_REQUEST['value2'];

$query = "SELECT TICKETNUMBER,TRANSFERFROMAIRPORT,TRANSFERTOAIRPORT FROM HASANYOFTHESESERVICESBEENPAIDFOR WHERE TRANSFERFROMAIRPORT='$from' AND TRANSFERTOAIRPORT = '$to'";


$result = mysqli_query($dbcon, $query)
	or die('Query failed: ' . mysqli_error($dbcon));

while($row = mysqli_fetch_assoc($result)){
print '<ul>';
print '<li> TICKET NUMBER: '.$row['TICKETNUMBER'];
print '<li> TRANSFER TO AIRPORT: '.$row['TRANSFERTOAIRPORT'];
print '<li> TRANSFER FROM AIRPORT: '.$row['TRANSFERFROMAIRPORT'];
print '</ul>';
}
print 'DONE!'

?>
