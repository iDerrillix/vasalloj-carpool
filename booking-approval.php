<?php 
    require 'dbcon.php';
    if(isset($_GET['id']) && isset($_GET['book']) && isset($_GET['trip'])){
        $id = $_GET['id'];
        $trip_id = $_GET['trip'];
        if($_GET['book'] == 'false'){
            $query = "UPDATE users SET user_status='Available' WHERE uID=$id;";
            $query .= "DELETE FROM trip_passengers WHERE Users_idUsers = $id AND Trip_idTrip = $trip_id;";
            if(mysqli_multi_query($con, $query)){
                header("Location: index.php");
                exit;
            } else{
                echo 'error';
            }
        } else if($_GET['book'] == 'true'){
            $query = "UPDATE users SET user_status='Booked' WHERE uID=$id;";
            $query .= "UPDATE trip_passengers SET approved=1 WHERE Users_idUsers = $id AND Trip_idTrip = $trip_id;";
            $query .= "UPDATE trip SET seats_avail=seats_avail-1 WHERE idTrip=$trip_id;";
            if(mysqli_multi_query($con, $query)){
                header("Location: index.php");
                exit;
            } else{
                echo 'error';
            }
        }
    }
?>