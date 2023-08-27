<?php

$database = new Database(require 'core/config.php');
$id = $_SESSION['uID'];

/* HANDLE REQUESTS */
$errors = [];
$responses = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['submit'])){
        $street = $_POST['street'];
        $brgy = $_POST['brgy'];
        $city = $_POST['city'];
        $prov = $_POST['prov'];
        $phone = $_POST['uPhone'];
        $file = $_FILES['file'];
        if(!isset($_FILES['file']) || $_FILES['file']['error'] == UPLOAD_ERR_NO_FILE){
            if($database->execQuery("UPDATE users SET street=?, brgy=?, city=?, prov=?, uPhone=? WHERE uID=?", [$street, $brgy, $city, $prov, $phone, $id])){
                $responses['success'] = "Successfully Updated";
            } else{
                $errors['db_error'] = "Database error";
            }
        } else{
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileDestination = '../img/'.$fileName;
            move_uploaded_file($fileTmpName, $fileDestination);
            if($database->execQuery("UPDATE users SET street=?, brgy=?, city=?, prov=?, uPhone=?, prof_path=? WHERE uID=?", [$street, $brgy, $city, $prov, $phone, $fileName, $id])){
                $responses['success'] = "Successfully Updated";
            } else{
                $errors['db_error'] = "Database error";
            }
        }
    }
}

$user = $database->fetch("SELECT * FROM users WHERE uID=?", [$_SESSION['uID']])->fetch();
$passengerTrips = $database->fetch("SELECT trip.idTrip, trip.departure_date, car.car_make, car.model, car.plate_no, trip.start_location, trip.end_location, rates.price AS 'price', rating.rating_stars AS 'rating' FROM trip JOIN car ON trip.Car_idCar = car.idCar JOIN trip_passengers ON trip.idTrip = trip_passengers.Trip_idTrip JOIN rates ON rates.idRates = trip_passengers.Rates_idRates LEFT JOIN rating ON trip.idTrip = rating.Trip_idTrip WHERE trip_passengers.Users_idUsers = ? AND trip.status = 'Completed';", [$id])->fetchAll();
$driverTrips = $database->fetch("SELECT trip.idTrip, trip.departure_date, car.car_make, car.model, car.plate_no, trip.start_location, trip.end_location FROM trip JOIN car ON trip.Car_idCar = car.idCar WHERE trip.Users_idUsers = ? AND trip.status = 'Completed' ORDER BY trip.departure_date DESC", [$id])->fetchAll();

include('view/partial/header.php');
require('view/profile.view.php');