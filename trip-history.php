<?php
    require 'dbcon.php';
    if(isset($_POST['submit'])){
        $trip_id = $_POST['trip_id'];
        $stars = $_POST['stars'];
        $msg = $_POST['message'];
        $uID = $_SESSION['uID'];
        $query = "INSERT INTO rating VALUES (DEFAULT, $stars, '$msg', $uID, $trip_id)";
        if(mysqli_query($con, $query)){
            header("Location: trip-history.php?id=$trip_id&status=success");
            exit;
        } else{
            header("Location: trip-history.php?id=$trip_id&status=fail");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="utilities.css">
    <link rel="stylesheet" href="flex.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        
        include 'header.php'; 
        if(!isset($_SESSION['uID'])){
            header("Location: login.php?message=loginfirst");
            exit;
        }
        $id = $_SESSION['uID'];
        $trip_id = $_GET['id'];
        $query = "SELECT users.fname, users.lname, users.uPhone, users.uEmail, users.lic_no, trip.idTrip, trip.departure_date, trip.status, car.car_make, car.model, car.plate_no, trip.start_location, trip.end_location, rates.price AS 'price', rates.seat_position, 
        rating.rating_stars AS 'rating' FROM trip JOIN car ON trip.Car_idCar = car.idCar JOIN trip_passengers ON trip.idTrip = trip_passengers.Trip_idTrip JOIN rates ON rates.idRates = 
        trip_passengers.Rates_idRates LEFT JOIN rating ON trip.idTrip = rating.Trip_idTrip JOIN users ON trip.Users_idUsers = users.uID WHERE trip_passengers.Users_idUsers = $id AND trip.idTrip=$trip_id;";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        
    ?>
    <div class="container" style="min-width: fit-content; max-width: 30%; margin-top: 20px; margin: 20px auto; text-align: left;">
        <?php if(isset($_GET['status'])){
            if($_GET['status'] == 'success'){
                echo "<p style='background-color: #b9ff94; color: green; border-radius: 3px; padding: 0.3em 1.2em; margin-bottom: 20px; text-align: center;'>Thank you for your feedback!</p>";
            } else{
                echo "<p style='background-color: #ff9b94; color: red; border-radius: 3px; padding: 0.3em 1.2em; margin-bottom: 20px; text-align: center;'>An error has occured. Could not submit rating.</p>";
            }
        }
        ?>
        <div class="flex flex-main-spacebetween">
            <div>
                <h3 style='color: #ff710d;'> Trip No. <?php echo $row['idTrip'];?></h3>
        
                <p><?php echo date("d M Y - g:i A", strtotime($row['departure_date']));?></p>
                <p>Kia Stonic CBM-7625</p>
                <br>
                <p style='color: #ff710d;'><i class='fa-solid fa-location-pin'></i> <?php echo $row['start_location'];?></p>
                <p style='color: #ff710d;'><i class='fa-solid fa-location-dot'></i> <?php echo $row['end_location'];?></p>
            </div>
            <div style="text-align: right;">
                <p><?php echo $row['status'];?></p>
                <p><?php echo $row['seat_position'];?></p>
                <p style="color: #ff710d;">₱<?php echo $row['price'];?></p>
            </div>
        </div>
        
        <hr>
        <div class="flex flex-main-spacebetween">
            <div>
                <h3><?php echo $row['fname']." ".$row['lname'];?></h3>
                <p><?php echo $row['uPhone'];?></p>
                <p><?php echo $row['uEmail'];?></p>
                <p><?php echo $row['lic_no'];?></p>
            </div>
            <div style="text-align: right;">
            <?php 
                if($row['rating'] === null){
                    echo "<p>Not yet rated</p>";
                } else{
                    $stars_string = "";
                    for($i = 0; $i < 5; $i++){
                        if($i < $row['rating']){
                            $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #ff710d;'></i>";
                        } else{
                            $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #d0d0d0;'></i>";
                        }
                    }
                    echo "<p>$stars_string</p>";
                }
            ?>
            </div>
        </div>
        
    </div>
    <?php 
        if($row['rating'] === null){
    ?>
        <div class="container" style="min-width: fit-content; max-width: 30%; margin-top: 20px; margin: 20px auto;">
        <h3 style="color:#ff710d;">Rate your experience with <?php echo $row['fname']." ".$row['lname'];?></h3>
        <form action="trip-history.php" method="POST">
            <input type="hidden" name="trip_id" required value="<?php echo $row['idTrip'];?>">
            <input type="number" name="stars" id="" class="text-box" placeholder="Stars" required min="1" max="5">
            <textarea name="message" id="" cols="30" rows="5" class="text-box" placeholder="Message"></textarea>
            <input type="submit" value="Submit" class="input-btn" name="submit">
        </form>
        </div>
    <?php }?>
    
</body>
</html>