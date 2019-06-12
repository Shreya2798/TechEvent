<?php
session_start();
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
$curr=$_SESSION['username'];
$dbname = "authentication";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO `events` (`ename`,`edate`,`etime`,`numspeakers`,`maxparticipants`,`sponsoramt`,`descr`,`username`) VALUES ('$b','$c','$d','$e','$f','$g','$i','$curr')";
if ($conn->query($sql) === TRUE) {
	echo"<h2 style='font-family:Helvetica;font-size=14;color:green;position:absolute;top:10px;'>Successfully Created</h2>";
echo "<script>setTimeout(\"location.href = 'home.php';\",500);</script>";
} else {
	echo "Error: " . $sql . "</br>" . $conn->error;
}
$conn->close();
?>