<?php
$b=$_POST['ename'];
$c=$_POST['edate'];
$d=$_POST['etime'];
$e=$_POST['numspeakers'];
$f=$_POST['maxparticipants'];
$g=$_POST['sponsoramt'];
$i=$_POST['descr'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully\n";
$sql = "INSERT INTO `events` (`ename`,`edate`,`etime`,`numspeakers`,`maxparticipants`,`sponsoramt`,`descr`) VALUES ('$b','$c','$d','$e','$f','$g','$i')";

if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "</br>" . $conn->error;
}

$conn->close();
?>
