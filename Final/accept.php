<?php
session_start();

    include('functions.php');
    $conn = new mysqli('localhost', 'root', '', 'authentication');
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    } 
    $id = $_GET['id'];
    $eid=$_SESSION['eid'];
    $q1="SELECT Type from users where username='$id'";
    $result1=$conn->query($q1);
    $row1 = $result1->fetch_assoc();
    if($row1["Type"]== "Organiser")
    {
        $query = "select * from `requests` where `Sender` = '$id' and `eid`='$eid' ;";
        if(count(fetchAll($query)) > 0){
            foreach(fetchAll($query) as $row){
                $curr=$_SESSION['username'];

                $query = "INSERT INTO `organisers` (`originalOrg`, `collabOrg`, `eid`) VALUES ( '$curr', '$id', '$eid');";
            }
            $query .= "DELETE FROM `requests` WHERE `requests`.`eid` = '$eid'and `Sender` = '$id';";
            if(performQuery($query)){
                echo '<h3 style="color:green;">Request has been accepted. </h3>';
            }else{
                echo '<h3 style="color:red;">Unknown error occured. Please try again.</h3>';
            }
        }else{
             echo '<h3 style="color:red;">Error occured. </h3>';
        }
    }
    
    else if($row1["Type"]== "Speaker")
    {
        $q2="UPDATE events SET CurrSpeakers=CurrSpeakers+1 WHERE eid='$eid'";
        if ($conn->query($q2) === TRUE) 
        {
           // echo '<script> alert("Record updated successfully");</script>';
        } 
        else 
        {
            echo '<script> alert("Error updating record");</script>';
        
        }

        $query = "select * from `requests` where `Sender` = '$id' and `eid`='$eid' ";
        
        if(count(fetchAll($query)) > 0)
        {
            foreach(fetchAll($query) as $row)
            {
                $curr=$_SESSION['username'];

                $query = "INSERT INTO `speakers` (`sname`,`eid`) VALUES ( '$id', '$eid');";
            }
            
            $query .= "DELETE FROM `requests` WHERE `requests`.`eid` = '$eid'and `Sender` = '$id';";
            
            if(performQuery($query))
            {
                echo '<h3 style="color:green;">Request has been accepted. </h3>';
            }
            else
            {
                echo '<h3 style="color:red;">Unknown error occured. Please try again.</h3>';
            }
        }
        else{
             echo '<h3 style="color:red;">Error occured. </h3>';
        }
    }

else //for sponsor
{
    
}


?><html>
    <head>
        <link rel="icon" href="logo.PNG" type="image/png" >
    </head>
<br/><br/>
<a href="Notification.php" style="color:green;">Request accepted</a>
    <?php
echo "<script>setTimeout(\"location.href = 'home.php';\",500);</script>";
    ?>
</html>