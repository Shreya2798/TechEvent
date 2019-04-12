<?php
session_start();
    include('functions.php');
    $id = $_GET['id'];
    $eid=$_SESSION['eid'];
    $query = "select * from `requests` where `Sender` = '$id' and `eid`='$eid' ;";
    if(count(fetchAll($query)) > 0){
        foreach(fetchAll($query) as $row){
            $curr=$_SESSION['username'];
            
            $query = "INSERT INTO `organisers` (`originalOrg`, `collabOrg`, `eid`) VALUES ( '$curr', '$id', '$eid');";
        }
        $query .= "DELETE FROM `requests` WHERE `requests`.`eid` = '$eid'and `Sender` = '$id';";
        if(performQuery($query)){
            echo "Account has been accepted.";
        }else{
            echo "Unknown error occured. Please try again.";
        }
    }else{
        echo "Error occured.";
    }
    
?>
<br/><br/>
<a href="Notification.php">Home</a>