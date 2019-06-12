<html>
<head>
	<title>Sponsor amount</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" href="logo.PNG" type="image/png" >
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
       <a class="navbar-brand" href="home.php"><div ><img src="logo.PNG" style="position:absolute;top:4px;height:88%;width:4%;"/>    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav" style="position:absolute;left:84px;">
       <li><a href="home.php">Home</a></li>
          
        <li><a href="yourEvents.php">My Events</a></li>
		<li><a href="#">About</a></li>
        <li><a href="#">Contact us</a></li>
        
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
                    <button name="logout" style="position:absolute;top:7px;left:1520px;" class="btn btn-danger my-2">Logout</button>
            </form>
</li>
      </ul>
    </div>
  </div>
</nav>

<?php
    //$_POST['value']=0;
	//echo $_POST['value'];
?>
<center><form method="post" action="">Enter the amount you wish to contribute:
</br></br><input type="text" name="value1"/></br></br>
<input type="submit" name='submit' onclick="alert('Thanks for your contribution!');"/></br></br>
<a href=""></br></br>
</form></br></br> </center>

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
if(isset($_GET['var'])){
  $eid = $_GET['var']; //some_value
}
 //id from previous page
//echo $eid;
$sql = "SELECT amtcompleted FROM events where eid='$eid'";
$result = $conn-> query($sql);
$array = array();
// look through query/*
if($result-> num_rows > 0){
 $row = $result-> fetch_assoc();
}
//echo $row["amtcompleted"];
//ADD TO TABLE SPONSOR
if(isset($_POST['submit']) )
{

$addval=$_POST['value1']; //amount to be added
//echo $addval;
$finalval = $addval+(int)$row["amtcompleted"];
//echo $finalval;
$sql = "UPDATE events SET amtcompleted='$finalval' WHERE eid='$eid'";
    
if (mysqli_query($conn, $sql)) {
    echo "";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
$uname=$_SESSION["username"];
$sql1 = "INSERT INTO `sponsor` (`username`, `eid`, `amt`) VALUES ('$uname', '$eid', '$addval')";
if (mysqli_query($conn,$sql1)) {
    echo "";
} else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}

}

$conn->close();
?>
</body>
</html>
