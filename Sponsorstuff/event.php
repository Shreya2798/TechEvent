<html>
<head>
	<title>Home</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  

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
        <li class="active"><a href="#">Home</a></li>
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
session_start();
$addcom='';
$uname = $_SESSION['username'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
//$arr2 = $_SESSION['arr1'];
//print_r($arr2);
if(isset($_GET['var'])){
$var0 = $_GET['var']; }//some_value
$sql = "SELECT type FROM users where username= '{$_SESSION['username']}'";
$result = $conn-> query($sql);
// set array
$array = array();
// look through query/*
if($result-> num_rows > 0){
  while($row = $result-> fetch_assoc()){
	  $array[] = $row;
	  //print_r($array[0]['sponsoramt']);
	 // echo $row['sponsoramt']; 
}

$t0=$array[0][type];

}
?>
<div style="position: absolute;left: 90px;top: 120px;right: 90px;width: 1200px;height: 600px;background-color:#353942;font-family: Arial;">
	<div style="position: absolute;left: 30px;top: 30px;width: 500px;height: 540px;border-radius: 25px;background-image: url('images.jpeg');"></div>
	<div style="position: absolute;left: 550px;top: 30px;width: 620px;height: 540px;background-color:white;border-radius: 25px">
	<div style="position: absolute;left:20px;"><?php
	$sql = "SELECT ename,edate,etime,sponsoramt,amtcompleted,descr FROM events where eid= '{$var0}'";
	$result = $conn-> query($sql);
	if($result-> num_rows > 0){
	  while($row = $result-> fetch_assoc()){
			  $a=$row["sponsoramt"];
			  $b=$row["amtcompleted"];
			  $c=$b/$a*100;
			  //echo $c;
			  echo '</br></br>EVENT NAME  :  '.$row["ename"];
			  echo '</br></br>EVENT DATE  :  '.$row["edate"];
			  echo '</br></br>EVENT TIME  :  '.$row["etime"];
			  echo '</br></br>PROGRESS  :  </br></br><div class="progress" style="margin-left:5px;margin-right:5px;">
                  <div class="progress-bar" role="progressbar" aria-valuenow="70"
                  aria-valuemin="0" aria-valuemax="100" style="width:'.$c.'%">
                  <span class="sr-only">70% Complete</span>
                  </div>
                </div>';
			  echo '</br></br>DESCRIPTION  :  '.$row["descr"];
			  	
			  echo '</br></br>SPEAKERS :';
			  echo "</br></br></br></br></br></br></br></br>&nbsp;&nbsp;&nbsp;";
			  if($t0!='Organizer')
			  {
				echo "<form action='next.php?var=".$var0."' method='post'><input type='submit' value='Go Live!'/></form>";
				
			  }
			  }
		}


	?>
	
	</div>
	</div>
</div>
<div style="position: absolute;left: 90px;top: 790px;right: 90px;width: 1200px;height: 200px;background-color:#353942;font-family: Arial;">

<!--for the comments-->
		<p style='position: absolute;left: 20px;top: 20px;color: white;font-family: Arial;'>COMMENTS:</p>
	
		
		<form action="" method="post">
		<textarea style="position: absolute;left: 20px;top: 40px;width:1155;height: 100px;font-family: Arial;" placeholder="Type your comment here..." name="comm"></textarea>
		<input type="submit" name="submit" value="Submit" style='position: absolute;left: 20px;top: 150px;'>
		</form>
		<?php
		/*$sql = "DELETE FROM comments";
			if (mysqli_query($conn,$sql)) {
				echo "";
			} else {
				echo "";
			}*/
		if(isset($_POST['submit']) ){

		//echo $_POST['comm'];
		$addcom=$_POST['comm'];
		
		$sql = "INSERT INTO comments (eid, username, comment) VALUES ('$var0', '".$uname."', '".$addcom."')";
			if (mysqli_query($conn,$sql)) {
				echo "";
			} else {
				echo "";
			}
		}
	?></div>
	<div style="position: absolute;left: 90px;top: 980px;right: 90px;width: 1200px;height: 10px;background-color:#353942;font-family: Arial;">
<!--<div style="position: absolute;left: 10px;top: 10px;right: 0px;width: 1180px;height: 40px;background-color:darkgray;border-radius: 25px;font-family: Arial;">-->
<?php	
	$sql = "SELECT username,comment FROM comments where eid='$var0'";
	$result = $conn-> query($sql);
	echo '<table class="table table-dark table-striped"  style="text-align:left;color:white">';
	$c=0;
	if($result-> num_rows > 0){
	  while($row = $result-> fetch_assoc()){
			  if($c%2==0)
				  echo '<tr style="background-color:#3F434C;"><td class="text-xs-left"> <span class="glyphicon glyphicon-user" style=""></span>&nbsp;&nbsp;&nbsp;'.$row["username"].' : '.$row["comment"].'</td></tr>';
			  else
				  echo '<tr style="background-color:#353942;"><td class="text-xs-left"> <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp;'.$row["username"].' : '.$row["comment"].'</td></tr>';
			  $c=$c+1;
			  }
			  
		}
	echo '</table>';
$conn->close();
	
		?>
<!--</div>-->
</div>