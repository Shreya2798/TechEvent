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
       <a class="navbar-brand" href="home.php"><div ><img src="logo.PNG" style="position:absolute;top:4px;height:88%;width:4%;"/>    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav" style="position:absolute;left:84px;">
       <li class="active"><a href="home.php">Home</a></li>
          <?php
        if($_SESSION['Type']=="Organiser")
          {

          echo'<li><a href="createEvent.php">Create event</a></li>
               <li><a href="Notification.php"> Notifications </a></li> ';
        }          ?>


        <li><a href="yourEvents.php">My Events</a></li>
		<li><a href="#">About</a></li>
        <li><a href="#">Contact us</a></li>
        <?php
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
                    <button name="logout" style="position:absolute;top:7px;left:1520px;" class="btn btn-danger my-2">Logout</button>
            </form>
</li>
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
      <div id="home" class="tab-pane fade in active" >
      <h2 style="margin-left:20px;">Welcome <strong><?php echo $_SESSION['username']; ?></strong></h2>
      <h3 style="position:absolute;left:60px;">All Events</h3>
      <p style="position:absolute;left:60px;top:200px;">Here's a list of all events :</p>
</div>
<div style="position:absolute;left:60px;top:250px;">
    <?php
    $curr=$_SESSION['username'];
    $conn = new mysqli("localhost","root","","authentication");
	if($_SESSION['Type']=="Organiser")
	{
         $curr=$_SESSION['username'];
      $ceid=array();
   $sql = "SELECT events.eid FROM events INNER JOIN users on events.username=users.username where events.username= '$curr' UNION SELECT eid FROM organisers where collabOrg='$curr' "; // and users.type= '{$_SESSION['type']}'
$result = $conn-> query($sql);
if($result-> num_rows > 0){
  while($row1 = $result-> fetch_assoc()){
      $eid=$row1['eid'];
      array_push($ceid,0);
      $query2="SELECT eid,ename,descr,username FROM events where eid='$eid'";
      $result2 = $conn-> query($query2);
      if($result2-> num_rows > 0){
      while($row = $result2-> fetch_assoc())
      {
          array_push($ceid,$row["eid"]);
                  }
              }
          }
        } 

		$sql = "SELECT events.eid,events.ename,events.username,events.descr FROM events INNER JOIN users on events.username=users.username where events.username != '$curr'";// and events.eid not in (select eid from organisers where colabOrg='$curr')  ";
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
	}
	else if($_SESSION['Type']=="Sponsor")
	{

		$sql = "SELECT * FROM events where amtcompleted<sponsoramt and verified=0 and eid not in (SELECT eid from sponsor where username='{$_SESSION['username']}')";
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
				<div class="panel-body"><img src="TEDx.jpg" class="img-responsive" style="width:100%" alt="Image"></div><p style="margin-left:5px">Event ID :'. $row["eid"] ."</br><p style='margin-left:5px'>Event name: ". $row["ename"].'</br><p style="margin-left:5px">Description:'. $row["descr"] .'</br></br></br>
				<a href="sponsornext.php?var='.$v1.'"><button value="Sponsor" style="margin-left:5px;margin-bottom:15px;color:white;background-color:navy;">Sponsor</button></a>
				<div class="panel-footer"></div>
				</div>
			    </div>';}
	}}
	else if($_SESSION['Type']=="Speaker")
	{

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
		$sql = "SELECT * FROM events where verified=1 and eid not in (select eid from participants where username='$curr')";//where events.eid not in(select eid from sponsor)";
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
						<div class="panel-body"><img src="TEDx.jpg" class="img-responsive" style="width:100%" alt="Image"></div><p style="margin-left:5px">Event ID :'. $row["eid"] ."</br><p style='margin-left:5px'>Event name: ". $row["ename"].'</br><p style="margin-left:5px">Description:'. $row["descr"] .'</br></br></br>

				<a href="participantnext.php?var='.$v1.'"><button value="Join" style="margin-left:5px;margin-bottom:15px;color:white;background-color:blue;">JOIN</button></a>
				<div class="panel-footer"></div>
						</div>
					   </div>';}
    }
    }
?>
</div>

    <?php endif ?>

</body>
</html>