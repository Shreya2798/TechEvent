<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
<style type="text/css">
    select {
        width: 150px;
        margin: 10px;
    }
    select:focus {
        min-width: 250px;
        width: auto;
    }    
</style>
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
	<div class="input-group">
  	  <label>Select Type:</label>
	<select name="type">
  	<option value="Organiser">Organiser</option>
 	<option value="Speaker">Speaker</option>
  	<option value="Sponser">Sponser</option>
 	<option value="Participant">Participant</option>
	</select>
	</div>
	<div class="input-group">
  	  <label>Interests:</label>
	<textarea class='autoExpand' rows='3' cols=50% data-min-rows='3' placeholder='Enter text here' name="interests"></textarea>
  	  
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>