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
            
            $user = $database->fetch("SELECT * FROM users WHERE uEmail=? AND uPswd=?", [$email, $password])->fetchAll();
            $rowCount = count($user);
            $_SESSION['uID'] = $user[0]['uID'];
            $_SESSION['uType'] = $row[0]['uType'];
            $_SESSION['status'] = $row[0]['user_status'];
            if($rowCount == 1){
                if($user['uType'] == 'Admin'){
                    echo 'redirect to admin';
                } else{
                    header("Location: /vasalloj-carpool/");
                }
            } else{
                $errors['wrong'] = 'Wrong email and password';
            }
            // $query = "SELECT * FROM users WHERE uEmail='$email' AND uPswd='$password'";
            // $result = mysqli_query($con, $query);
            // $rowCount = mysqli_num_rows($result);
            // $row = mysqli_fetch_assoc($result);
            // $_SESSION['uID'] = $row['uID'];
            // $_SESSION['uType'] = $row['uType'];
            // $_SESSION['status'] = $row['user_status'];
            // if($rowCount == 1){
            //     if($row['uType'] == 'Admin'){
            //         header("Location: ./admintest/adminPanel.php");
            //         exit;
            //     } else {
            //         header("Location: index.php");
            //         exit;
            //     }
            // } else {
            //     header("Location: login.php?error=true");
            //     exit;
            // }
        }
    }
    require 'view/login.view.php';
?>