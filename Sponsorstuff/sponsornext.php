<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style> 
</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">(logo)</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
		<li><a href="#">About</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?logout='1'" ><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php
    //$_POST['value']=0;
	//echo $_POST['value'];
?>
<form method="post" action="">Enter the amount you wish to contribute(in thousands):
</br></br><input type="text" name="value"></br></br>
<input type="submit" onclick="alert('Thanks for your contribution!');"></br></br>
<a href=""></br></br>
</form></br></br>

<?php
session_start();
//echo "{$_SESSION['username']}";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$uname = $_SESSION['username'];
//UPDATE RECORD
//echo $_POST['value'];
//echo "Connected successfully\n";
//$addval =(int)$_POST["name"];
$eid = $_SESSION['varname']; //id from previous page
$addval=$_POST['value']; //amount to be added
$sql = "SELECT amtcompleted FROM events where eid='$eid'";
$result = $conn-> query($sql);
// set array
$array = array();
// look through query/*
if($result-> num_rows > 0){
  while($row = $result-> fetch_assoc()){
	  $array[] = $row;
	  //print_r($array[0]['sponsoramt']);
	 // echo $row['sponsoramt']; 
}}
// debug:
//print_r($array); 
//echo (string)	$array[0]['amtcompleted'];
$finalval = $addval+(int)$array[0]['amtcompleted'];
//echo $finalval;
$sql = "UPDATE events SET amtcompleted='$finalval' WHERE eid='$eid'";
    // where events.username= '{$_SESSION['username']}' ";
//$result = $conn-> query($sql);
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
//ADD TO TABLE SPONSOR
$sql = "INSERT INTO sponsor (username, eid, amt) VALUES ('$uname', '$eid', '$addval')";

if (mysqli_query($conn,$sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
</body>
</html>
