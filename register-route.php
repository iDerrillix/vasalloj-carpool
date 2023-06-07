<?php 
    require 'dbcon.php';
    if(isset($_POST['submit'])){
        $id = $_SESSION['uID'];
        $start_loc = $_POST['start_loc'];
        $end_loc = $_POST['end_loc'];
        $departure_date = $_POST['departure_date'];
        $idCar = $_POST['idCar'];
        $front_seat = $_POST['front_seat'];
        $middle_seat = $_POST['middle_seat'];
        $left_seat = $_POST['left_seat'];
        $right_seat = $_POST['right_seat'];
        
        $query = "SELECT user_status FROM users WHERE uID=$id;";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        if($row['user_status'] == 'Pending Trip'){
            header("Location: index.php?fail=pending");
            exit;
        }
        mysqli_free_result($result);
        $query = "INSERT INTO trip VALUES (null, '$start_loc', '$end_loc', '$departure_date', 4, 'Scheduled', $id, $idCar);";
        $query .= "UPDATE users SET user_status = 'Pending Trip' WHERE uID=$id";
        if(mysqli_multi_query($con, $query)){
            $trip_id = mysqli_insert_id($con);
            do {
                // Fetch results to clear the buffer
                if ($result = mysqli_store_result($con)) {
                    mysqli_free_result($result);
                }
            } while (mysqli_next_result($con));
            
            $query = "INSERT INTO rates VALUES (null, 'Front Seat', $front_seat, $trip_id), (null, 'Middle Seat', $middle_seat, $trip_id), (null, 'Left Seat', $left_seat, $trip_id), (null, 'Right Seat', $right_seat, $trip_id);";
            if(mysqli_query($con, $query)){
                header("Location: index.php?success");
                exit;
            }
        }
        
        
    }
?>