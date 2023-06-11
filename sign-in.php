<?php 
    
    require 'dbcon.php';
    if(isset($_POST['submit'])){
        $email = $_POST['uEmail'];
        $password = $_POST['uPswd'];

        $query = "SELECT * FROM users WHERE uEmail='$email' AND uPswd='$password'";
        $result = mysqli_query($con, $query);
        $rowCount = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['uID'] = $row['uID'];
        $_SESSION['uType'] = $row['uType'];
        $_SESSION['status'] = $row['user_status'];
        if($rowCount == 1){
            if($row['uType'] == 'Admin'){
                header("Location: ./admintest/adminPanel.php");
                exit;
            } else {
                header("Location: index.php");
                exit;
            }
        } else {
            header("Location: login.php?error=true");
            exit;
        }
    }
?>