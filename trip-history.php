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
        if($_SESSION['uType'] == "Passenger"){
            $query = "SELECT users.fname, users.lname, users.uPhone, users.uEmail, users.lic_no, trip.idTrip, trip.departure_date, trip.status, car.car_make, car.model, car.plate_no, trip.start_location, trip.end_location, rates.price AS 'price', rates.seat_position, 
            rating.rating_stars AS 'rating' FROM trip JOIN car ON trip.Car_idCar = car.idCar JOIN trip_passengers ON trip.idTrip = trip_passengers.Trip_idTrip JOIN rates ON rates.idRates = 
            trip_passengers.Rates_idRates LEFT JOIN rating ON trip.idTrip = rating.Trip_idTrip JOIN users ON trip.Users_idUsers = users.uID WHERE trip_passengers.Users_idUsers = $id AND trip.idTrip=$trip_id;";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
    ?>
    <div class="container" style="min-width: fit-content; max-width: 30%; margin: 0 auto; margin-top: 100px; text-align: left;">
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
                <h3 style='color: #ff710d;'> Trip No. <?php echo $trip_id;?></h3>
        
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
                <div class="flex flex-cross-start">
                    <div>
                        <img src="./img/yuka-makoto2.jpg" alt="" style="width: 60px; border-radius: 60px;">
                    </div>
                    <div>
                        <h3><?php echo $row['fname']." ".$row['lname'];?></h3>
                        <p><?php echo $row['uPhone'];?></p>
                        <p><?php echo $row['uEmail'];?></p>
                        <p><?php echo $row['lic_no'];?></p>
                    </div>
                </div>
                
                
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
    <?php } else{
        $query = "SELECT trip.idTrip, trip.departure_date, car.car_make, car.model, car.plate_no, trip.start_location, trip.end_location, trip.status FROM trip JOIN car ON trip.Car_idCar = car.idCar WHERE trip.Users_idUsers = $id AND trip.status = 'Completed' ORDER BY trip.departure_date DESC; ";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="container" style="min-width: fit-content; max-width: 30%; margin: 0 auto; margin-top: 100px; text-align: left;">
        <div class="flex flex-main-spacebetween">
            <div>
                <h3 style='color: #ff710d;'> Trip No. <?php echo $trip_id;?></h3>
        
                <p><?php echo date("d M Y - g:i A", strtotime($row['departure_date']));?></p>
                <p>Kia Stonic CBM-7625</p>
                <br>
                <p style='color: #ff710d;'><i class='fa-solid fa-location-pin'></i> <?php echo $row['start_location'];?></p>
                <p style='color: #ff710d;'><i class='fa-solid fa-location-dot'></i> <?php echo $row['end_location'];?></p>
            </div>
            <div style="text-align: right;">
                <p><?php echo $row['status'];?></p>
            </div>
        </div>
        
    </div>
    <div class="container" style="min-width: fit-content; max-width: 30%; margin: 0 auto; margin-top: 20px; text-align: left;">
        <p class="heading second-text"><b>Passengers</b></p>
        <br>
        <div class="flex flex-col">
            <?php 
                $query = "SELECT users.fname, users.lname, users.uPhone, rating.rating_stars FROM trip_passengers JOIN users ON trip_passengers.Users_idUsers = users.uID JOIN rating ON rating.Trip_idTrip = trip_passengers.Trip_idTrip WHERE trip_passengers.Trip_idTrip = $trip_id;";
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_assoc($result)){
                    $stars_string = "";
                    if($row['rating_stars'] === null){
                        $stars_string = "Not yet rated";
                    } else{
                        for($i = 0; $i < 5; $i++){
                            if($i < $row['rating_stars']){
                                $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #ff710d;'></i>";
                            } else{
                                $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #d0d0d0;'></i>";
                            }
                        }
                    }
                    echo "
                    <div class='flex flex-main-spacebetween'>
                        <div class='flex flex-main-spacebetween'>
                            <img src='./img/yuka-makoto2.jpg' alt='' style='width: 45px; border-radius: 45px;'>
                            <div>
                                <p class='main-text'>".$row['fname']." ".$row['lname']."</p>
                                <p>".$row['uPhone']."</p>
                            </div>
                        </div>
                        <div>
                        <p>$stars_string</p>
                        </div>
                    </div>
                    <hr>
                    ";
                }
            ?>

        </div>
        
    </div>
    <?php }?>
</body>
</html>