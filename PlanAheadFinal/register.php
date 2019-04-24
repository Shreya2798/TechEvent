<?php
session_start();
$user=$_POST['username'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$pass2=$_POST['pass2'];
$itype=$_POST['itype'];
$desc=$_POST['desc'];

$servername="localhost";
$dbname="authentication";

//create connection
$conn= new mysqli($servername,"root","",$dbname);

//check conn
if($conn->connect_error)
{
    die("Connection failed: ".$conn->connect_error);
}

$sql="INSERT INTO `users`(`username`,`email`,`password`,`Type`,`Interest`) VALUES ('$user','$email','$pass','$itype','$desc')";

if($conn->query(sql)== TRUE)
{
  echo "new record added";
}
else{
    echo "error:".$sql."<br>".$conn->error;
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head profile="http://www.w3.org/2005/10/profile">
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />     
<title> Register </title>
<link rel="icon" href="calender.png" type="image/png" >
    <link href="register.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet"> 
    <style>
    #msg {
    visibility: hidden;
    min-width: 250px;
    background-color:yellow;
    color: #000;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    right: 30%;
    top: 30px;
    font-size: 17px;
	margin-right:30px;
}

#msg.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
    from {top: 0; opacity: 0;} 
    to {top: 30px; opacity: 1;}
}

@keyframes fadein {
    from {top: 0; opacity: 0;}
    to {top: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {top: 30px; opacity: 1;} 
    to {top: 0; opacity: 0;}
}

@keyframes fadeout {
    from {top: 30px; opacity: 1;}
    to {top: 0; opacity: 0;}
}
        
.inputtype
{
    
    width: 240px;
    text-align: center;
    background: transparent;
    border: none;
    border-bottom: 1px solid #fff;
    font-family: 'Play', sans-serif;
    font-size: 16px;
    font-weight: 200px;
    padding: 10px 0;
    transition: border 0.5s;
    outline: none;
    color: #fff;
    
}


    </style>
</head>

<body>
 <p>   
    <?php
	if (isset($_SESSION['message'])) {
		echo "<div id='error_msg'>".$_SESSION['message']."</div>";
		unset($_SESSION['message']);
	}
?>
</p>
<div class="signup">
    <form method="post" action="register.php" style="textalign:center">
    <h2 style="color: #fff;">Sign Up</h2>
    <input type="text" name="username" placeholder="Full name" class="inputtype" required><br><br>
    <input type="text" name="email" placeholder="Email address" class="inputtype"  required><br><br> 
    <input type="password" name="pass" placeholder="Password" class="inputtype"  required><br><br>    
    <input type="password" name="pass2" placeholder="Confirm Password" class="inputtype" required><br><br>  
    <div class="inputtype">
        <label style="font:inherit;;color:lightgrey;"> Type: </label>
    
    <select name="itype" style="background:transparent;border: lightgrey,dashed;color: lightgrey; font:inherit;">
    <option value="Participant"style="background-color: grey;">Participant</option> 
    <option value="Sponsor"style="background-color: grey;">Sponsor</option> 
    <option value="Organiser"style="background-color: grey;" >Organiser</option> 
    <option value="Speaker"style="background-color: grey;">Speaker</option> 
    </select><br>
    </div> <br/>
    <div class="inputtype" >
    
    <textarea rows="5" cols="20" name="desc" placeholder="List your interests" style="background:transparent;border: lightgrey,dashed;color: lightgrey; font:inherit;align:left;"></textarea>
        </div><br>
        
       <!-- <div id="msg">Congratulations You Sign Up successfully!!</div> -->
        
        
        <script>
function myFunction() {
    var x = document.getElementById("msg");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
        
        
        <input type="submit" name="register_btn" value="Sign up" ><br><br>
        
        Already have account?<a href="logn.html" style="text-decoration: none; font-family: 'Play', sans-serif; color:#9ff;">&nbsp;Log In</a>
    </form>
    
    </div>
    
</body>
</html>
