<?php 
    require '../dbcon.php';

    if(isset($_GET['car_id']) && isset($_GET['uID'])){
        $car_id = $_GET['car_id'];
        $uID = $_GET['uID'];
        $query = "UPDATE users SET uType='Driver', applicant=0, ticket_bal=ticket_bal+40 WHERE uID=$uID;";
        $query .= "UPDATE car SET approved=1 WHERE idCar=$car_id";

        $result = mysqli_multi_query($con, $query);
        if($result){
            header("Location: ../admintest/adminPanel.php");
            exit;
        } else {
            echo $con -> error;
        }
    }
?>