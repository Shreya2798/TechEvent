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
        <li class="active"><a href="home.php">Home</a></li>
		<li><a href="#">About</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <?php
                if(isset($_POST["logout"]))
                   {
                       session_destroy();
                       header('location:login.php');
                   }
            ?>
           
      <ul class="nav navbar-nav navbar-right">
        <li><form method="post">
                    <button name="logout" style="position:absolute;top:7px;right:10px;" class="btn btn-danger my-2">Logout</button>
            </form></li>
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
$dbname = "authentication";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
$uname = $_SESSION['username'];

//echo $_POST['value'];
//echo "Connected successfully\n";
//$addval =(int)$_POST["name"];
if(isset($_GET['var'])){
  $eid = $_GET['var']; //some_value
} 

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
//ADD TO TABLE SPONSOR
if(isset($_POST['submit']) ){
$addval=$_POST['value']; //amount to be added
$sql = "SELECT amtcompleted FROM events where eid='$eid'";
$result = $conn-> query($sql);
// set array
$array = array();
if($result-> num_rows > 0){
  while($row = $result-> fetch_assoc()){
	  $array[] = $row;
}}
$finalval = $addval+(int)$array[0]['amtcompleted'];
//echo $finalval;
//$update0 = $finalval - (int)$array[0]['amtcompleted'];
$sql = "UPDATE events SET amtcompleted='$finalval' WHERE eid='$eid'";
    // where events.username= '{$_SESSION['username']}' ";
//$result = $conn-> query($sql);
if (mysqli_query($conn, $sql)) {
    echo "";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
$sql = "INSERT INTO sponsor (username, eid, amt) VALUES ('$uname', '$eid', '$addval')";
if (mysqli_query($conn,$sql)) {
    echo "";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();
?>
</body>
</html>
