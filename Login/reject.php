<?php
session_start();
    include('functions.php');
    $id = $_GET['id']; //SEnder
    $eid=$_SESSION['eid'];

    $query = "DELETE FROM `requests` WHERE `requests`.`eid` = '$eid' and `Sender` = '$id';";
        if(performQuery($query)){
            echo '<h3 style="color:red;">Account has been rejected. </h3>';
        }else{
            echo '<h3 style="color:red;">Unknown error occured. Please try again.</h3>';
        }
?>
<br/><br/>
<a href="Notification.php">Go to home</a>
