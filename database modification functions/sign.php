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
$name = $_REQUEST['nam'];
$password = $_REQUEST['psw'];
$age = $_REQUEST['age'];
$dob = $_REQUEST['dob'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$address = $_REQUEST['add'];

$query1 = "SELECT * FROM USER WHERE USERID = '$userid'";
$result1 = mysqli_query($dbcon, $query1)
	or die('Query failed: ' . mysqli_error($dbcon));
$countrows = mysqli_num_rows($result1);


//Check if User ID already exsists
if($countrows>0){
print "User ID Already Exists. Kindly try again with a different one!";
}
else{
$query2 = "INSERT INTO USER VALUES('$userid','$name','$password','$dob',$age,'$email',$phone,'$address')";

$result2 = mysqli_query($dbcon, $query2)
	or die('Query failed: ' . mysqli_error($dbcon));
print "User Creation Successfully Completed!";

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
