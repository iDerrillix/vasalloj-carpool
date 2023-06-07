<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Cars</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../utilities.css">
</head>
<body>
<?php include 'sidebar.html'; ?>
    <div class="container">
        <h4>List of Driver Applicants</h4>
        <table class="table" style="width: 100%;">
            <thead>
                <tr>
                    <th>Owner</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Plate No.</th>
                    <th>Chassis No.</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    require '../dbcon.php';

                    $query = "SELECT users.uID, car.idCar, users.fname, users.mname, users.lname, car.car_make, car.model, car.plate_no, car.chassis_no, car.type FROM users JOIN car ON users.uID = car.Users_idUsers WHERE users.applicant=1 OR car.approved=0;";
                    $result = mysqli_query($con, $query);
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>
                        <td>".$row['fname']." ".$row['mname']." ".$row['lname']."</td>
                        <td>".$row['car_make']."</td>
                        <td>".$row['model']."</td>
                        <td>".$row['plate_no']."</td>
                        <td>".$row['chassis_no']."</td>
                        <td>".$row['type']."</td>
                        <td><a href='../script/approve.php?uID=".$row['uID']."&car_id=".$row['idCar']."'>Approve</a></td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
