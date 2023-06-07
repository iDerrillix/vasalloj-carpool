<?php 
    require 'dbcon.php';

    $id = $_SESSION['uID'];
    $response = array();
    $type = $_SESSION['uType'];
    if($type == 'Passenger'){
        $query = "SELECT user_status, alert FROM users WHERE uID=$id;";
        $result = mysqli_query($con, $query);
        if($result){
            $row = mysqli_fetch_assoc($result);
            if($row['user_status'] == 'Booked'){
                $response = array('response_status' => 'success', 'heading' => 'Booking Accepted', 'paragraph' => 'Your booking has been accepted', 'alerted' => $row['alert'], 'type' => $type);
            }else if($row['user_status'] == 'Waiting Confirmation' && isset($row['alert'])){
                $response = array('response_status' => 'confirm', 'heading' => 'Confirmation', 'paragraph' => 'Please indicate if you are in the car or not', 'alerted' => $row['alert'], 'type' => $type);
            }  else{
                $response = array('response_status' => 'unknown', 'heading' => '', 'paragraph' => '', 'alerted' => $row['alert'], 'type' => $type);
            }
        } else{
            $response = array('response_status' => 'error', 'heading' => 'Error', 'paragraph' => 'An unexpected error has occured', 'alerted' => $row['alert'], 'type' => $type);
        }
    }
    $jsonResponse = json_encode($response);
    header('Content-Type: application/json');
    echo $jsonResponse;
?>