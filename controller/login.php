<?php
    session_start();
    $config = require('core/config.php');
    $database = new Database($config);
    $errors = [];
    if(isset($_SESSION['uID'])){
        unset($_SESSION['uID']);
        unset($_SESSION['status']);
        unset($_SESSION['uType']);
    } 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['submit'])){
            $email = $_POST['uEmail'];
            $password = $_POST['uPswd'];
            
            $user = $database->fetch("SELECT * FROM users WHERE uEmail=?", [$email])->fetchAll();
            $rowCount = count($user);
            if(password_verify($password, $user[0]['uPswd'])){
                //Authenticated
                $_SESSION['uID'] = $user[0]['uID'];
                $_SESSION['uType'] = $user[0]['uType'];
                $_SESSION['status'] = $user[0]['user_status'];

                //authorize to correct page
                if($user['uType'] == 'Admin'){
                    echo 'redirect to admin';
                } else{
                    header("Location: /vasalloj-carpool/");
                }
            } else{
                $errors['wrong'] = 'Wrong email and password';
            }
        }
    }
    require 'view/login.view.php';
?>