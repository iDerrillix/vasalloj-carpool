<?php 
    require 'dbcon.php';
    $id = $_SESSION['uID'];
    if(isset($_POST['mode'])){
        if($_POST['mode'] == 'off'){
            $query = "UPDATE users SET alert=0 WHERE uID=$id";
        } else if($_POST['mode'] == 'on'){
            $query = "UPDATE users SET alert=1 WHERE uID=$id";
        }
    }
    if(mysqli_query($con, $query)){
        echo "updated alert value";
    } else{
        echo "failed to update alert value";
    }
?>