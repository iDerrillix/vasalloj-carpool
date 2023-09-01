<?php
    $database = new Database(require 'core/config.php');
    
    //fetch user info for dynamic showing
    $user_info = $database->fetch("SELECT user_status, uType FROM users WHERE uID=?;", [$_SESSION['uID']])->fetch();
    $user_status = $user_info['user_status'];
    $user_type = $user_info['uType'];

    /* HANDLE INCOMING REQUESTS */
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
            } else if(isset($_POST['in_location']) || isset($_POST['start']) || isset($_POST['finish']) || isset($_POST['cancel'])){
                $id = $_POST['id'];
                $status = $_POST['status'];
                try{
                    switch($status){
                        case 'wait':
                            $database->execQuery("UPDATE trip SET status='Waiting' WHERE idTrip=?", [$id]);
                            $database->execQuery("UPDATE users SET user_status = 'Waiting Confirmation' WHERE uID IN (SELECT Users_idUsers FROM trip_passengers WHERE Trip_idTrip = ?)", [$id]);
                            $database->execQuery("UPDATE users SET user_status = 'In Pickup Location' WHERE uID IN (SELECT Users_idUsers FROM trip WHERE idTrip=?)", [$id]);
                            break;
                        case 'start':
                            $database->execQuery("UPDATE trip SET status='Ongoing' WHERE idTrip=?", [$id]);
                            $database->execQuery("UPDATE users SET user_status = 'In Transit' WHERE uID IN (SELECT Users_idUsers FROM trip_passengers WHERE Trip_idTrip = ?)", [$id]);
                            $database->execQuery("UPDATE users SET user_status = 'In Transit' WHERE uID IN (SELECT Users_idUsers FROM trip WHERE idTrip=?)", [$id]);
                            $_SESSION['status'] = 'trip_start';
                            break;
                        case 'finish':
                            $database->execQuery("UPDATE trip SET status='Completed' WHERE idTrip=?", [$id]);
                            $database->execQuery("UPDATE users SET user_status = 'Finished Trip' WHERE uID IN (SELECT Users_idUsers FROM trip_passengers WHERE Trip_idTrip = ?)", [$id]);
                            $database->execQuery("UPDATE users SET user_status = 'Finished Trip' WHERE uID IN (SELECT Users_idUsers FROM trip WHERE idTrip=?)", [$id]);
                            $database->execQuery("UPDATE users SET ticket_bal = ticket_bal + COALESCE( (SELECT SUM(rates.price) FROM rates JOIN trip_passengers ON trip_passengers.Rates_idRates = rates.idRates WHERE trip_passengers.Trip_idTrip = $id), 0) WHERE uID IN ( SELECT Users_idUsers FROM trip WHERE idTrip = $id)");
                            break;
                        case 'cancel':
                            $database->execQuery("UPDATE trip SET status='Cancelled' WHERE idTrip=$id");
                            $database->execQuery("UPDATE users SET user_status = 'Available' WHERE uID IN (SELECT Users_idUsers FROM trip WHERE idTrip=$id)");
                            break;
                    }
                } catch(PDOException $e){
                    $errors['db_error'] = "Database error"; 
                }
                
            }
        }
    }
    //fetch user info for dynamic showing
    $user_info = $database->fetch("SELECT user_status, uType FROM users WHERE uID=?;", [$_SESSION['uID']])->fetch();
    $user_status = $user_info['user_status'];
    $user_type = $user_info['uType'];

    /* 
        PASSENGER
        Fetching Necessary Data From Database 
    */
    if($user_type == 'Passenger'){
        //fetch available trips
        $trips = $database->fetch("SELECT
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
        trip.status;", [])->fetchAll();

    //fetch booked trip if passenger was accepted from book
    $bookedTrip = $database->fetch("SELECT * FROM trip WHERE idTrip = (SELECT MAX(Trip_idTrip) FROM trip_passengers WHERE Users_idUsers = ".$_SESSION['uID'].");", [])->fetch();

    } 
    /* 
        DRIVER
        Fetching Necessary Data From Database 
    */
    else if($user_type == 'Driver'){
        //fetch driver's registered cars
        $cars = $database->fetch("SELECT * FROM car WHERE Users_idUsers=".$_SESSION['uID']." AND approved=1")->fetchAll();
        
        //fetch ongoing trip if driver registered a trip
        $ongoingTrip = $database->fetch("SELECT idTrip, start_location, end_location, departure_date, seats_avail, status FROM `trip` WHERE Users_idUsers = ".$_SESSION['uID']." ORDER BY idTrip DESC LIMIT 1;")->fetch();

        //fetch incoming bookings from registered trip
        $incomingBookings = $database->fetch("SELECT users.uID, users.fname, users.lname, ( SELECT COUNT(*) FROM trip_passengers WHERE trip_passengers.Users_idUsers = users.uID ) AS trip_count FROM trip_passengers JOIN users ON trip_passengers.Users_idUsers = users.uID WHERE trip_passengers.Trip_idTrip = ".$ongoingTrip['idTrip']." AND trip_passengers.approved = 0;")->fetchAll();

        //fetch accepted bookings from registered trip
        $acceptedBookings = $database->fetch("SELECT 
        users.uID, users.fname, users.lname, users.prof_path, users.uPhone, users.user_status,
        rates.seat_position,
        (
            SELECT COUNT(*) 
            FROM trip_passengers 
            WHERE trip_passengers.Users_idUsers = users.uID
        ) AS trip_count
        FROM trip_passengers 
        JOIN users ON trip_passengers.Users_idUsers = users.uID
        JOIN rates ON trip_passengers.Rates_idRates = rates.idRates
        WHERE trip_passengers.Trip_idTrip = ? AND trip_passengers.approved = 1;", [$ongoingTrip['idTrip']])->fetchAll();
    }
    
    
    include 'view/partial/header.php';
    require('view/index.view.php');
?>