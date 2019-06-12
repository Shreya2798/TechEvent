<?php

if(isset($_GET['value'])){
$search = $_GET['value']; }
//echo $search;
session_start(); 
if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  
if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location:login.php");
  }
$conn = mysqli_connect("localhost","root","","authentication");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
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
      <a class="navbar-brand" href="home.php"><div ><img src="logo.PNG" style="position:absolute;top:4px;height:88%;width:4%;"/></div></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" style="position:absolute;left:84px;">
        <li><a href="home.php">Home</a></li>
           <?php
          //session_start();
           if($_SESSION['Type']=="Organiser")
          {
          echo'<li><a href="createEvent.php">Create event</a></li>
               <li><a href="Notification.php"> Notifications </a></li> ';
           }
          ?>
        <li><a href="yourEvents.php">My Events</a></li>
		<li><a href="#">About</a></li>
        <li><a href="#">Contact us</a></li>
          &nbsp;&nbsp;<?php
		if($_SESSION['Type']=="Participant"){
		 //$var0=$_POST["value"];
		echo '<li><form action="search.php"><input type="text" name="value" placeholder=" Search for events..." style="position:absolute;top:10px;left:30px;border-radius:25px;"/><span class="glyphicon glyphicon-search" style="position:absolute;top:16px;left:217px;color:darkgray;"></span></form></li>';//search.php?var='..'

		}
		?>
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
            </form>
</li>
      </ul>
    </div>
  </div>
</nav>

<?php
$sql = "SELECT eid,ename,descr FROM events where verified=1 and ename like '%$search%' or descr like '%$search%'";
        $result = $conn-> query($sql);
        if($result-> num_rows > 0)
        {
            while($row = $result-> fetch_assoc())
            {
                $v0=$row['eid'];
                echo '<div class="container">    
                      <div class="row"><div class="col-sm-4"> 
                        <div class="panel panel-primary">
                        <div class="panel-heading"><a href="event.php?var='.$v0.'" style="color:black;">Event</a> <span class="glyphicon glyphicon-ok-circle"></span></div>
                        <div class="panel-body"><img src="TEDx.jpg" class="img-responsive" style="width:100%" alt="Image"></div><p style="margin-left:5px">Event ID :'. $row["eid"] ."</br><p style='margin-left:5px'>Event name: ". $row["ename"].'</br><p style="margin-left:5px">Description: '. $row["descr"] .'</br></br></br>
                        
                        <div class="panel-footer"></div>
                        </div>
		</div>';}}
?>		
</body>
</html>