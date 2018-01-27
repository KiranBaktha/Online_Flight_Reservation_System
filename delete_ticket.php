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

$ticketnumber = $_REQUEST['ticketnumber'];

$query1 = "SELECT * FROM TICKET WHERE TICKETNUMBER = '$ticketnumber'";
$result1 = mysqli_query($dbcon, $query1)
	or die('Query failed: ' . mysqli_error($dbcon));
$countrows = mysqli_num_rows($result1);


//Check if the ticket acutally existed
if($countrows==0){
print "I'm sorry the ticket number entered does not belong to the database!";
}
else{

$query2 = "DELETE FROM TICKET WHERE TICKETNUMBER = '$ticketnumber'";

$result2 = mysqli_query($dbcon, $query2)
	or die('Query failed: ' . mysqli_error($dbcon));

//Delete from Relation Tables as well
$query_1 = "DELETE FROM PASSENGERDETAILS WHERE TICKETNUMBER = '$ticketnumber'";

$result_1 = mysqli_query($dbcon, $query_1)
	or die('Query failed: ' . mysqli_error($dbcon));



$query_2 = "SELECT * FROM PAIDUSING WHERE TICKETNUMBER = '$ticketnumber'";

$result_2 = mysqli_query($dbcon, $query_2)
	or die('Query failed: ' . mysqli_error($dbcon));

$rowx = mysqli_fetch_assoc($result);

$id = $rowx['TRANSACTIONID'];

$query_3 = "DELETE FROM PAIDUSING WHERE TICKETNUMBER = '$ticketnumber'";

$result_3 = mysqli_query($dbcon, $query_3)
	or die('Query failed: ' . mysqli_error($dbcon));



$query_4 = "DELETE FROM PAYMENT WHERE TRANSACTIONID = '$id'";

$result_4 = mysqli_query($dbcon, $query_4)
	or die('Query failed: ' . mysqli_error($dbcon));

print "The ticket number has been successfully deleted!";


//Display all tables
echo nl2br("\n");
print "The Data in TICKET Table is now:";
echo nl2br("\n");
$query3 = "SELECT * FROM TICKET";

$result3 = mysqli_query($dbcon, $query3)
	or die('Query failed: ' . mysqli_error($dbcon));


echo "<table>
    		<tr>
    		<th>TICKET NUMBER</th><th>FLIGHT NUMBER</th> <th>PRICE PAID</th>
			<th>ORIGIN</th> <th>DESTINATION</th>
			<th>BOARDING TIME</th> <th>NUMBER OF PASSENGERS</th>
			<th>DEPARTURE DATE AND TIME</th>
                        <th>ARRIVAL DATE AND TIME</th>
			<th>TERMINAL AND GATE</th>
			<th>CLASS</th>
			<th>INSURED</th>
			</tr>";

   while($row = $result3->fetch_assoc()) {
        	echo "<tr><td>"
         	. $row["TICKETNUMBER"]. "</td><td>" . $row["FLIGHTNUMBER"]. "</td><td>"
         	. $row["PRICEPAID"]. "</td><td>" . $row["ORIGIN"]. "</td><td>"
         	. $row["DESTINATION"]. "</td><td>". $row["BOARDINGTIME"]. "</td><td>"
		. $row["NUMBEROFPASSENGERS"]."</td><td>". $row["DEPARTUREDATEANDTIME"]. "</td><td>"
. $row["ARRIVALDATEANDTIME"]. "</td><td>". $row["TERMINALANDGATE"]. "</td><td>" . $row["CLASS"]. "</td><td>". $row["INSURED"]. "</td><td>";
    		}
    	echo "</table><hr>";


echo nl2br("\n");
print "The Data in PAYMENT Table is now:";
echo nl2br("\n");
$query4 = "SELECT * FROM PAYMENT";

$result4 = mysqli_query($dbcon, $query4)
	or die('Query failed: ' . mysqli_error($dbcon));


echo "<table>
    		<tr>
    		<th>TRANSACTION_ID</th><th>MODE_OF_PAYMENT</th> <th>BANK_NAME</th>
			<th>AMOUNT-TRANSFERRED</th> <th>DATE_AND_TIME_OF_TRANSACTION</th>
			</tr>";
    	while($row = $result4->fetch_assoc()) {
        	echo "<tr><td>"
         	. $row["TRANSACTIONID"]. "</td><td>" . $row["MODEOFPAYMENT"]. "</td><td>"
         	. $row["BANKNAME"]. "</td><td>" . $row["AMOUNTTRANSFERRED"]. "</td><td>"
         	. $row["DATEANDTIMEOFTRANSACTION"]. "</td><td>";
    		}
    	echo "</table><hr>";


echo nl2br("\n");
print "The Data in the Relation Table PAIDUSING is now:";
echo nl2br("\n");
$query5 = "SELECT * FROM PAIDUSING";

$result5 = mysqli_query($dbcon, $query5)
	or die('Query failed: ' . mysqli_error($dbcon));


echo "<table>
    		<tr>
    		<th>TRANSACTION ID</th><th>TICKET NUMBER</th>
			</tr>";
    	while($row = $result5->fetch_assoc()) {
        	echo "<tr><td>"
         	. $row["TRANSACTIONID"]. "</td><td>" . $row["TICKETNUMBER"]. "</td><td>";
    		}
    	echo "</table><hr>";


echo nl2br("\n");
print "The Data in PASSENGER Table is now:";
echo nl2br("\n");
$query6 = "SELECT * FROM PASSENGER";

$result6 = mysqli_query($dbcon, $query6)
	or die('Query failed: ' . mysqli_error($dbcon));


echo "<table>
    		<tr>
    		<th>EMAIL</th><th>GENDER</th>
		<th>NAME</th>
		<th>CITIZENSHIP</th><th>DATE_OF_BIRTH</th>
			</tr>";
    	while($row = $result6->fetch_assoc()) {
        	echo "<tr><td>"
         	. $row["EMAIL"]. "</td><td>" . $row["GENDER"]. "</td><td>"
		. $row["PASSENGERNAME"]. "</td><td>". $row["CITIZENSHIP"]. "</td><td>"
		. $row["DATEOFBIRTH"]. "</td><td>";
    		}
    	echo "</table><hr>";

echo nl2br("\n");
print "The Data in relation Table PASSENGER DETAILS is now:";
echo nl2br("\n");
print "Note: XX indicates seat will be assigned at check in.";
echo nl2br("\n");
$query7 = "SELECT * FROM PASSENGERDETAILS";

$result7 = mysqli_query($dbcon, $query7)
	or die('Query failed: ' . mysqli_error($dbcon));


echo "<table>
    		<tr>
    		<th>EMAIL</th><th>TICKET_NUMBER</th>
		<th>SEAT_ASSIGNED</th>
			</tr>";
    	while($row = $result7->fetch_assoc()) {
        	echo "<tr><td>"
         	. $row["EMAIL"]. "</td><td>" . $row["TICKETNUMBER"]. "</td><td>"
		. $row["SEATASSIGNED"]. "</td><td>";
    		}
    	echo "</table><hr>";

}
?>
