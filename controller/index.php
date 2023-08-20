<?php
    $database = new Database(require 'core/config.php');

    //fetch user info for dynamic showing
    $user_info = $database->fetch("SELECT user_status, uType FROM users WHERE uID=?;", [$_SESSION['uID']])->fetch();
    $user_status = $user_info['user_status'];
    $user_type = $user_info['uType'];

    //fetch available trips
    $tripsQuery = "SELECT
    trip.idTrip,
    trip.start_location,
    trip.end_location,
    trip.departure_date,
    trip.seats_avail,
    users.fname,
    users.lname,
    users.prof_path,
    car.car_make,
    car.model,
    trip.status,
    MIN(rates.price) AS 'price',
    driver_ratings.avg_rating,
    driver_ratings.rating_count
FROM
    trip
JOIN users ON users.uID = trip.Users_idUsers
JOIN car ON trip.Car_idCar = car.idCar
JOIN rates ON rates.Trip_idTrip = trip.idTrip
LEFT JOIN(
    SELECT trip.Users_idUsers,
        AVG(rating.rating_stars) AS avg_rating,
        COUNT(rating.idRating) AS rating_count
    FROM
        trip
    JOIN rating ON rating.Trip_idTrip = trip.idTrip
    GROUP BY
        trip.Users_idUsers
) AS driver_ratings
ON
    driver_ratings.Users_idUsers = users.uID
WHERE
    trip.status = 'Scheduled' AND trip.departure_date > CURRENT_TIMESTAMP
GROUP BY
    trip.idTrip,
    trip.start_location,
    trip.end_location,
    trip.departure_date,
    trip.seats_avail,
    users.fname,
    users.lname,
    car.car_make,
    car.model,
    trip.status;";
    $trips = $database->fetch($tripsQuery, [])->fetchAll();
    $bookedTrip = $database->fetch("SELECT * FROM trip WHERE idTrip = (SELECT MAX(Trip_idTrip) FROM trip_passengers WHERE Users_idUsers = ".$_SESSION['uID'].");", [])->fetch();
    $cars = $database->fetch("SELECT * FROM car WHERE Users_idUsers=".$_SESSION['uID']." AND approved=1")->fetchAll();

    $errors = [];
    $responses = [];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($user_type == 'Driver'){
            if(isset($_POST['register-route'])){
                $id = $_SESSION['uID'];
                $start_loc = $_POST['start_loc'];
                $end_loc = $_POST['end_loc'];
                $departure_date = $_POST['departure_date'];
                $idCar = $_POST['idCar'];
                $front_seat = $_POST['front_seat'];
                $middle_seat = $_POST['middle_seat'];
                $left_seat = $_POST['left_seat'];
                $right_seat = $_POST['right_seat'];

                if($user_status == 'Pending Trip'){
                    $errors['pending-trip'] = 'You have a pending trip!';
                } else{
                    try{
                        $database->execQuery("INSERT INTO trip VALUES (null, ?, ?, ?, 4, 'Scheduled', ?, ?)", [$start_loc, $end_loc, $departure_date, $id, $idCar]);
                        $trip_id = $database->insertID();
                        $database->execQuery("UPDATE users SET user_status = 'Pending Trip' WHERE uID=?", [$id]);
                        $database->execQuery("INSERT INTO rates VALUES (null, 'Front Seat', ?, ?), (null, 'Middle Seat', ?, ?), (null, 'Left Seat', ?, ?), (null, 'Right Seat', ?, ?)", [$front_seat, $trip_id, $middle_seat, $trip_id, $left_seat, $trip_id, $right_seat, $trip_id]);
                        $responses['route-success'] = 'Successfully registered a route';
                    } catch(PDOException $e){
                        $errors['pdo'] = 'Database error: ' . $e->getMessage() . "\n";
                    }
                } 
            }
        }
    }


    include 'view/partial/header.php';
    require('view/index.view.php');
?>