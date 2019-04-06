<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  
  if (isset($_GET['logout'])) {
  	session_destroy();
  	//unset($_SESSION['username']);
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
</head>
<body>


 
<div class="content">
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
            <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p> Upcoming Events!</p>    
  
  <?php
$conn = mysqli_connect("localhost","root","","techevent");
$username = mysqli_real_escape_string($conn, $_POST['username']);
if($conn-> connect_error){
  die("Connection failed:" . $conn -> connect_error); 
}
$sql = "SELECT events.eid,events.ename,events.username FROM events INNER JOIN registration on events.username=registration.username";

$result = $conn-> query($sql);
if($result-> num_rows > 0){
  while($row = $result-> fetch_assoc()){
  echo '<div class="container">    
  <div class="row">
  <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Event </div>
        <div class="panel-body"><img src="images.jpg" class="img-responsive" style="width:50%" alt="Image"></div>
        <p style="margin-left:5px">Event ID :'. $row["eid"] ."</br>
        <p style='margin-left:5px'>Event name: ". $row["ename"].'</br>
      </div>
      </div>
      </div>
    </div>';}
}
?>
    <!-- logged in user information -->
    	<p> <a href="index.php?logout='1'" class="btn btn-danger">logout</a> </p>
    <?php endif ?>
 	
</div>

		
</body>
</html>
