<?php
$a=$_POST['eid'];
$b=$_POST['ename'];
$c=$_POST['edate'];
$d=$_POST['etime'];
$e=$_POST['numspeakers'];
$f=$_POST['maxparticipants'];
$g=$_POST['sponsoramt'];
$h=$_POST['amtcompleted']
$i=$_POST['descr'];
$j=$_POST['organizer'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully\n";
$sql = "INSERT INTO `events` (`eid`,`ename`,`edate`,`etime`,`numspeakers`,`maxparticipants`,`sponsoramt`,`amtcompleted`,`descr`,`organizer`) VALUES ('$a','$b','$c','$d','$e','$f','$g','$h','$i','$j')";

if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "</br>" . $conn->error;
}

$conn->close();
?>