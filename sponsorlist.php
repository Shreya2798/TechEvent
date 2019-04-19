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
        <li><a href="CreateEvent/index.html"><span class="glyphicon glyphicon-log-in"></span> Create Event</a></li>
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
$conn = mysqli_connect("localhost","root","","techevent");
          $sql = "SELECT * FROM registration where type='sponsor'";

          $result = $conn-> query($sql);
          if($result-> num_rows > 0){
            while($row = $result-> fetch_assoc()){
                    echo '<div class="card" style="width: 18rem;">
            <img class="card-img-top" src="sponsor.jpg" alt="Card image cap">
            <div class="card-body">
              <h3 class="card-title">User:'. $row["username"] .'</h3>
              <h4 class="card-text"> Interests:'. $row["interests"] .'</h4>
              <a href="#" class="btn btn-primary">Request</a>
            </div>
          </div>';}
          }
          ?>

    <!-- logged in user information -->
    	<p> <a href="index.php?logout='1'" class="btn btn-danger">logout</a> </p>
    <?php endif ?>
 	


		
</body>
</html>
