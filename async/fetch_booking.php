<?php 
    require '../dbcon.php';
    $trip_id = $_POST['trip_id'];
    $data = array();
    $query = "SELECT trip_passengers.Trip_idTrip, users.uID, users.fname, users.lname, users.prof_path, users.uPhone, ( SELECT COUNT(*) FROM trip_passengers WHERE trip_passengers.Users_idUsers = users.uID ) AS trip_count FROM trip_passengers JOIN users ON trip_passengers.Users_idUsers = users.uID WHERE trip_passengers.Trip_idTrip = $trip_id AND trip_passengers.approved = 0;";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    $json = json_encode($data);

    echo $json;
    mysqli_close($con);
?>