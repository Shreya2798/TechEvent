<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
<!--The verified symbol part is almost done, we need to add an if condition and compare sponsoramt and amtcompleted.-->
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
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Events you've sponsored</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php
$conn = mysqli_connect("localhost","root","","db1");
if($conn-> connect_error){
	die("Connection failed:" . $conn -> connect_error);
}
$sql = "SELECT eid,ename FROM events";
$result = $conn-> query($sql);
if($result-> num_rows > 0){
	while($row = $result-> fetch_assoc()){
	echo '<div class="container">    
  <div class="row"><div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Event <span class="glyphicon glyphicon-ok-circle"></span></div>
        <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div><p style="margin-left:5px">Event ID :'. $row["eid"] ."</br><p style='margin-left:5px'>Event name: ". $row["ename"].'</br><p style="margin-left:5px">Description:</br></br></br>
		<p style="margin-left:5px">Progress:</br>
		<div class="progress" style="margin-left:5px;margin-right:5px;">
		  <div class="progress-bar" role="progressbar" aria-valuenow="70"
		  aria-valuemin="0" aria-valuemax="100" style="width:70%">
			<span class="sr-only">70% Complete</span>
		  </div>
		</div>
        <div class="panel-footer">Total Amount:</div>
      </div>
    </div>';}
}
?>
</div>
</div>
<footer class="container-fluid text-center"/>
</body>
</html>	