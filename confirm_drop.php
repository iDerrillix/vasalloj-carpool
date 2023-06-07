<?php 
    require './dbcon.php';
    $response = array();
    if(isset($_POST['action']) && isset($_POST['id'])){
        $uID = $_SESSION['uID'];
        $action = $_POST['action'];
        $id = $_POST['id'];
        if($action == 'confirm'){
            $query = "UPDATE users SET user_status='Onboard' WHERE uID=$uID;";
            $query .= "UPDATE users SET ticket_bal=ticket_bal - (SELECT price FROM rates WHERE idRates = (SELECT Rates_idRates FROM trip_passengers WHERE Trip_idTrip = (SELECT MAX(Trip_idTrip) FROM trip_passengers WHERE Users_idUsers = $uID) AND Users_idUsers = $uID)) WHERE uID=$uID;";
            $response = array('response_status' => 'onboard_success', 'heading' => 'Successful Confirmation', 'paragraph' => 'Payment deducted from your account');
        } else if($action == 'drop'){
            $query = "UPDATE users SET user_status='Available' WHERE uID=$uID;";
            $query .= "UPDATE users SET ticket_bal = ticket_bal-30 WHERE uID=$uID;";
            $query .= "UPDATE users SET ticket_bal = ticket_bal+30 WHERE uID=(SELECT Users_idUsers FROM trip WHERE idTrip=$id);";
            $query .= "UPDATE trip SET seats_avail=seats_avail+1 WHERE idTrip=$id;";
            $query .= "DELETE FROM trip_passengers WHERE Users_idUsers=$uID AND Trip_idTrip=$id;";
            $response = array('response_status' => 'drop_success', 'heading' => 'Trip Dropped', 'paragraph' => 'A cancellation fee of 30 tickets was deducted from your account');
        }
        $result = mysqli_multi_query($con, $query);
        if(!$result){
            $response = array('response_status' => 'fail', 'heading' => 'Error', 'paragraph' => 'An error has occured');
        }
        $jsonEncode = json_encode($response);
        header('Content-Type: application/json');
        echo $jsonEncode;
    }
?>