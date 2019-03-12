<?php
    session_start();
//connect to db
$con=mysqli_connect("localhost",'root','');
mysqli_select_db($con,'authentication');
$name= $_POST['username'];
$pass=$_POST['pass'];
$pass2=$_POST['pass2'];
$email=$_POST['email'];

$s="select * from users where username = '$name'";
$result=mysqli_query($con,$s);
$num=mysqli_num_rows($result);

if(num==1)
{
    echo "Username already exists";
}

else
{
    /*$reg="insert into users(username,email,password) values ('$name','$email','$pass')";
    mysqli_query($con,$reg);
    echo "Registration successful";*/


/*if(isset($_POST['register_btn']))
{
   $username=mysqli_real_escape_string($db,$_POST['username']);
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $password=mysqli_real_escape_string($db,$_POST['pass']);
    $confpass=mysqli_real_escape_string($db,$_POST['pass2']);*/
    
    if($pass == $pass2)
    {
        //create user
       // $pass=md5($pass); //hash pwd before storing for security purpose
        
        /*$sql="INSERT INT0 users(username,email,password) VALUES('$username','$email','$password') ";
        mysqli_query($db,$sql);*/
        $reg="insert into users(username,email,password) values ('$name','$email','$pass')";
    mysqli_query($con,$reg);
    echo "Registration successful";
        
         $_SESSION['message']="Registration successful";
         $_SESSION['username']=$username;
        header("location:logn.html"); //redirect to home page -- logn.html
    }
    
    else
    {
        $_SESSION['message']="The two passwords do not match";
    }
        
    
}

?>



<!DOCTYPE html>
<html>
<head>
    
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
    
<title>Untitled Document</title>
<link href="sgnup.css" rel="stylesheet" type="text/css" />
<!-- <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet"> -->
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
    </style>
</head>

<body>
    
    <?php
	if (isset($_SESSION['message'])) {
		echo "<div id='error_msg'>".$_SESSION['message']."</div>";
		unset($_SESSION['message']);
	}
?>
<div class="signup">
    <form method="post" action="register.php">
    <h2 style="color: #fff;">Sign Up</h2>
    <input type="text" name="username" placeholder="Full name" required><br><br>
    <input type="text" name="email" placeholder="Email address" required><br><br> 
    <input type="password" name="pass" placeholder="Password" required><br><br>    
    <input type="password" name="pass2" placeholder="Confirm Password" required><br><br>   
     
        <div id="msg">Congratulations You Sign Up successfully!!</div>
        <script>
function myFunction() {
    var x = document.getElementById("msg");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
</script>
        <input type="submit" name="register_btn" value="Sign up" ><br><br>
    
        Already have account?<a href="logn.html" style="text-decoration: none; font-family: 'Play', sans-serif; color: yellow;">&nbsp;Log In</a>
    </form>
    
    </div>
</body>
</html>
