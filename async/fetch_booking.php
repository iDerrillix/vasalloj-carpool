<?php 
    require '../dbcon.php';
    $trip_id = $_POST['trip_id'];
    $data = array();
    $query = "SELECT trip_passengers.Trip_idTrip, users.uID, users.fname, users.lname, users.uPhone FROM trip_passengers JOIN users ON trip_passengers.Users_idUsers = Users.uID WHERE Trip_idTrip=$trip_id AND approved=0";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    $json = json_encode($data);

    echo $json;
    mysqli_close($con);
?>