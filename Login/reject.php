<?php
session_start();
    include('functions.php');
    $id = $_GET['id']; //SEnder
    $eid=$_SESSION['eid'];

    $query = "DELETE FROM `requests` WHERE `requests`.`eid` = '$eid' and `Sender` = '$id';";
        if(performQuery($query)){
            echo "Account has been rejected.";
        }else{
            echo "Unknown error occured. Please try again.";
        }
?>
<br/><br/>
<a href="Notification.php">Home</a>