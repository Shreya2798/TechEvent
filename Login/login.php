<?php
session_start();
if (isset($_POST['submit']) ){
    
$conn=mysqli_connect('localhost','root','');
mysqli_select_db($conn,'db1');
$username = $_POST['username'];
$pass = $_POST['password'];
//$pass_db='';
$message='';
$query="SELECT password FROM users WHERE username='$username' and password='$pass'";
$pass_db=mysqli_query($conn,$query);
//$_SESSION['password']=$pass_db;
if(isset($pass_db) )
{
   // if($pass == $pass_db)
    
        $_SESSION['message']="Registration success";
        $_SESSION['username0']=$username;
		//$_SESSION['password']=$pass_db;
        header("location: organizer.php"); //replace the file accordingle
    }
    else{
       $_SESSION['message']="Invalid Password";
	   
    }

/*else{
    $_SESSION['message']="Invalid Username";
    
}*/
mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Log In</title>
<link rel="icon" href="calender.png" type="image/png" >
<link  rel="stylesheet" type="text/css" href="login.css"/>
<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet"/>

</head>

<body>

<div class="signin">
<form method="post" >
<h3 style="color:#fff;">Log In</h3>
<p style="font-size:10px;" color='red'>   
    <?php
	if (isset($_SESSION['message'])) {
		echo "<div id='error_msg' color='red'>".$_SESSION['message']."</div>";
		unset($_SESSION['message']);
	}
    ?>
</p>
<input type="text" name="username" placeholder="Username" required class="inputtype"/><br /><br />
<input type="password" name="password" placeholder="Password" required class="inputtype" /> <br /><br />
<input type="submit" name="submit" value="Log In"/> <br/> <br/>

<!--<div id="container">
<a href="resetPass.html" style=" margin-right:0px; font-size:13px; font-family:Tahoma, Geneva, sans-serif;">Reset password?</a>
<a href="forgotPass.html" style=" margin-left:30px; font-size:13px; font-family:Tahoma, Geneva, sans-serif;">Forget password</a>
    </div><br /><br /><br /><br /><br /><br />
Don't have account?<a href="register.php" style="font-family:'Play', sans-serif;">&nbsp;Sign Up</a>
-->
</form>
</div>

</body>
</html>
