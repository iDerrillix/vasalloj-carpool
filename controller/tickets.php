<?php
$db = new Database(require('core/config.php'));
$balance = $db->fetch("SELECT ticket_bal FROM users WHERE uID=?", [$_SESSION['uID']])->fetch();
$pastTransactions = $db->fetch("SELECT cashtransaction.idCashTransac, cashtransaction.transac_type, cashtransaction.gcash_ref, cashtransaction.transac_amount, cashtransaction.process_fee, cashtransaction.convert_fee, cashtransaction.transac_bal, cashtransaction.transac_date, users.fname, users.mname, users.lname FROM cashtransaction JOIN users on cashtransaction.Users_idUsers = users.uID WHERE cashtransaction.Users_idUsers = ? AND cashtransaction.transac_status = 'Complete'", [$_SESSION['uID']])->fetchAll();

/* HANDLE REQUESTS */
$responses = [];
$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['buy_ticket'])){
        try{
            $ticket_bal = $db->fetch("SELECT ticket_bal FROM users WHERE uID=?", [$_SESSION['uID']])->fetch();
            $ticket_amount = $_POST['ticket_amount'];
            $transac_amount = $_POST['transac_amount'];
            $convert_fee = $_POST['convert_fee'];
            $ref_no = $_POST['ref_no'];
            $uPhone = $_POST['uPhone'];
            $new_bal = $ticket_amount + $ticket_bal['ticket_bal'];
            if($db->execQuery("INSERT INTO cashtransaction VALUES (null, 'Cash In', null, ?, 0, ?, ?, ?, ?, 'Pending', ?)", [$transac_amount, $convert_fee, $ref_no, $uPhone, $new_bal, $_SESSION['uID']])){
                $responses['buy_success'] = "Success! Please wait for the admin to send the money";
            } else{
                $errors['db_error'] = "Database error";
            }
        } catch(PDOException $e){
            dd($e->getMessage());
        }
        
    } else if(isset($_POST['sell_btn'])){
        try{
            $ticket_bal = $db->fetch("SELECT ticket_bal FROM users WHERE uID=?", [$_SESSION['uID']])->fetch();
            $ticket_amount = $_POST['ticket_sell'];
            $transac_amount = $_POST['amount_rec'];
            $process_fee = $_POST['proc_fee'];
            $uPhone = $_POST['gcash_no'];
            $new_bal = $ticket_bal['ticket_bal'] - ($ticket_amount + $process_fee);
            if($db->execQuery("INSERT INTO cashtransaction VALUES (null, 'Cash Out', null, ?, ?, 0.00, '', ?, ?, 'Pending', ?)", [$transac_amount, $process_fee, $uPhone, $new_bal, $_SESSION['uID']]) && $db->execQuery("UPDATE users SET ticket_bal = ? WHERE uID=?", [$new_bal, $_SESSION['uID']])){
                $responses['sell_success'] = "Success! Please wait for the admin to send the money";
            } else{
                $errors['db_error'] = "Database error";
            }
        } catch(PDOException $e){
            dd($e->getMessage());
        }
    }
}

include('view/partial/header.php');
require('view/tickets.view.php');