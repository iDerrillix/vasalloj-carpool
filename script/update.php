<?php 
    require '../dbcon.php';
    $id = $_SESSION['uID'];
    if(isset($_POST['submit'])){
        $street = $_POST['street'];
        $brgy = $_POST['brgy'];
        $city = $_POST['city'];
        $prov = $_POST['prov'];
        $phone = $_POST['uPhone'];
        $file = $_FILES['file'];
        if(!isset($_FILES['file']) || $_FILES['file']['error'] == UPLOAD_ERR_NO_FILE){
            $query = "UPDATE users SET street='$street', brgy='$brgy', city='$city', prov='$prov', uPhone='$phone' WHERE uID=$id";
        } else{
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileDestination = '../img/'.$fileName;
            move_uploaded_file($fileTmpName, $fileDestination);
            $query = "UPDATE users SET street='$street', brgy='$brgy', city='$city', prov='$prov', uPhone='$phone', prof_path='$fileName' WHERE uID=$id";
        }
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