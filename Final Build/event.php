<html>
<head>
	<title>Event</title>
    <link rel="icon" href="logo.PNG" type="image/png" >
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
     <a class="navbar-brand" href="home.php"><div ><img src="logo.PNG" style="position:absolute;top:4px;height:88%;width:4%;"/></div></a>   
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" style="position:absolute;left:84px;">
        <li><a href="home.php">Home</a></li>
           <?php
          session_start();
           if($_SESSION['Type']=="Organiser")
          {
          echo'<li><a href="createEvent.php">Create event</a></li>
               <li><a href="Notification.php"> Notifications </a></li> ';
           }
          ?>
		<li><a href="#">About</a></li>
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
                    <button name="logout" style="position:relative;right:5px;top:10px;" class="btn btn-danger my-2">Logout</button>
            </form></li>
      </ul>
    </div>
  </div>
</nav>

<?php
//session_start();
$addcom='';
$uname = $_SESSION['username'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "authentication";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
//$arr2 = $_SESSION['arr1'];
//print_r($arr2);
if(isset($_GET['var'])){
$var0 = $_GET['var']; }//some_value
$sql = "SELECT Type FROM users where username= '{$_SESSION['username']}'";
$result = $conn-> query($sql);
// set array


$sql = "SELECT username,verified FROM events where eid='$var0'";
$result = $conn-> query($sql);
$array = array();
if($result-> num_rows > 0){
  while($row = $result-> fetch_assoc()){
	  $array[] = $row;
}
}
$t0=$array[0]["verified"];
$t1=$array[0]["username"];	  
	  
?>
<div style="position: absolute;left: 90px;top: 120px;right: 90px;width: 1200px;height: 600px;background-color:#353942;font-family: Arial;">
	<div style="position: absolute;left: 30px;top: 30px;width: 500px;height: 540px;border-radius: 25px;background-image: url('event.jpeg');"></div>
	<div style="position: absolute;left: 550px;top: 30px;width: 620px;height: 540px;background-color:#BAE7F4;border-radius: 25px">
	<div style="position: absolute;left:20px;"><?php
	$sql = "SELECT ename,edate,etime,sponsoramt,amtcompleted,descr FROM events where eid= '{$var0}'";
	$result = $conn-> query($sql);
    $query="";
	if($result-> num_rows > 0){
	  while($row = $result-> fetch_assoc()){
			  $a=$row["sponsoramt"];
			  $b=$row["amtcompleted"];
			  $c=$b/$a*100;
			  //echo $c;
			  echo '</br></br> <b> EVENT NAME <b/> :  '.$row["ename"];
			  echo '</br></br>EVENT DATE  :  '.$row["edate"];
			  echo '</br></br>EVENT TIME  :  '.$row["etime"];
			  echo '</br></br>SPONSOR AMOUNT  :  </br></br><div class="progress" style="margin-left:5px;margin-right:5px;">
                  <div class="progress-bar" role="progressbar" aria-valuenow="70"
                  aria-valuemin="0" aria-valuemax="100" style="width:'.$c.'%">
                  <span class="sr-only">70% Complete</span>
                  </div>
                </div>';
			  echo '</br></br>DESCRIPTION  :  '.$row["descr"];
			  	
			  echo '</br></br>SPEAKERS : </br><br>';
          $q1="SELECT sname from speakers where eid='$var0'";
          $res=$conn-> query($q1);
          if($res-> num_rows > 0)
          {
              echo"<ul>";
               while($row2 = $res-> fetch_assoc())
               {
                   echo "<li>".$row2["sname"]." </li>";
               }
              echo"<ul/>";
          }
          else
          {
              echo"<p> No speakers yet. </p>";
          }
          
		echo "</br></br></br></br></br>&nbsp;&nbsp;";	  
          
              if($t1==$_SESSION['username'] && $t0==1)
              {
                  
                  echo "<button style='color:green;background-color:darkgrey;' value='Your event is live!!' >Your event is live!!</button>";
                 
              }
          
			  if($t1==$_SESSION['username'] && $t0==0)
			  {
                 
				echo "<form action='golive.php?var=".$var0."' method='post'><input type='submit' value='Go Live!'/></form>";
				
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