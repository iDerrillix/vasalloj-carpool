
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="utilities.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets | TigerRide</title>
</head>
<body>
    <div class="container" style="width: 50%; margin-top: 100px;">
        <div style="margin-top: 25px;">
            <?= "<p class='main-text' style='font-size: 32px; color: #ff710d;'><i class='fa-solid fa-ticket fa-xl' style='color: #ff710d;'></i>".$balance['ticket_bal']."</p>" ?>
            <p>Current Balance</p>
        </div>
        <button class="button" onclick="document.querySelector('#cash-in').style.display = 'block'; document.querySelector('#cash-out').style.display = 'none';">Cash-In</button>
        <?php if($_SESSION['uType'] == 'Driver'){ ?>
        <button class="button" onclick="document.querySelector('#cash-out').style.display = 'block'; document.querySelector('#cash-in').style.display = 'none';">Cash-Out</button>
        <?php } ?>
    </div>
    <div class="container" style="width: 50%; margin-top: 20px; display: none; text-align: left;" id="cash-in">
        <?php 
        if(isset($responses['buy_success'])){
            echo "<p style='color:green;'>".$responses['buy_success']."</p>
            <script>document.querySelector('#cash-in').style.display = 'block';</script>";
        }
        ?>
        <h3 class="second-text">BUY TICKETS</h3>
        <br>
        <div class="flex flex-gap-20">
            <div>
                <img src="./img/qr_code.jpg" alt="" width="200px">
            </div>
            <div style='width: 80%;'>
                <form method="POST">
                    <select name="ticket_amount" id="ticket_amount" required class="text-box">
                        <option value="40">40 Tickets</option>
                        <option value="80">80 Tickets</option>
                        <option value="200">200 Tickets</option>
                        <option value="450">450 Tickets</option>
                    </select>
                    <input type="hidden" name="transac_amount" value="50" id="transac_amount">
                    <input type="text" name="ref_no" id="" placeholder="GCash Transaction Ref. No." class="text-box" required maxlength="8">
                    <input type="tel" name="uPhone" id="" placeholder="GCash Account No." class="text-box" required>
                    <input type="submit" value="Buy Tickets" class="input-btn" name="buy_ticket" style="float: right;">
                    <p id="convertion_fee">Conversion Fee: ₱10</p>
                    <input type="hidden" name="convert_fee" value="10" id="convert_fee">
                    <p id="peso_amount">Total Cost: ₱50</p>
                </form>
            </div>
        </div>
    </div>
    <div class="container" style="width: 50%; margin-top: 20px; display: none; text-align: left;" id="cash-out">
    <?php
        if(isset($responses['sell_success'])){
            echo "<p style='color:green;'>".$responses['sell_success']."</p>
            <script>document.querySelector('#cash-out').style.display = 'block';</script>";
        }
        if($_SESSION['uType'] == 'Driver'){

        ?>
        <h3 class="second-text">SELL TICKETS</h3>
        <br>
        <form method="POST" id="sell-form">
            <input type="number" name="ticket_sell" id="ticket_sell" class="text-box" max="<?= $balance['ticket_bal'] ?>" min="1" placeholder="Enter amount of tickets to be sold" required>
            <input type="text" name="gcash_no" id="" placeholder="Enter your GCash Account No." class="text-box" required>
            <input type="hidden" name="sell_btn">
            <input type="submit" value="Sell Tickets" name="sell_ticket" class="input-btn" id="sell-tickets" style="float: right;">
            <p id="process_fee">Process Fee: </p>
            <input type="hidden" name="proc_fee" id="proc_fee" required>
            <p id="amount_receive">Amount to be received: </p>
            <input type="hidden" name="amount_rec" id="amount_rec" required>
        </form>
        <?php }?>
    </div>
    <div class="container shadow" style="margin-top: 20px; height: fit-content; width: 50%; text-align: left;">
        <h3 class="second-text">RECENT TRANSACTIONS</h3>
        <br>
        <table class="simple-table" style="width: 100%;">
                <?php
                    foreach($pastTransactions as $transaction){
                        echo "<tr>
                        <td style='color: #ff710d; font-weight: bold;'>#".$transaction['idCashTransac']."</td>
                        <td class='cell-bold'>".$transaction['transac_type']."</td>
                        <td class='second-text'>".date("M d Y g:i A", strtotime($transaction['transac_date']))."</td>
                        <td>Ref. ID: ".$transaction['gcash_ref']."</td>
                        <td>".$transaction['transac_amount']."</td>
                        <td>".$transaction['process_fee']."</td>
                        <td>".$transaction['convert_fee']."</td>
                        <td><i class='fa-solid fa-ticket fa-xl' style='color: #ff710d;'></i> ".$transaction['transac_bal']."</td>
                        </tr>";
                    }
                ?>
        </table>
    </div>
                
    <script>
        const select_ticket = document.querySelector("#ticket_amount");
        select_ticket.addEventListener("change", function(e) {
            let amount = Number(select_ticket.value);
            let fee = 0;
            switch (amount) {
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
            document.querySelector("#process_fee").innerHTML = "Process Fee: <i class='fa-solid fa-ticket fa-xl' style='color: #ff710d;'></i> " + pro_fee;
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