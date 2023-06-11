<?php 
    require 'dbcon.php';
    if(isset($_GET['id']) && isset($_GET['status'])){
        $id = $_GET['id'];
        $status = $_GET['status'];
        if($_GET['status'] == 'wait'){
            $query = "UPDATE trip SET status='Waiting' WHERE idTrip=$id;";
            $query .= "UPDATE users SET user_status = 'Waiting Confirmation' WHERE uID IN (SELECT Users_idUsers FROM trip_passengers WHERE Trip_idTrip = $id);";
            $query .= "UPDATE users SET user_status = 'In Pickup Location' WHERE uID IN (SELECT Users_idUsers FROM trip WHERE idTrip=$id);";
            $result = mysqli_multi_query($con, $query);
            if($result){
                header("Location: index.php");
                exit;
            } else{
                echo "error";
            }
        } else if($_GET['status'] == 'start'){
            $query = "UPDATE trip SET status='Ongoing' WHERE idTrip=$id;";
            $query .= "UPDATE users SET user_status = 'In Transit' WHERE uID IN (SELECT Users_idUsers FROM trip_passengers WHERE Trip_idTrip = $id);";
            $query .= "UPDATE users SET user_status = 'In Transit' WHERE uID IN (SELECT Users_idUsers FROM trip WHERE idTrip=$id);";
            $_SESSION['status'] = 'trip_start';
            $result = mysqli_multi_query($con, $query);
            if($result){
                header("Location: index.php");
                exit;
            } else{
                echo "error";
            }
        } else if ($_GET['status'] == 'finish'){
            $query = "UPDATE trip SET status='Completed' WHERE idTrip=$id;";
            $query .= "UPDATE users SET user_status = 'Finished Trip' WHERE uID IN (SELECT Users_idUsers FROM trip_passengers WHERE Trip_idTrip = $id);";
            $query .= "UPDATE users SET user_status = 'Finished Trip' WHERE uID IN (SELECT Users_idUsers FROM trip WHERE idTrip=$id);";
            $query .= "UPDATE users SET ticket_bal = ticket_bal + (SELECT SUM(rates.price) FROM rates JOIN trip_passengers ON trip_passengers.Rates_idRates = rates.idRates WHERE trip_passengers.Trip_idTrip = $id) WHERE uID IN (SELECT Users_idUsers FROM trip WHERE idTrip=$id);";
            $result = mysqli_multi_query($con, $query);
            if($result){
                header("Location: index.php");
                exit;
            } else{
                echo "error";
            }
        } else if ($_GET['status'] == 'cancel'){
            $query = "UPDATE trip SET status='Cancelled' WHERE idTrip=$id;";
            $query .= "UPDATE users SET user_status = 'Available' WHERE uID IN (SELECT Users_idUsers FROM trip WHERE idTrip=$id);";
            $result = mysqli_multi_query($con, $query);
            if($result){
                header("Location: index.php");
                exit;
            } else{
                echo "error";
            }
        }
    }
?>