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

$origin = $_REQUEST['origin'];
$destination = $_REQUEST['destination'];
$class = $_REQUEST['Class'];
$insure = $_REQUEST['Insure'];
$PaidBY = $_REQUEST['Paid'];
$pname = $_REQUEST['pname'];
$pemail = $_REQUEST['pemail'];
$pcitizenship = $_REQUEST['pcitizenship'];
$gen = $_REQUEST['gen'];
$dob = $_REQUEST['dob'];

//Get Flight Details
$query1 = "SELECT FLIGHTNUMBER,PRICE,DEPARTUREDATEANDTIME,ARRIVALDATEANDTIME FROM FLIGHTS_SCHEDULE WHERE ORIGIN = '$origin' AND DESTINATION = '$destination'";

$result = mysqli_query($dbcon, $query1)
	or die('Query failed: ' . mysqli_error($dbcon));

$tuple = mysqli_fetch_assoc($result)
  or die("Sorry not able to book ticket kindly check your Origin and Destination entered!");

$flightnumber = $tuple['FLIGHTNUMBER'];
$pr = $tuple['PRICE'];
$arrival= $tuple['ARRIVALDATEANDTIME'];
$departure= $tuple['DEPARTUREDATEANDTIME'];

// Generate random ticket number and ensure it did not exist in the database before
while(1){
$randnum = rand(1111111111,9999999999);
$query2 = "SELECT * FROM TICKET WHERE TICKETNUMBER = '$randnum'";
$result2 = mysqli_query($dbcon, $query2)
	or die('Query failed: ' . mysqli_error($dbcon));
$countrows = mysqli_num_rows($result2);
if($countrows== 0){
$query3 = "INSERT INTO TICKET VALUES ('$randnum','$flightnumber',$pr,'$origin','$destination','12:00',1,'$departure','$arrival','Terminal 1 Gate 1','$class',$insure)";
$result3 = mysqli_query($dbcon, $query3)
	or die('Query failed: ' . mysqli_error($dbcon));
break;
}
}

// Generate random transaction id and ensure it did not exist in the database before. Also update the relation table PAIDUSING.
while(1){
$randnum2 = rand(1111111111,9999999999);
$query4 = "SELECT * FROM PAYMENT WHERE TRANSACTIONID = '$randnum'";
$result4 = mysqli_query($dbcon, $query4)
	or die('Query failed: ' . mysqli_error($dbcon));
$countrows2 = mysqli_num_rows($result4);
if($countrows2== 0){
$query5 = "INSERT INTO PAYMENT VALUES('$randnum2','$PaidBY','BankOfAmerica',$pr,'12/5/17/1:00')";
$result5 = mysqli_query($dbcon, $query5)
	or die('Query failed: ' . mysqli_error($dbcon));
$query6 = "INSERT INTO PAIDUSING VALUES('$randnum2','$randnum')";
$result6 = mysqli_query($dbcon, $query6)
	or die('Query failed: ' . mysqli_error($dbcon));
break;
}
}

print "Successfully created your ticket. Your ticket number is $randnum ";

//Check if Passenger is already in database. If not only then add.
$query_1 = "SELECT * FROM PASSENGER WHERE EMAIL = '$pemail'";
$result_1 = mysqli_query($dbcon, $query_1)
	or die('Query failed: ' . mysqli_error($dbcon));
$countrows_1 = mysqli_num_rows($result_1);

if($countrows_1== 0){
$query_2 = "INSERT INTO PASSENGER VALUES('$pemail','$gen','$pname','$pcitizenship','$dob')";
$result_2 = mysqli_query($dbcon, $query_2)
	or die('Query failed: ' . mysqli_error($dbcon));
}

//Update Passenger Details Relation Table as well

$query_3 = "INSERT INTO PASSENGERDETAILS VALUES('$pemail','$randnum','XX')";
$result_3 = mysqli_query($dbcon, $query_3)
	or die('Query failed: ' . mysqli_error($dbcon));


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

?>
