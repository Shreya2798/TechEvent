<?php
session_start();
//echo "{$_SESSION['username']}";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "authentication";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$uname = $_SESSION['username'];
if(isset($_GET['var'])){
  $eid = $_GET['var']; //some_value
}  //id from previous page

$sql = "INSERT INTO participants (username, eid) VALUES ('$uname', '$eid')";
if (mysqli_query($conn,$sql)) {
  //  echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>

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
<h2>
  Thank you for registering for the event! Event details will be updated to your account!
</h2>

</body>
</html>