<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<style>
body  {
	background-position:center;
	background-size:595px 540px;
    background-image :url(blue.jpg);
    background-repeat:no-repeat;
}
.form-div{
	margin:auto;
	border:3px solid blue;
	width:590px;
}
.btnSubmit
{
    border:none;
    border-radius:1.5rem;
    padding:1%;
    width:20%;
    cursor:pointer;
    background:#0062cc;
    color:#fff;
}
.form-control {
	width:400px;
	border:3px solid #ced4da;
	border-radius:1.5rem;
	
}
.form-control1{
	border:3px solid #ced4da;
	border-radius:1.5rem;
}
</style>
</head>
<body class="container">


            <div class="form-div">
                <h2 style="text-align:center" >Create Your Event</h2>
<form action="submit.php" method="post" >
	<pre>
	<b>Event Name:				Username:				</br>
	<input type="text" name="ename" class="form-control1" >		<input type="text" name="username" class="form-control1" >	 </br></br>
	Event Date:                        Event Time:</br>
	<input type="text" name="edate" class="form-control1" >		<input type="text" name="etime" class="form-control1" ></br></br>
	Number of Speakers:                Maximum No. of Participants:</br>
	<input type="text" name="numspeakers" class="form-control1" >		<input type="text" name="maxparticipants" class="form-control1" ></br></br>
	sponsor Amount:                    Amount Completed:</br>
	<input type="text" name="sponsoramt" class="form-control1"  >		<input type="text" name="amtcompleted" class="form-control1" ></br></br>
	Event Description:</br>
	<input type="text" name="descr" class="form-control" ></br></br>
	<input type="submit" value="Submit"  class="btnSubmit" >
</pre>
</div>
</form>
</body>
</html>
