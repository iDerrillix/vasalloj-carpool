<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Registered Users</h1>
    <hr>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Email Address</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                require 'dbcon.php';

                $result = mysqli_query($con, "SELECT * FROM users");
                while($row = $result->fetch_assoc()){
                    echo "<tr><td>".$row['fname']."</td><td>".$row['mname']."</td><td>".$row['lname']."</td><td>".$row['uPhone']."</td><td>".$row['uEmail']."</td><td>".$row['uType']."</td></tr>";
                }
            ?>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>