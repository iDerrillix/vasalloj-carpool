<?php
    require './dbcon.php';
    if(isset($_SESSION['fname']) && isset($_SESSION['mname']) && isset($_SESSION['lname']) && isset($_SESSION['phone']) && isset($_SESSION['email']) && isset($_SESSION['pswd'])){
        $fname = $_SESSION['fname'];
        $mname = $_SESSION['mname'];
        $lname = $_SESSION['lname'];
        $phone = $_SESSION['phone'];
        $bday = $_SESSION['bday'];
        $street = $_SESSION['street'];
        $brgy = $_SESSION['brgy'];
        $city = $_SESSION['city'];
        $prov = $_SESSION['prov'];
        $email = $_SESSION['email'];
        $password = $_SESSION['pswd'];
        $utype = 'Passenger';
        
        $result = mysqli_query($con, "INSERT INTO users VALUES (null, '$fname', '$mname', '$lname', '$phone', '$bday', '$street', '$brgy', '$city', '$prov',  '$email', '$password', '$utype', 10, null, 0, 'Available', 0, DEFAULT);");
        if($result){
            header("Location: ./login.php?verified");
            exit;
        } else {
            echo 'failed'.$con -> error;
        }


    }
?>