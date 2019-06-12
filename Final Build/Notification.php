<?php 
include("functions.php");
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
  <title>Notifications</title>
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
        <a class="navbar-brand" href="home.php"><div ><img src="logo.PNG" style="position:absolute;top:4px;height:88%;width:4%;"/>    </div> </a>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav" style="position:absolute;left:84px;">
        <li><a href="home.php">Home</a></li>
        <li><a href="createEvent.php">Create event</a></li>
        <li class="active"><a href="Notification.php"> Notifications </a></li>  
          <li><a href="yourEvents.php">My Events</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact us</a></li>
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
            </form></li>
      </ul>
    </div>
  </div>
</nav>

 
<main role="main">

  <section class="jumbotron text-center" style="position:absolute;top:55px;width:100% ">
    <div class="container">
      <?php
        $curr=$_SESSION['username'];
        $query="select * from `requests` where Reciever='$curr';";
        if(count(fetchAll($query))>0)
        {
            foreach(fetchAll($query) as $row)
            {
             $_SESSION['eid']=$row['eid'];
        
            ?>
              
              <h1 class="jumbotron-heading"><?php echo $row['Sender'] ?> </h1>
              <p class="lead text-muted">Type: <?php echo $row['sType'] ?> </p> 
              <p class="lead text-muted">Requests to collaborate for event -   <?php echo $row['ename']." (Event ID: ". $row['eid'].")" ?>
              <br/><p class="lead text-muted">LinkedIn profile: <span style="color:blue;"> <?php echo $row['sLinkedin'] ?></span> </p> 
              <p>
                  <a href="accept.php?id=<?php echo $row['Sender']?>" class="btn btn-primary my-2">Accept</a>
                  <a href="reject.php?id=<?php echo $row['Sender']?>" class="btn btn-danger">Reject</a>
              </p> 
            <small><i><?php echo $row['date'] ?></i></small>
        <?php

            }
        }
        else{
            echo "No pending requests";
        }
        
                   
      ?>
      
    </div>
  </section>

</main>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    
    
</body>
</html>