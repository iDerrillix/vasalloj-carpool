
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="utilities.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        require 'dbcon.php';
        include 'header.php';
    ?>
    <?php
        if(!isset($_SESSION['uID'])){
            header("Location: login.php?message=loginfirst");
            exit;
        }
    ?>
    <div class="container" style="width: 100%">
        <h3>You currently have</h3>
        <i class="fa-solid fa-ticket fa-2xl" style="color: #ff710d;"></i>
        <?php 
            $id = $_SESSION['uID'];
            $query = "SELECT ticket_bal FROM users WHERE uID=$id";
            $result = mysqli_query($con, $query);
            if($result){
                $row = mysqli_fetch_assoc($result);
                $bal = $row['ticket_bal'];
            }
            echo $bal;
        ?>
        <br>
        <div class="flex flex-main-spaceevenly flex-gap-20">
            
            <div style="width: 90%">
                    <?php 
                    if(isset($_GET['msg']) && $_GET['msg'] == 'buy'){
                        echo "<p style='color:green;'>Success! Please wait for the admin to approve your payment</p>";
                    }
                ?>
                <h3>Buy Tickets</h3>
                <form action="./script/buy-ticket.php" method="POST">
                    <label for="">Ticket Amount:</label>
                    <select name="ticket_amount" id="ticket_amount" required>
                        <option value="40">40 Tickets</option>
                        <option value="80">80 Tickets</option>
                        <option value="200">200 Tickets</option>
                        <option value="450">450 Tickets</option>
                    </select>
                    
                    
                    <input type="hidden" name="transac_amount" value="50" id="transac_amount">
                    <input type="text" name="ref_no" id="" placeholder="GCash Transaction Ref. No." class="text-box" required>
                    <input type="tel" name="uPhone" id="" placeholder="GCash Account No." class="text-box" required>
                    <input type="submit" value="Buy Tickets" class="button" name="submit">
                    <br><br>
                    <p id="convertion_fee">Conversion Fee: ₱10</p>
                    <input type="hidden" name="convert_fee" value="10" id="convert_fee">
                    <p id="peso_amount">Total Cost: ₱50</p>
                </form>
            </div>
            <div style="width: 90%">
                <?php 
                $id = $_SESSION['uID'];
                $query = "SELECT uType FROM users WHERE uID=$id";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                if(isset($_GET['msg'])  && $_GET['msg'] == 'sell'){
                    echo "<p style='color:green;'>Success! Please wait for the admin to send the money</p>";
                }
                if($row['uType'] == 'Driver'){

                ?>
                <h3>Sell Tickets</h3>
                <form action="./script/sell-ticket.php" method="POST" id="sell-form">
                    <?php
                        $id = $_SESSION['uID'];
                        $query = "SELECT ticket_bal FROM users WHERE uID=$id";
                        $result = mysqli_query($con, $query);
                        if($result){
                            $row = mysqli_fetch_assoc($result);
                            $bal = $row['ticket_bal'];
                        }
                    ?>
                    <label for="">Ticket Balance: <?php echo $bal; ?></label>
                    <input type="number" name="ticket_sell" id="ticket_sell" class="text-box" max="<?php echo $bal; ?>" min="1" placeholder="Enter amount of tickets to be sold" required>
                    <input type="text" name="gcash_no" id="" placeholder="Enter your GCash Account No." class="text-box" required>
                    <input type="hidden" name="sell_btn">
                    <input type="submit" value="Sell Tickets" name="sell_ticket" class="button" id="sell-tickets">
                    <br><br>
                    <p id="process_fee">Process Fee: </p>
                    <input type="hidden" name="proc_fee" id="proc_fee" required>
                    <p id="amount_receive">Amount to be received: </p>
                    <input type="hidden" name="amount_rec" id="amount_rec" required>
                    
                    
                </form>
                <?php }?>
            </div>
        </div>
            
    </div>
    <div class="container shadow" style="margin-top: 50px; height: fit-content;">
        <h3>Transaction History</h3>
        <br>
        <table class="table" style="width: 100%; height:  300px; display: block;
            overflow-x: auto;
            white-space: nowrap;">
            <thead>
                <th>Transaction ID</th>
                <th>Type</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Pro Fee</th>
                <th>Con Fee</th>
                <th>Balance</th>
            </thead>
            <tbody>
                <?php
                    $id = $_SESSION['uID'];
                    $query = "SELECT cashtransaction.idCashTransac, cashtransaction.transac_type, cashtransaction.transac_amount, cashtransaction.process_fee, cashtransaction.convert_fee, cashtransaction.transac_bal, cashtransaction.transac_date, users.fname, users.mname, users.lname FROM cashtransaction JOIN users on cashtransaction.Users_idUsers = users.uID WHERE cashtransaction.Users_idUsers = $id AND cashtransaction.transac_status = 'Complete';";
                    $result = mysqli_query($con, $query);
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>
                        <td>".$row['idCashTransac']."</td>
                        <td>".$row['transac_type']."</td>
                        <td>".$row['transac_date']."</td>
                        <td>".$row['transac_amount']."</td>
                        <td>".$row['process_fee']."</td>
                        <td>".$row['convert_fee']."</td>
                        <td>".$row['transac_bal']."</td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
                
    <script>
        const select_ticket = document.querySelector("#ticket_amount");
        select_ticket.addEventListener("mouseout", function(e) {
            let amount = Number(select_ticket.value);
            let fee = 0;
            switch(amount){
                case 40:
                    fee = 10;
                    break;
                case 80:
                    fee = 20;
                    break;
                case 200:
                    fee = 50;
                    break;
                case 450:
                    fee = 50;
                    break;
            }
            let peso = amount + fee;
            console.log(peso);
            document.querySelector("#transac_amount").value = amount + fee;
            document.querySelector("#convert_fee").value = fee;
            document.querySelector("#peso_amount").innerHTML = "Total Cost: ₱" + peso;
            document.querySelector("#convertion_fee").innerHTML = "Conversion Fee: ₱" + fee;
        });

        const ticket_amount = document.querySelector("#ticket_sell");
        ticket_amount.addEventListener("change", function(e){
            let ticket_bal = Number(document.querySelector("#ticket_sell").max);
            let tickets = Number(ticket_amount.value);
            let pro_fee = Math.floor(tickets / 1000) * 20;
            if (tickets % 1000 > 0) {
                pro_fee += 20;
            }
            document.querySelector("#process_fee").innerHTML = "Process Fee: " + pro_fee + " tickets";
            document.querySelector("#amount_receive").innerHTML = "Amount to be received: ₱" + tickets;
            document.getElementById("sell-form").reportValidity();
        });
        const sell_form = document.getElementById("sell-form");
        sell_form.addEventListener("submit", function(e){
            e.preventDefault();
            let ticket_bal = Number(document.querySelector("#ticket_sell").max);
            let tickets = Number(ticket_amount.value);
            let pro_fee = Math.floor(tickets / 1000) * 20;
            if (tickets % 1000 > 0) {
                pro_fee += 20;
            }
            if(tickets + pro_fee > ticket_bal){
                let diff = (tickets + pro_fee) - ticket_bal;
                alert("You don't have enough tickets to encash that amount! You need " + diff + " more tickets.");
                document.getElementById("sell-form").reportValidity();
            } else {
                document.querySelector("#proc_fee").value = pro_fee;
                document.querySelector("#amount_rec").value = tickets;
                document.getElementById("sell-form").submit();
            }
            
        });
    </script>
</body>
</html>