<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Transactions</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../utilities.css">
</head>
<body>
    <?php 
    include 'sidebar.html'; 
    require '../dbcon.php';
    ?>
    <div class="container">
        <h4>Transactions</h4>
        <table class="table" style="width: 100%;">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Process Fee</th>
                    <th>Convertion Fee</th>
                    <th>Gcash Ref. ID</th>
                    <th>Gcash Account No.</th>
                    <th>Balance</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM cashtransaction WHERE transac_status='Pending';";
                    $result = mysqli_query($con, $query);
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>
                        <td>".$row['idCashTransac']."</td>
                        <td>".$row['transac_type']."</td>
                        <td>".$row['transac_date']."</td>
                        <td>".$row['transac_amount']."</td>
                        <td>".$row['process_fee']."</td>
                        <td>".$row['convert_fee']."</td>
                        <td>".$row['gcash_ref']."</td>
                        <td>".$row['gcash_no']."</td>
                        <td>".$row['transac_bal']."</td>
                        <td>".$row['transac_status']."</td>
                        <td><a href='../script/approve-transaction.php?idCashTransac=".$row['idCashTransac']."'>Approve</a></td>
                        </tr>";
                    } 
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
