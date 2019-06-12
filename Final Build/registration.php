<?php
session_start();
if (isset($_POST['submit']) ){
    
$conn=mysqli_connect('localhost','root','');
mysqli_select_db($conn,'authentication');
    
$username = $_POST['username'];
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];
$email = $_POST['email'];
$linkedin = $_POST['LinkedIn'];
$itype = $_POST['itype'];
$desc = mysqli_real_escape_string($conn,$_POST['desc']);
$message="";
$reg="";
$s="select * from users where username='$username'";
$result=mysqli_query($conn,$s);
$num=mysqli_num_rows($result);
//$row = mysqli_fetch_assoc($result)
if($num == 1)
{
    $messsage="username already exists";
}
else
{
    if($pass == $pass2){
        
    $reg="INSERT INTO users(username,password,email,LinkedIn,Type,Interest) VALUES ('$username','$pass','$email','$linkedin','$itype','$desc')";
    mysqli_query($conn,$reg);
    $_SESSION['message']="Registration success";
    $message="Registration success";
    header("location: login.php"); //redirect to home page
    }
    else
    {
        $_SESSION['message']="Two passwords dont match";
        $message="Confirm password doesn't match password";
    }
}
 mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head profile="http://www.w3.org/2005/10/profile">
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />     
<title> Register </title>
<link rel="icon" href="logo.PNG" type="image/png" >
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
		echo "<div id='error_msg' color='cyan'>".$_SESSION['message']."</div>";
		//unset($_SESSION['message']);
	}
?>
</p>
<div class="signup">
    <form method="post" style="textalign:center">
    <h2 style="color: #fff;">Sign Up</h2>
    <input type="text" name="username" placeholder="Full name" class="inputtype" required><br><br>
    <input type="text" name="email" placeholder="Email address" class="inputtype"  required><br><br> 
    <input type="text" name="LinkedIn" placeholder="Link to your LinkedIn profile" class="inputtype"  required><br><br>     
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
    
    <textarea rows="3" cols="0" name="desc" placeholder="List your interests" style="background:transparent;border: lightgrey,dashed;color: lightgrey; font:inherit;"></textarea>
        </div><br>
        
       <!-- <div id="msg">Congratulations You Sign Up successfully!!</div> -->
        
        
        <script>
function myFunction() {
    var x = document.getElementById("msg");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
        
        
        <input type="submit" name="submit" value="Sign up" ><br><br>
        
       <!-- Already have account?<a href="login.php" style="text-decoration: none; font-family: 'Play', sans-serif; color:#9ff;">&nbsp;Log In</a> -->
    </form>
    
    </div>
    
</body>
</html>