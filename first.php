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
$user = $_REQUEST['user'];

// Get the attributes of the user with the given username
$query = "SELECT USERID,DATEOFBIRTH,AGE,EMail,PhoneNo,Address from USER where NAME = '$user'";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

//print 'Welcome1!<br>';

$tuple = mysqli_fetch_assoc($result)
  or die("User $user not found!");

//var_dump($tuple);

print '<ul>';  
print '<li> Email: '.$tuple['EMail'];
print '<li> UserID: '.$tuple['USERID'];
print '<li> Date Of Birth: '.$tuple['DATEOFBIRTH'];
print '<li> Age: '.$tuple['AGE'];
print '<li> PhoneNo: '.$tuple['PhoneNo'];
print '<li> Address: '.$tuple['Address'];
print '</ul>';


// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?>





