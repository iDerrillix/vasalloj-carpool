<?php 
    require '../dbcon.php';
    $id = $_SESSION['uID'];
    if(isset($_POST['submit'])){
        $street = $_POST['street'];
        $brgy = $_POST['brgy'];
        $city = $_POST['city'];
        $prov = $_POST['prov'];
        $phone = $_POST['uPhone'];

        $query = "UPDATE users SET street='$street', brgy='$brgy', city='$city', prov='$prov', uPhone='$phone' WHERE uID=$id";
        $result = mysqli_query($con, $query);
        if($result){
            header("Location: ../profile.php?status=success");
            exit;
        } else {
            header("Location: ../profile.php?status=fail");
            exit;
        }
    }
?>