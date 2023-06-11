<?php 
    require 'dbcon.php';

    $id = $_SESSION['uID'];
    $response = array();
    $type = $_SESSION['uType'];
    if($type == 'Passenger'){
        $query = "SELECT trip.status, users.user_status, users.alert, trip.idTrip, users.uType FROM trip JOIN trip_passengers ON trip_passengers.Trip_idTrip = trip.idTrip JOIN users ON trip_passengers.Users_idUsers = users.uID WHERE trip_passengers.Users_idUsers = $id AND trip.idTrip = (SELECT MAX(trip.idTrip) FROM trip JOIN trip_passengers ON trip_passengers.Trip_idTrip = trip.idTrip WHERE trip_passengers.Users_idUsers = $id);";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $utype = $row['uType'];
            // $_SESSION['uType'] = $utype;
            $trip_id = $row['idTrip'];
            if($row['user_status'] == 'Booked' && $row['user_status'] != $_SESSION['status']){
                $response = array('response_status' => 'success', 'heading' => 'Booking Accepted', 'paragraph' => 'Your booking has been accepted', 'alerted' => $row['alert'], 'type' => $type);
                $_SESSION['status'] = 'Booked';
            }else if($row['user_status'] == 'Waiting Confirmation' && isset($row['alert']) && $row['user_status'] != $_SESSION['status']){
                $response = array('response_status' => 'confirm', 'heading' => 'Confirmation', 'paragraph' => 'Please indicate if you are in the car or not', 'alerted' => $row['alert'], 'type' => $type);
                $_SESSION['status'] = 'Waiting Confirmation';
            }else if($row['status'] == 'Cancelled' && $row['status'] != $_SESSION['status']){
                if($row['user_status'] == 'Onboard'){
                    $query = "UPDATE users SET ticket_bal=ticket_bal+(SELECT rates.price FROM rates JOIN trip_passengers ON rates.idRates = trip_passengers.Rates_idRates WHERE trip_passengers.Trip_idTrip = (SELECT MAX(Trip_idTrip) FROM trip_passengers WHERE Users_idUsers = $id)) WHERE uID=$id;";
                    $query .= "UPDATE users SET user_status = 'Available' WHERE uID IN (SELECT Users_idUsers FROM trip_passengers WHERE Trip_idTrip = $trip_id);";
                    mysqli_multi_query($con, $query);
                    $response = array('response_status' => 'cancelled', 'heading' => 'Trip Cancelled', 'paragraph' => 'Trip was cancelled by the driver. All payments refunded', 'alerted' => $row['alert'], 'type' => $type);
                    $_SESSION['status'] = 'Cancelled';
                } else{
                    $response = array('response_status' => 'cancelled', 'heading' => 'Trip Cancelled', 'paragraph' => 'Trip was cancelled by the driver', 'alerted' => $row['alert'], 'type' => $type);
                    $_SESSION['status'] = 'Cancelled';
                }
            } else if($row['status'] == 'Completed' && $row['user_status'] == 'Finished Trip' && $row['status'] != $_SESSION['status']){
                $query = "UPDATE users SET user_status = 'Available' WHERE uID IN (SELECT Users_idUsers FROM trip_passengers WHERE Trip_idTrip = $id);";
                if(mysqli_query($con, $query)){
                    $response = array('response_status' => 'complete', 'heading' => 'Successful Trip', 'paragraph' => 'You have finished your trip', 'alerted' => $row['alert'], 'type' => $type);
                    $_SESSION['status'] = 'Completed';
                } else{
                    $response = array('response_status' => 'error', 'heading' => 'Error', 'paragraph' => 'An unexpected error has occured', 'alerted' => $row['alert'], 'type' => $type);
                    $_SESSION['status'] = 'error';
                }
            }
            else{
                $response = array('type' => $type);
            }
        }
    } else if($type == 'Driver'){
        $query = "SELECT trip.status, users.user_status, trip.idTrip, users.uType FROM trip JOIN users ON trip.Users_idUsers = users.uID WHERE trip.Users_idUsers = $id AND trip.idTrip = (SELECT MAX(trip.idTrip) FROM trip WHERE trip.Users_idUsers = $id); ";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $utype = $row['uType'];
            // $_SESSION['uType'] = $utype;
            $trip_id = $row['idTrip'];
            if($row['status'] == 'Completed' && $row['user_status'] == 'Finished Trip'){
                $query = "SELECT SUM(rates.price) AS 'price' FROM rates JOIN trip_passengers ON trip_passengers.Rates_idRates = rates.idRates WHERE trip_passengers.Trip_idTrip = $trip_id;";
                $result = mysqli_query($con, $query);
                if($result){
                    $row = mysqli_fetch_assoc($result);
                    $gain = $row['price'];
                    $alert = 0;
                    $query = "UPDATE users SET user_status = 'Available' WHERE uID IN (SELECT Users_idUsers FROM trip WHERE idTrip=$trip_id);";
                    $result = mysqli_query($con, $query);
                    if($result){
                        $response = array('response_status' => 'finished', 'heading' => 'Successful Trip', 'paragraph' => 'You gained '.$gain.' tickets from that trip', 'alerted' => $alert, 'type' => $type);
                    } else{
                        $response = array('response_status' => 'error', 'heading' => 'Error', 'paragraph' => 'An unexpected error has occured', 'alerted' => $alert , 'type' => $type);
                    }
                } else{
                    $response = array('response_status' => 'error', 'heading' => 'Error', 'paragraph' => 'An unexpected error has occured', 'alerted' => $alert, 'type' => $type);
                }
            }
        } else{
            $response = array('type' => $type);
        }
    } else{
        $response = array('response_status' => 'unknown', 'heading' => '', 'paragraph' => '', 'alerted' => 0, 'type' => $type);
    }
    $jsonResponse = json_encode($response);
    header('Content-Type: application/json');
    echo $jsonResponse;


    // require 'dbcon.php';

    // $id = $_SESSION['uID'];
    // $response = array();
    // $type = $_SESSION['uType'];
    // if($type == 'Passenger'){
    //     $query = "SELECT user_status, alert FROM users WHERE uID=$id;";
    //     $result = mysqli_query($con, $query);
    //     if($result){
    //         $row = mysqli_fetch_assoc($result);
    //         if($row['user_status'] == 'Booked'){
    //             $response = array('response_status' => 'success', 'heading' => 'Booking Accepted', 'paragraph' => 'Your booking has been accepted', 'alerted' => $row['alert'], 'type' => $type);
    //         }else if($row['user_status'] == 'Waiting Confirmation' && isset($row['alert'])){
    //             $response = array('response_status' => 'confirm', 'heading' => 'Confirmation', 'paragraph' => 'Please indicate if you are in the car or not', 'alerted' => $row['alert'], 'type' => $type);
    //         }  else{
    //             $response = array('response_status' => 'unknown', 'heading' => '', 'paragraph' => '', 'alerted' => $row['alert'], 'type' => $type);
    //         }
    //     } else{
    //         $response = array('response_status' => 'error', 'heading' => 'Error', 'paragraph' => 'An unexpected error has occured', 'alerted' => $row['alert'], 'type' => $type);
    //     }
    // }
    // $jsonResponse = json_encode($response);
    // header('Content-Type: application/json');
    // echo $jsonResponse;
?>