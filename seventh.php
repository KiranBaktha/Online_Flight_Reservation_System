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
$user = $_REQUEST['value'];

// Get the attributes of the user with the given username
$query = "SELECT  TICKETNUMBER,FLIGHTNUMBER,PRICEPAID,ORIGIN,DESTINATION,BOARDINGTIME,NUMBEROFPASSENGERS,DEPARTUREDATEANDTIME,ARRIVALDATEANDTIME,TERMINALANDGATE,CLASS,INSURED FROM TICKET WHERE TICKETNUMBER = '$user'";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

//print 'Welcome1!<br>';

$tuple = mysqli_fetch_assoc($result)
  or die("TICKET NUMBER $user not found!");

//var_dump($tuple);

print '<ul>';  
print '<li> TICKET NUMBER: '.$tuple['TICKETNUMBER'];
print '<li> FLIGHT NUMBER: '.$tuple['FLIGHTNUMBER'];
print '<li> PRICE PAID: '.$tuple['PRICEPAID'];
print '<li> ORIGIN: '.$tuple['ORIGIN'];
print '<li> DESTINATION: '.$tuple['DESTINATION'];
print '<li> DEPARTURE DATE AND TIME: '.$tuple['DEPARTUREDATEANDTIME'];
print '<li> ARRIVAL DATE AND TIME: '.$tuple['ARRIVALDATEANDTIME'];
print '<li> BOARDINGTIME: '.$tuple['BOARDINGTIME'];
print '<li> NUMBER OF PASSENGERS: '.$tuple['NUMBEROFPASSENGERS'];
print '<li> TERMINAL AND GATE: '.$tuple['TERMINALANDGATE'];
print '<li> INSURED?: '.$tuple['INSURED'];
print '<li> CLASS: '.$tuple['CLASS'];
print '</ul>';


// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?>
