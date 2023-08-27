<?php
$db = new Database(require('core/config.php'));

/* HANDLE REQUESTS */
$errors = [];
$responses = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['submit'])){
        $trip_id = $_POST['trip_id'];
        $stars = $_POST['stars'];
        $msg = $_POST['message'];
        $uID = $_SESSION['uID'];
        if($db->execQuery("INSERT INTO rating VALUES (DEFAULT, ?, ?, ?, ?)", [$stars, $msg, $_SESSION['uID'], $trip_id])){
            $responses['rating_success'] = "Thank you for your feedback!";
        } else{
            $errors['db_error'] = "Database error";
        }
    }
}

$tripDetails = $db->fetch("SELECT users.fname, users.lname, users.uPhone, users.prof_path, users.uEmail, users.lic_no, trip.idTrip, trip.departure_date, trip.status, car.car_make, car.model, car.plate_no, trip.start_location, trip.end_location, rates.price AS 'price', rates.seat_position, 
rating.rating_stars AS 'rating' FROM trip JOIN car ON trip.Car_idCar = car.idCar JOIN trip_passengers ON trip.idTrip = trip_passengers.Trip_idTrip JOIN rates ON rates.idRates = 
trip_passengers.Rates_idRates LEFT JOIN rating ON trip.idTrip = rating.Trip_idTrip JOIN users ON trip.Users_idUsers = users.uID WHERE trip_passengers.Users_idUsers = ? AND trip.idTrip=?", [$_SESSION['uID'], $_GET['id']])->fetch();

$driverTripDetails = $db->fetch("SELECT trip.idTrip, trip.departure_date, car.car_make, car.model, car.plate_no, trip.start_location, trip.end_location, trip.status FROM trip JOIN car ON trip.Car_idCar = car.idCar WHERE trip.Users_idUsers = ? AND trip.status = 'Completed' ORDER BY trip.departure_date DESC", [$_SESSION['uID']])->fetch();
$tripPassengers = $db->fetch("SELECT users.fname, users.lname, users.uPhone, users.prof_path, rating.rating_stars, rating.rating_msg FROM trip_passengers JOIN users ON trip_passengers.Users_idUsers = users.uID JOIN rating ON rating.Trip_idTrip = trip_passengers.Trip_idTrip WHERE trip_passengers.Trip_idTrip = ?", [$_GET['id']])->fetchAll();

include('view/partial/header.php');
require('view/past-trip.view.php');