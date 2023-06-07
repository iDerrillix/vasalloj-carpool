<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="../utilities.css">
</head>
<body>
    <?php 
    require '../dbcon.php';
    include 'sidebar.html'; 
    ?>
    <div class="flex flex-col flex-cross-center flex-gap-20">
    <div class="flex flex-gap-20" style="width:fit-content; margin: auto; ">
        <div class="container" style="min-width: 600px;">
            <h3>Cash In Transactions</h3>
            <br>
            <table class="table" style="width: 100%; height:  300px; display: block;
            overflow-x: auto;
            white-space: nowrap;">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Con Fee</th>
                </thead>
                <tbody>
                    <?php 
                        $query = "SELECT cashtransaction.idCashTransac, users.fname, users.mname, users.lname, cashtransaction.transac_amount, cashtransaction.convert_fee FROM cashtransaction JOIN users ON cashtransaction.Users_idUsers = users.uID WHERE cashtransaction.transac_status = 'Complete' AND cashtransaction.transac_type='Cash In';";
                        $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result)){
                            echo "
                            <tr>
                                <td>".$row['idCashTransac']."</td>
                                <td>".$row['fname']." ".$row['mname']." ".$row['lname']."</td>
                                <td>".$row['transac_amount']."</td>
                                <td>".$row['convert_fee']."</td>
                            </tr>
                            ";
                        }
                    ?>
                    <?php 
                        $query = "SELECT SUM(transac_amount), SUM(convert_fee) FROM cashtransaction WHERE transac_type='Cash In' AND transac_status='Complete';";
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_row($result);
                    ?>
                    <tr>
                        <td></td>
                        <td>Total: </td>
                        <td><?php echo $row[0];?></td>
                        <td><?php echo $row[1];?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="container" style="min-width: 600px;">
        <h3>Cash Out Transactions</h3>
            <br>
            <table class="table" style="width: 100%; height:  300px; display: block;
            overflow-x: auto;
            white-space: nowrap;">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Pro Fee</th>
                </thead>
                <tbody>
                    <?php 
                        $query = "SELECT cashtransaction.idCashTransac, users.fname, users.mname, users.lname, cashtransaction.transac_amount, cashtransaction.process_fee FROM cashtransaction JOIN users ON cashtransaction.Users_idUsers = users.uID WHERE cashtransaction.transac_status = 'Complete' AND cashtransaction.transac_type='Cash Out';";
                        $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result)){
                            echo "
                            <tr>
                                <td>".$row['idCashTransac']."</td>
                                <td>".$row['fname']." ".$row['mname']." ".$row['lname']."</td>
                                <td>".$row['transac_amount']."</td>
                                <td>".$row['process_fee']."</td>
                            </tr>
                            ";
                        }
                    ?>
                    <?php 
                        $query = "SELECT SUM(transac_amount), SUM(process_fee) FROM cashtransaction WHERE transac_type='Cash Out' AND transac_status='Complete';";
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_row($result);
                    ?>
                    <tr>
                        <td></td>
                        <td>Total: </td>
                        <td><?php echo $row[0];?></td>
                        <td><?php echo $row[1];?></td>
                    </tr>
                </tbody>
            </table>
    </div>
    </div>
    
        <div class="container" style="width: fit-content;">
            <h3>Balance Tickets</h3>
            <br>
            <table class="table" style="width: 100%; height:  300px; display: block;
            overflow-x: auto;
            white-space: nowrap;">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Balance</th>
                </thead>
                <tbody>
                    <?php 
                        $query = "SELECT uID, fname, mname, lname, ticket_bal FROM users WHERE uType='Passenger' OR uType='Driver';";
                        $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result)){
                            echo "
                            <tr>
                                <td>".$row['uID']."</td>
                                <td>".$row['fname']." ".$row['mname']." ".$row['lname']."</td>
                                <td>".$row['ticket_bal']."</td>
                            </tr>
                            ";
                        }
                    ?>
                    <?php 
                        $query = "SELECT SUM(ticket_bal) FROM users WHERE uType='Passenger' OR uType='Driver';";
                        $result = mysqli_query($con, $query);
                        $row = mysqli_fetch_row($result);
                    ?>
                    <tr>
                        <td></td>
                        <td>Total: </td>
                        <td><?php echo $row[0];?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>