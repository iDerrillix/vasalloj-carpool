<?php
    require '../dbcon.php';
    
    $id = $_SESSION['uID'];
    $query = "SELECT ticket_bal FROM users WHERE uID=$id";
    $result = mysqli_query($con, $query);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $bal = $row['ticket_bal'];
    }
    if(isset($_POST['sell_btn'])){
        $query = "SELECT ticket_bal FROM users WHERE uID=$id";
        $result = mysqli_query($con, $query);
        if(!$result){
            echo 'error';
        }
        $row = mysqli_fetch_assoc($result);

        $ticket_amount = $_POST['ticket_sell'];
        $transac_amount = $_POST['amount_rec'];
        $process_fee = $_POST['proc_fee'];
        $uPhone = $_POST['gcash_no'];
        $new_bal = $bal - ($ticket_amount + $process_fee);
        $query = "INSERT INTO cashtransaction VALUES (null, 'Cash Out', null, $transac_amount, $process_fee, 0.00, '', '$uPhone', $new_bal, 'Pending', $id);";
        $result = mysqli_query($con, $query);
        if($result){
            header("Location: ../tickets.php?msg=sell");
        }
    } else {
        echo 'wala';
    }
?>
