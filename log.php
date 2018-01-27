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

$user = $_REQUEST['valuename'];
$password = $_REQUEST['valuepass'];

$query = "SELECT NAME FROM USER WHERE USERID= '$user' AND PASSWORD = '$password'";


$result = mysqli_query($dbcon, $query)
	or die('Query failed: ' . mysqli_error($dbcon));

$countrows = mysqli_num_rows($result);

if($countrows== 0){

print 'Incorrect Login Details. Please Try Again!';
}
else{
header('Location:https://mpcs53001.cs.uchicago.edu/~kiranbaktha/start2.html');
}
?>
