<?php
session_start();

if($_SESSION['login']!=true)
{
    header('Location: login.php');
    exit;
}

$eventID=$_GET['id'];
$conn=mysqli_connect("localhost","root","","authentication");
$query="Select username,ename from events where eid= '$eventID'";
$result=$conn->query($query);
$row = $result->fetch_assoc(); //row from events table for event to be joined to
$orgname=$row["username"];
$ename=$row["ename"];
$curr=$_SESSION['username'];
$query="Select email from `users` where username= '$curr'";
$result=$conn->query($query);
$row = $result->fetch_assoc();
$email=$row["email"];
$curr=$_SESSION['username'];
mysqli_query($conn,"INSERT INTO `requests` (`Sender`, `Reciever`, `sEmail`, `ename`,`eid`, `date`) VALUES ('$curr', '$orgname', '$email', '$ename','$eventID', 'CURRENT_TIMESTAMP')");

echo "Request sent<br/>";
echo '<a href="index.php"> Go to Home </a>';

?>