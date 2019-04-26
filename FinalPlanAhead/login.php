<?php
session_start();

//if already logged in, redirect to index.php i.e. home page

if( isset($_SESSION['username']))
{
    header("location: home.php"); // change to home.php
            /*if($_SESSION['Type']=="Sponsor")
            {
                header("location: sponsor.php"); //replace the file accordingly
            }
            else if($_SESSION['Type']=="Participant")
            {
                header("location: participant.php"); //replace the file accordingly
            }
            else if($_SESSION['Type']=="Speaker")
            {
                header("location: speaker.php"); //replace the file accordingly
            }
            else 
            {
                header("location: organiser.php"); //replace the file accordingly
            }*/
}

if (isset($_POST['submit']) ){
    
/*$conn=mysqli_connect('localhost','root','');
mysqli_select_db($conn,'authentication');*/
$conn = new mysqli('localhost', 'root', '', 'authentication');
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$_SESSION['message']="";
$username = $_POST['username'];
$pass = $_POST['password'];
$pass_db='';
$query="SELECT password,Type FROM users WHERE username='$username'";
$result=$conn->query($query);
$row = $result->fetch_assoc();
//$pass_db=$row ["password"];

if(isset($row ["password"]))
{
    if($pass == $row ["password"])
    {
        //echo $row ["Type"];
            $_SESSION['message']="Login success";
            $_SESSION['username']=$username;
            $_SESSION['login']=true; 
        $_SESSION['Type']=$row ["Type"];
                
        header("location: home.php"); // change to home.php
        
            /*//redirecting to pages based on type of user
            if($row ["Type"]=="Sponsor")
            {
                header("location: sponsor.php"); //replace the file accordingly
            }
            else if($row["Type"]=="Participant")
            {
                header("location: participant.php"); //replace the file accordingly
            }
            else if($row["Type"]=="Speaker")
            {
                header("location: speaker.php"); //replace the file accordingly
            }
            else 
            {
                header("location: organiser.php"); //replace the file accordingly
            }
*/        
    }
    
    else
    {
       $_SESSION['message']="Invalid Password";
    }
}

else{
    $_SESSION['message']="Invalid Username";
    
}
mysqli_close($conn);

}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Log In</title>
<link rel="icon" href="logo.PNG" type="image/png" >
<link  rel="stylesheet" type="text/css" href="login.css"/>
<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet"/>

</head>

<body>

<div class="signin">
<form method="post">
<h3 style="color:#fff;">Log In</h3>
<p style="font-size:10px;color:red" color='red'>   
    <?php
	if (isset($_SESSION['message'])) {
		echo "<div id='error_msg' style='font-size:17px;color:red' >".$_SESSION['message']."</div>";
		unset($_SESSION['message']);
	}
    ?>
</p>
<input type="text" name="username" placeholder="Username" required class="inputtype"/><br /><br />
<input type="password" name="password" placeholder="Password" required class="inputtype" /> <br /><br />
<input type="submit" name="submit" value="Log In"/> <br/> <br/>

<div id="container">
<!--<a href="resetPass.html" style=" margin-right:0px; font-size:13px; font-family:Tahoma, Geneva, sans-serif;">Reset password?</a>  -->
<!--<a href="forgotPass.html" style=" margin-left:30px; font-size:13px; font-family:Tahoma, Geneva, sans-serif;">Forget password</a> -->
    </div>
    <!--<br /><br /><br /><br />-->
    <br /><br />
Don't have account?<a href="registration.php" style="font-family:'Play', sans-serif;">&nbsp;Sign Up</a>

</form>
</div>

</body>
</html>