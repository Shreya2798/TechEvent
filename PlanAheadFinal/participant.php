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
  
  <?php
$conn = mysqli_connect("localhost","root","","authentication");
?>



<div class="container">
  <h2></h2>
 
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">Find other events</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
     <h3>Your Events</h3>
      <p>Here's a list of your events:</p>
        <?php
       $sql = "SELECT events.eid,events.ename,events.username FROM events INNER JOIN participants on events.eid=participants.eid where participants.username= '{$_SESSION['username']}'";
    $result = $conn-> query($sql);
    if($result-> num_rows > 0){
      while($row = $result-> fetch_assoc()){
        $v0=$row['eid'];
        echo '<div class="container">    
              <div class="row"><div class="col-sm-4"> 
                <div class="panel panel-primary">
                <div class="panel-heading"><a href="event.php?var='.$v0.'" style="color:black;">Event</a> <span class="glyphicon glyphicon-ok-circle"></span></div>
                <div class="panel-body"><img src="images.jpeg" class="img-responsive" style="width:100%" alt="Image"></div><p style="margin-left:5px">Event ID :'. $row["eid"] ."</br><p style='margin-left:5px'>Event name: ". $row["ename"].'</br><p style="margin-left:5px">Description:</br></br></br>
                <p style="margin-left:5px">Progress:</br>
                <div class="progress" style="margin-left:5px;margin-right:5px;">
                  <div class="progress-bar" role="progressbar" aria-valuenow="70"
                  aria-valuemin="0" aria-valuemax="100" style="width:70%">
                  <span class="sr-only">70% Complete</span>
                  </div>
                </div>
                <div class="panel-footer"></div>
                </div>
               </div>';}
    }
  ?>
    </div>
    
      <div id="menu1" class="tab-pane fade">
      <h3>All Events</h3>
        <p>Here's a list of all available events:</p>
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
    }
    ?>
      </div>
      </div>
    </div>


    <!-- logged in user information -->
      
    <?php endif ?>
  


    
</body>
</html>