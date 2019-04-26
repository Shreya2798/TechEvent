<?php
session_start();

if($_SESSION['login']!=true)
{
    header('Location: login.php');
    exit;
}

$eventID=$_GET['id'];
$conn=mysqli_connect("localhost","root","","authentication");
$query="Select username,ename from `events` where eid= '$eventID'";
$result=$conn->query($query);
$row = $result->fetch_assoc(); //row from events table for event to be joined to
$orgname=$row["username"];
$ename=$row["ename"];
$curr=$_SESSION['username'];
$query="Select LinkedIn,Type from `users` where username= '$curr'";
$result=$conn->query($query);
$row = $result->fetch_assoc();
$sLinkedin=$row["LinkedIn"];
$sType=$row["Type"];
$date = date('Y-m-d H:i:s', time());
$curr=$_SESSION['username'];
mysqli_query($conn,"INSERT INTO `requests` (`Sender`, `Reciever`, `sLinkedin`,`sType`, `ename`,`eid`, `date`) VALUES ('$curr', '$orgname', '$sLinkedin','$sType', '$ename','$eventID', '$date')");

echo '<h3 style="color:green;">Request sent</h3><br/>';
echo "<script>setTimeout(\"location.href = 'home.php';\",500);</script>";
    ?>
<html>
<head>
    <link rel="icon" href="logo.PNG" type="image/png" >
</head>
</html>