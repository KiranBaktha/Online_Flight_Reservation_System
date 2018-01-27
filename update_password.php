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

$userid = $_REQUEST['userid'];
$oldpassword = $_REQUEST['psw'];
$newpassword = $_REQUEST['psw2'];

$query1 = "SELECT * FROM USER WHERE USERID = '$userid' AND PASSWORD = '$oldpassword'";
$result1 = mysqli_query($dbcon, $query1)
	or die('Query failed: ' . mysqli_error($dbcon));
$countrows = mysqli_num_rows($result1);


//Check if User provided incorrect login details
if($countrows==0){
print "I'm sorry you have provided incorrect login details.";
}
else{
$query2 = "UPDATE USER SET PASSWORD = '$newpassword' WHERE USERID ='$userid'";

$result2 = mysqli_query($dbcon, $query2)
	or die('Query failed: ' . mysqli_error($dbcon));
print "Your Password has been updated successfully!";
echo nl2br("\n");
print "The Data in the USER Table is now:";
echo nl2br("\n");
$query3 = "SELECT * FROM USER";

$result3 = mysqli_query($dbcon, $query3)
	or die('Query failed: ' . mysqli_error($dbcon));

/*
while($row = $result3->fetch_assoc()) {
        echo "USERID: " . $row["USERID"]. " - NAME: " . $row["NAME"]. " PASSWORD: " . $row["PASSWORD"]. "<br>";
    }
*/

echo "<table>
    		<tr>
    		<th>USERID</th><th>NAME</th> <th>PASSWORD</th>
			<th>DATE OF BIRTH</th> <th>AGE</th>
			<th>EMAIL</th> <th>PHONE NO</th>
			<th>ADDRESS</th>
			</tr>";
    // output data of each row
    	while($row = $result3->fetch_assoc()) {
        	echo "<tr><td>"
         	. $row["USERID"]. "</td><td>" . $row["NAME"]. "</td><td>"
         	. $row["PASSWORD"]. "</td><td>" . $row["DATEOFBIRTH"]. "</td><td>"
         	. $row["AGE"]. "</td><td>" . $row["EMail"]. "</td><td>". $row["PhoneNo"]. "</td><td>". $row["Address"]. "</td><td>"  ;
    		}
    	echo "</table><hr>";
}		
?>
