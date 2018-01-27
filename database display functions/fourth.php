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
$user = $_REQUEST['passenger'];

// Get the attributes of the user with the given username
$query = "SELECT EMAIL,GENDER,PASSENGERNAME,CITIZENSHIP,DATEOFBIRTH from PASSENGER where PASSENGERNAME = '$user'";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

//print 'Welcome1!<br>';

$tuple = mysqli_fetch_assoc($result)
  or die("Passenger $user not found!");

//var_dump($tuple);

print '<ul>';  
print '<li> Email: '.$tuple['EMAIL'];
print '<li> GENDER: '.$tuple['GENDER'];
print '<li> Date Of Birth: '.$tuple['DATEOFBIRTH'];
print '<li> CITIZENSHIP: '.$tuple['CITIZENSHIP'];
print '</ul>';


// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?>





