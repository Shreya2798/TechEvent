<?php
//$a=$_POST['eid'];
$b=$_POST['ename'];
$c=$_POST['edate'];
$d=$_POST['etime'];
$e=$_POST['numspeakers'];
$f=$_POST['maxparticipants'];
$g=$_POST['sponsoramt'];
$h=$_POST['amtcompleted'];
$i=$_POST['descr'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "authentication";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully\n";
$sql = "INSERT INTO `events` (`ename`,`edate`,`etime`,`numspeakers`,`maxparticipants`,`sponsoramt`,`amtcompleted`,`descr`) VALUES ('$b','$c','$d','$e','$f','$g','$h','$i')";
if ($conn->query($sql) === TRUE) {
	echo '<script>alert("New record created successfully");</script>';
    //sleep(1000);
    header("location: organiser.php");
} else {
	echo "Error: " . $sql . "</br>" . $conn->error;
}
$conn->close();
?>