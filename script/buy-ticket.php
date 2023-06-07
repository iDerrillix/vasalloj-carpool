<?php
    require '../dbcon.php';
    
    $id = $_SESSION['uID'];
    
    if(isset($_POST['submit'])){
        $query = "SELECT ticket_bal FROM users WHERE uID=$id";
        $result = mysqli_query($con, $query);
        if(!$result){
            echo 'error';
        }
        $row = mysqli_fetch_assoc($result);

        $ticket_amount = $_POST['ticket_amount'];
        $transac_amount = $_POST['transac_amount'];
        $convert_fee = $_POST['convert_fee'];
        $ref_no = $_POST['ref_no'];
        $uPhone = $_POST['uPhone'];
        $new_bal = $ticket_amount + $row['ticket_bal'];
        $query = "INSERT INTO cashtransaction VALUES (null, 'Cash In', null, $transac_amount, 0, $convert_fee, '$ref_no', '$uPhone', $new_bal, 'Pending', $id);";
        $result = mysqli_query($con, $query);
        if($result){
            header("Location: ../tickets.php?msg=buy");
        }
    } else {
        echo 'wala';
    }
?>