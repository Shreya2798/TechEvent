<!--Make sure you enter appropriate db name, image path and table name -->
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


<?php
//session.start();
if (isset($_POST['collaborate']) )
{
    $conn=mysqli_connect('localhost','root','');
    mysqli_select_db($conn,'authentication');
    
    

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
      <a class="navbar-brand" href="#"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="createEvent.php">Create event</a></li> 
        <li><a href="Notification.php"> Notifications </a></li> 
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
                    <button name="logout" class="btn btn-danger my-2">Logout</button>
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
            <p style="margin-left:70px;">Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
          
            <!-- <p> Upcoming Events!</p> -->    
  
  <?php
$conn = mysqli_connect("localhost","root","","authentication");
?>



<div class="container">
  <h2></h2>
 
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">Find other events</a></li>
  </ul>

  <div class="tab-content" style="position:absolute">
    <div id="home" class="tab-pane fade in active" >
      <h3>Your Events</h3>
      <p>Here's a list of your events:</p>
    <?php
        $curr=$_SESSION['username'];
        $ceid=array();
   $sql = "SELECT events.eid FROM events INNER JOIN users on events.username=users.username where events.username= '$curr' UNION SELECT eid FROM organisers where collabOrg='$curr' "; // and users.type= '{$_SESSION['type']}' 
$result = $conn-> query($sql);
if($result-> num_rows > 0){
  while($row1 = $result-> fetch_assoc()){
      $eid=$row1['eid'];
      $query2="SELECT eid,ename,descr,username FROM events where eid='$eid'";
      $result2 = $conn-> query($query2);
      if($result2-> num_rows > 0){
      while($row = $result2-> fetch_assoc())
      {
          array_push($ceid,$row["eid"]);
	  //$total = "SELECT sponsoramt FROM events,users WHERE events.username=users.username and users.username= '{$_SESSION['username']}'";
	  //$result = $conn-> query($total);
	  //echo $result['total'];
          $v0=$row["eid"];
          echo '<div class="container">    
              <div class="row"><div class="col-sm-4"> 
                <div class="panel panel-primary">
                <div class="panel-heading"><a href="event.php?var='.$v0.'" style="color:black;">Event</a></div>
                <div class="panel-body"><img src="TEDx.jpg" class="img-responsive" style="width:100%" alt="Image"></div><p style="margin-left:5px">Event ID :'. $row["eid"] ."</br><p style='margin-left:5px'>Event name: ". $row["ename"]."</br><p style='margin-left:5px'>Organiser: ". $row["username"].'</br><p style="margin-left:5px">Description:'. $row["descr"].'</br></br></br>
                <div class="panel-footer"></div>
                </div>
               </div>';}
    }
  
}
        }
        //print_r($ceid);
    ?>
    </div>
  
    </div>
    </div>
     

  
      <div id="menu1" class="tab-pane fade">
        <h3>All Events</h3>
        <p>Here's a list of all available events:</p>
        <?php
          $curr=$_SESSION['username'];
          /*$ceid=[];
         // session_start();
        $query1="SELECT eid FROM organisers where collabOrg = '$curr'";
        $result1 = $conn-> query($sql);
        while($row1 = $result-> fetch_assoc()){

          $ceid.append($row1["eid"]);
        }*/
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
   // }
    ?>
      </div>
      </div>
    </div>


    <!-- logged in user information -->
    	
    <?php endif ?>
 	


		
</body>
</html>