<?php
    session_start();
    $con = mysqli_connect('localhost', 'root', '', 'carpool');
    if(!$con){
        echo 'Failed to connect';
    }
?>