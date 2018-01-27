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

$query = "SELECT TRANSACTIONID,MODEOFPAYMENT,BANKNAME,AMOUNTTRANSFERRED,DATEANDTIMEOFTRANSACTION FROM PAYMENT WHERE AMOUNTTRANSFERRED > $user";


$result = mysqli_query($dbcon, $query)
	or die('Query failed: ' . mysqli_error($dbcon));

while($row = mysqli_fetch_assoc($result)){
print '<ul>';
print '<li> TRANSACTIONID: '.$row['TRANSACTIONID'];
print '<li> MODE OF PAYMENT: '.$row['MODEOFPAYMENT'];
print '<li> BANKNAME: '.$row['BANKNAME'];
print '<li> AMOUNT TRANSFERRED: '.$row['AMOUNTTRANSFERRED'];
print '<li> DATE AND TIME OF TRANSACTION: '.$row['DATEANDTIMEOFTRANSACTION'];
print '</ul>';
}
print 'DONE!'

?>
