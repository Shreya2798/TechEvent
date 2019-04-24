<?php 
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
?>

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
		.notif:hover {
	  color: white;
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
		<?php
		
		$query="SELECT Type FROM users WHERE username='$username'";
		$result=$conn->query($query);
		$row = $result->fetch_assoc();

		/*if($row ["Type"]=="Organizer")
			echo "<li>Notifications</li>"; //???????
		*/
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
                    <button name="logout" class="btn btn-danger my-2">Logout</button>
            </form></li>
      </ul>
    </div>
  </div>
</nav>

 

  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
    
      <?php  if (isset($_SESSION['username'])) : ?>
            <p style="margin-left:70px;">Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
          
            <!-- <p> Upcoming Events!</p> -->    
<h3  style="margin-left:70px;">Your Events</h3>
<p  style='margin-left:70px;'>Here's a list of your events:</br></br></br></br></p>  
<?php

	if($row ["Type"]=="Organizer")
	{
	<?php
        $curr=$_SESSION['username'];
		$sql = "SELECT events.eid,events.ename,events.username,events.descr FROM events INNER JOIN users on events.username=users.username where events.username != '$curr' and events.eid NOT IN (".implode(',',$ceid).")  ";
		// where events.username= '{$_SESSION['username']}' ";
		$result = $conn-> query($sql);
		if($result-> num_rows > 0){
		  while($row = $result-> fetch_assoc()){
			  $v0=$row["eid"];
				  echo '<div class="container">    
					  <div class="row"><div class="col-sm-4"> 
						<div class="panel panel-primary">
						<div class="panel-heading"><a href="event.php?var='.$v0.'" style="color:black;">Event</a></div>
						<div class="panel-body"><img src="TEDx.jpg" class="img-responsive" style="width:100%" alt="Image"></div><p style="margin-left:5px">Event ID :'. $row["eid"] ."</br><p style='margin-left:5px'>Event name: ". $row["ename"]."</br><p style='margin-left:5px'>Organiser: ". $row["username"].'</br><p style="margin-left:5px">Description : '.$row["descr"].'</br></br></br>
						<button style="background-color:navy;margin-left:5px;margin-bottom:15px;"><a style="color:white;" href="request.php?id='.$row["eid"].'"><h4>Collaborate</h4></a></button>
						<div class="panel-footer"></div>
						</div>
					   </div>';
    }
	}	
echo "<a href='Notification.php'><p class='notif' style='position:absolute;top:16px;left:385px;font-family:arial;font-size:12;color:#9A9B9F;'> Notifications</p></a>";
	}
	else if($row ["Type"]=="Sponsor")
	{
		<?php
		$sql = "SELECT * FROM events where amtcompleted<sponsoramt and verified=0";
		// where events.username= '{$_SESSION['username']}' ";
		$result = $conn-> query($sql);
		if($result-> num_rows > 0){
			while($row = $result-> fetch_assoc()){
				$_SESSION['varname'] = $row["eid"];
				$v1=$row["eid"];
				echo '<div class="container">    
 			    <div class="row"><div class="col-sm-4"> 
				<div class="panel panel-primary">
				<div class="panel-heading"><a href="event.php?var='.$v1.'" style="color:black;">Event </a></div>
				<div class="panel-body"><img src="images.jpeg" class="img-responsive" style="width:100%" alt="Image"></div><p style="margin-left:5px">Event ID :'. $row["eid"] ."</br><p style='margin-left:5px'>Event name: ". $row["ename"].'</br><p style="margin-left:5px">Description:'. $row["descr"] .'</br></br></br>
				<a href="sponsornext.php?var='.$v1.'"><button value="Sponsor" style="margin-left:5px;margin-bottom:15px;color:white;background-color:navy;">Sponsor</button></a>
				<div class="panel-footer"></div>
				</div>
			    </div>';}
	}}
	else if($row ["Type"]=="Speaker")
	{
		
		<?php
/*		if (isset($_POST['collaborate']) )
		{
			$conn=mysqli_connect('localhost','root','');
			mysqli_select_db($conn,'authentication');
			
			
		}*/ //speaker stuff
          $curr=$_SESSION['username'];
		  // session_start();
		  $sql = "SELECT events.eid,events.ename,events.username,events.descr FROM events where events.CurrSpeakers < events.numspeakers and events.verified=0 and events.eid not in(SELECT eid from speakers where sname='$curr')" ;
		  // where events.username= '{$_SESSION['username']}' ";
		$result = $conn-> query($sql);
		if($result-> num_rows > 0){
		  while($row = $result-> fetch_assoc()){
			  $v0=$row["eid"];
				  echo '<div class="container">    
					  <div class="row"><div class="col-sm-4"> 
						<div class="panel panel-primary">
						<div class="panel-heading"><a href="event.php?var='.$v0.'" style="color:black;">Event</a></div>
						<div class="panel-body"><img src="TEDx.jpg" class="img-responsive" style="width:100%" alt="Image"></div><p style="margin-left:5px">Event ID :'. $row["eid"] ."</br><p style='margin-left:5px'>Event name: ". $row["ename"]."</br><p style='margin-left:5px'>Organiser: ". $row["username"].'</br><p style="margin-left:5px">Description : '.$row["descr"].'</br></br>
						<button style="margin-left:5px;margin-bottom:15px;background-color:navy;"><a style="color:white;" href="request.php?id='.$row["eid"].'"><h4>Speak in event</h4></a></button>
						<div class="panel-footer"></div>
						</div>
					   </div>';
					   }
    }
		
	}
	else 
	{
		<?php
		$sql = "SELECT * FROM events where verified=1";//where events.eid not in(select eid from sponsor)";
		// where events.username= '{$_SESSION['username']}' ";
		$result = $conn-> query($sql);
		if($result-> num_rows > 0){
		  while($row = $result-> fetch_assoc()){
				  $_SESSION['varname'] = $row["eid"];
					$v1=$row["eid"];
			  echo '<div class="container">    
					  <div class="row"><div class="col-sm-4"> 
						<div class="panel panel-primary">
						<div class="panel-heading"><a href="event.php?var='.$v1.'" style="color:black;">Event</a><span class="glyphicon glyphicon-ok-circle"></span></div>
						<div class="panel-body"><img src="images.jpeg" class="img-responsive" style="width:100%" alt="Image"></div><p style="margin-left:5px">Event ID :'. $row["eid"] ."</br><p style='margin-left:5px'>Event name: ". $row["ename"].'</br><p style="margin-left:5px">Description:'. $row["descr"] .'</br></br></br>
						<p style="margin-left:5px">Progress:</br>
						<div class="progress" style="margin-left:5px;margin-right:5px;">
						  <div class="progress-bar" role="progressbar" aria-valuenow="70"
						  aria-valuemin="0" aria-valuemax="100" style="width:30%">
						  <span class="sr-only">30% Complete</span>
						  </div>
						</div>
				<a href="participantnext.php?var='.$v1.'"><button value="Sponsor" style="margin-left:5px;margin-bottom:15px;color:white;background-color:gray;">JOIN</button></a>
				<div class="panel-footer"></div>
						</div>
					   </div>';}
    }}
?>
