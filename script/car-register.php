<?php 
    require '../dbcon.php';
    echo 'test';
    if(isset($_POST['submit'])){
        $id = $_SESSION['uID'];
        $lic_no = $_POST['lic_no'];
        $plate_no = $_POST['plate_no'];
        $make = $_POST['make'];
        $model = $_POST['model'];
        $type = $_POST['car_type'];
        $chassis_no = $_POST['chassis_no'];
        $capacity = $_POST['capacity'];

        $query = "UPDATE users SET applicant=1, lic_no='$lic_no' WHERE uID=$id;";
        $query .= "INSERT INTO car VALUES ('', '$model', $capacity, '$make', '$type', '$plate_no', '$chassis_no', $id, 0);";
        $result = mysqli_multi_query($con, $query);
        if($result){
            header("Location: ../index.php");
            exit;
        } else {
            echo "error";
        }
        echo 'test1';
    }
    echo 'test';
?>