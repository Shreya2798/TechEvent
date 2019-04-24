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
$dbname = "techevent";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO `events` (`ename`,`edate`,`etime`,`numspeakers`,`maxparticipants`,`sponsoramt`,`descr`) VALUES ('$b','$c','$d','$e','$f','$g','$i')";

if ($conn->query($sql) === TRUE) {
	echo"<h2>Successfully Created</h2>";
echo "<script>setTimeout(\"location.href = '../index2.php';\",1500);</script>";
} else {
	echo "Error: " . $sql . "</br>" . $conn->error;
}

$conn->close();
?>
