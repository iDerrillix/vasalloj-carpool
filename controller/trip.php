<?php
$db = new Database(require('core/config.php'));
$user_status = $db->fetch("SELECT `users`.`user_status` FROM users WHERE uID=".$_SESSION['uID']."")->fetch();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $uID = $_SESSION['uID'];
    $trip_details = $db->fetch("SELECT trip.start_location, trip.end_location, trip.seats_avail, trip.departure_date, trip.status, users.fname, users.mname, users.lname, users.prof_path, users.uPhone, users.uEmail, car.plate_no, car.car_make, car.model, driver_ratings.avg_rating, driver_ratings.rating_count FROM trip JOIN users ON trip.Users_idUsers = users.uID JOIN car ON trip.Car_idCar = car.idCar LEFT JOIN ( SELECT trip.Users_idUsers, AVG(rating.rating_stars) AS avg_rating, COUNT(rating.idRating) AS rating_count FROM trip JOIN rating ON rating.Trip_idTrip = trip.idTrip GROUP BY trip.Users_idUsers ) AS driver_ratings ON driver_ratings.Users_idUsers = users.uID WHERE trip.idTrip=?;", [$id])->fetch();
    $rates = $db->fetch("SELECT idRates, seat_position, price FROM `rates` WHERE Trip_idTrip = ?;", [$id])->fetchAll();
} else{
    header("Location: /vasalloj-carpool/"); //update this, make it so that it will display an error message to the page
}

/* HANDLE REQUESTS */
$errors = [];
$responses = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['book-ride'])){
        $seat_id = $_POST['seat_id'];
        $seat_price = $db->fetch("SELECT rates.price FROM rates WHERE rates.idRates = ?", [$seat_id])->fetch();
        $seat_price = $seat_price['price'];
        $ticket_bal = $db->fetch("SELECT `users`.`ticket_bal` FROM users WHERE uID=?", [$uID])->fetch();
        $seats_avail = $db->fetch("SELECT seats_avail FROM trip WHERE idTrip=?", [$id])->fetch();
        $seats_taken = $db->fetch("SELECT Rates_idRates FROM trip_passengers WHERE Trip_idTrip = ? AND Rates_idRates = ?", [$id, $seat_id])->fetchAll();
        if($user_status['user_status'] == 'Pending Booking'){
            $errors['pending'] = 'You have a pending booking!';
        } else if($ticket_bal['ticket_bal'] < $seat_price){
            $errors['insufficient'] = "You must have $seat_price tickets in your account to book this trip!";
        }else {
            if($seats_avail['seats_avail'] > 0){
                if(count($seats_taken) > 0){
                    $errors['taken'] = "That seat is already taken!";
                } else{
                    if($db->execQuery("INSERT INTO trip_passengers VALUES (?, 0, DEFAULT, ?, ?)", [$id, $uID, $seat_id]) && $db->execQuery("UPDATE users SET user_status='Pending Booking' WHERE uID=?", [$uID])){
                        $responses['success'] = "Successful Booking";
                    } else{
                        $errors['db_error'] = 'An unexpected error has occured!';
                    }
                }
            } else{
                $errors['no_seats'] = "All seats are already taken!";
            }
            
            
        }
        
    } else if(isset($_POST['cancel-book'])){
        if($db->execQuery("DELETE FROM trip_passengers WHERE Trip_idTrip=? AND Users_idUsers=?", [$id, $uID]) && $db->execQuery("UPDATE users SET user_status='Available' WHERE uID=?", [$uID])){
            $responses['cancelled'] = "Successfully Cancelled Booking";
        } else{
            $errors['db_error'] = "An unexpected error has occured!";
        }
    }
    
}
$user_status = $db->fetch("SELECT `users`.`user_status` FROM users WHERE uID=".$_SESSION['uID']."")->fetch(); 
$booked = $db->fetch("SELECT trip_passengers.Users_idUsers FROM trip_passengers WHERE Trip_idTrip=? AND Users_idUsers = ?", [$id, $uID])->fetchAll();
(count($booked) > 0) ? $booked = true : $booked = false;   
require 'view/partial/header.php';
require 'view/trip.view.php';