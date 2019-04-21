<?php
    session_start();
    include("functions.php");
    if($_SESSION['login']!=true)
    {
        header('location:login.php');
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Notifications</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/album/">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
  </head>
  <body>
    <header>
 <!-- <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contact</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white">Follow on Twitter</a></li>
            <li><a href="#" class="text-white">Like on Facebook</a></li>
            <li><a href="#" class="text-white">Email me</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div> -->
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="#" class="navbar-brand d-flex align-items-center">
      <strong>Album</strong>
      </a>
        
        <div class="pull-right" style="position:absolute;right:70px;">
            <?php
                if(isset($_POST["logout"]))
                   {
                       session_destroy();
                       header('location:login.php');
                   }
            ?>
            
            <form method="post">
                    <button name="logout" class="btn btn-danger my-2">Logout</button>
            </form>
        </div>
        
    </div>
  </div>
</header>

<main role="main">

  <section class="jumbotron text-center">
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
                  <a href="accept.php?id=<?php echo $row['Sender']?>"  class="btn btn-primary my-2">Accept</a>
                  <a href="reject.php?id=<?php echo $row['Sender']?>" class="btn btn-secondary my-2">Reject</a>
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
