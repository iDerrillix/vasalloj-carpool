<?php
    require '../dbcon.php';
    if(isset($_GET['idCashTransac'])){
        $query = "SELECT * FROM cashtransaction WHERE idCashTransac=".$_GET['idCashTransac'].";";
        $result = mysqli_query($con, $query);
        if(!$result){
            echo 'error';
            exit;
        }
        $row = mysqli_fetch_assoc($result);
        $transac_type = $row['transac_type'];
        $transac_amount = $row['transac_amount'];
        $process_fee = $row['process_fee'];
        $convert_fee = $row['convert_fee'];
        $uID = $row['Users_idUsers'];


        $query = "SELECT ticket_bal FROM users WHERE uID=$uID;";
        $result = mysqli_query($con, $query);
        if(!$result){
            echo 'error';
            exit;
        }
        $row2 = mysqli_fetch_assoc($result);
        $bal = $row2['ticket_bal'];
        
        if($transac_type == 'Cash In'){
            $new_bal = ($transac_amount - $convert_fee) + $bal;
            
        } else if($transac_type == 'Cash Out'){
            $new_bal = $bal - ($transac_amount + $process_fee);
        }
        $query = "UPDATE users SET ticket_bal=$new_bal WHERE uID=$uID;";
        $query .= "UPDATE cashtransaction SET transac_status='Complete' WHERE idCashTransac=".$_GET['idCashTransac'].";";
        $result = mysqli_multi_query($con, $query);
        if($result){
            header("Location: ../admin/approve-transactions.php");
        }
    }
?>