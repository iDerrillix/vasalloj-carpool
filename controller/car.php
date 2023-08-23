<?php
$db = new Database(require 'core/config.php');

/* HANDLE REQUESTS */
$errors = [];
$response = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['submit'])){
        $id = $_SESSION['uID'];
        $lic_no = $_POST['lic_no'];
        $plate_no = $_POST['plate_no'];
        $make = $_POST['make'];
        $model = $_POST['model'];
        $type = $_POST['car_type'];
        $chassis_no = $_POST['chassis_no'];
        $capacity = $_POST['capacity'];
        
        try{
            if($db->execQuery("UPDATE users SET applicant=1, lic_no=? WHERE uID=?", [$lic_no, $id]) && $db->execQuery("INSERT INTO car VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, ?, 0)", [$model, $capacity, $make, $type, $plate_no, $chassis_no, $id])){
                $response['success'] = 'Successful application';
            } else{
                $errors['db_error'] = 'Database error';
            }
        } catch(Exception $e){
            echo $e->getMessage();
        } catch(PDOException $p){
            echo $p->getMessage();
        }
    }
}

$lic_no = $db->fetch("SELECT lic_no FROM users WHERE uID=?", [$_SESSION['uID']])->fetch();
$cars = $db->fetch("SELECT * FROM car WHERE Users_idUsers=?", [$_SESSION['uID']])->fetchAll();

include('view/partial/header.php');
require('view/car.view.php');