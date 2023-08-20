<?php 
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="utilities.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip | TigerRide</title>
</head>
<body>
    <?php 
        require 'dbcon.php';
        include 'header.php';
        
    ?>
    <div style="width: 50%; margin: 100px auto;">
    <form action="trip.php" method="GET">
        <div class="container">
            
            <?php 
            if(isset($_GET['status']) && isset($_GET['id'])){
                if($_GET['status'] == 'pending'){
                    echo "<p style='color: red;'> You have a pending booking!</p>";
                } else if($_GET['status'] == 'successful'){
                    echo "<p style='color: green;'> Successful Booking</p>";
                } else if($_GET['status'] == 'error'){
                    echo "<p style='color: red;'> An error has occured!</p>";
                } else if($_GET['status'] == 'cancelled'){
                    echo "<p style='color: green;'> Successfully Cancelled Booking</p>";
                }else if($_GET['status'] == 'taken'){
                    echo "<p style='color: red;'> That seat is already taken!</p>";
                }else if($_GET['status'] == 'noseats'){
                    echo "<p style='color: red;'> All seats are already taken!</p>";
                }else if($_GET['status'] == 'insufficient'){
                    $price = $_GET['price'];
                    echo "<p style='color: red;'> You must have $price tickets in your account to book this trip!</p>";
                }
            }
            
            if(isset($_GET['book']) && isset($_GET['trip_id']) && isset($_GET['seat_id'])){
            $id = $_GET['trip_id'];
            $uID = $_SESSION['uID'];
            $seat_id = $_GET['seat_id'];
            $query = "SELECT rates.price FROM rates WHERE rates.idRates = $seat_id;";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $seat_price = $row['price'];
            mysqli_free_result($result);
            $query = "SELECT `users`.`user_status`, `users`.`ticket_bal` FROM users WHERE uID=$uID;";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            if($row['user_status'] == 'Pending Booking'){
                header("Location: trip.php?id=$id&status=pending");
            } else if($row['ticket_bal'] < $seat_price){
                header("Location: trip.php?id=$id&status=insufficient&price=$seat_price");
            }else {
                $query = "SELECT seats_avail FROM trip WHERE idTrip=$id;";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $seats_avail = $row['seats_avail'];
                if($seats_avail > 0){
                    $query = "SELECT Rates_idRates FROM trip_passengers WHERE Trip_idTrip = $id AND Rates_idRates = $seat_id;";
                    $result = mysqli_query($con, $query);
                    if(mysqli_num_rows($result) > 0){
                        header("Location: trip.php?id=$id&status=taken");
                        exit;
                    } else{
                        $query = "INSERT INTO trip_passengers VALUES ($id, 0, DEFAULT, $uID, $seat_id);";
                        $query .= "UPDATE users SET user_status='Pending Booking' WHERE uID=$uID;";
                        $result = mysqli_multi_query($con, $query);
                        if(!$result){
                            header("Location: trip.php?id=$id&status=error");
                        } else {
                            header("Location: trip.php?id=$id&status=successful");
                        }
                    }
                    
                } else{
                    header("Location: trip.php?id=$id&status=noseats");
                }
                
                
            }
            
        } else if(isset($_GET['cancel']) && isset($_GET['trip_id'])){
            $id = $_GET['trip_id'];
            $uID = $_SESSION['uID'];
            $query = "DELETE FROM trip_passengers WHERE Trip_idTrip=$id AND Users_idUsers=$uID;";
            $query .= "UPDATE users SET user_status='Available' WHERE uID=$uID;";
            if(mysqli_multi_query($con, $query)){
                header("Location: trip.php?id=$id&status=cancelled");
            } else{
                header("Location: trip.php?id=$id&status=error");
            }
        }
            
            
        ?>
        <?php 
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $query = "SELECT trip.start_location, trip.end_location, trip.seats_avail, trip.departure_date, users.fname, users.mname, users.lname, users.prof_path, users.uPhone, users.uEmail, car.plate_no, car.car_make, car.model, driver_ratings.avg_rating, driver_ratings.rating_count FROM trip JOIN users ON trip.Users_idUsers = users.uID JOIN car ON trip.Car_idCar = car.idCar LEFT JOIN ( SELECT trip.Users_idUsers, AVG(rating.rating_stars) AS avg_rating, COUNT(rating.idRating) AS rating_count FROM trip JOIN rating ON rating.Trip_idTrip = trip.idTrip GROUP BY trip.Users_idUsers ) AS driver_ratings ON driver_ratings.Users_idUsers = users.uID WHERE trip.idTrip=$id;";
                $result = mysqli_query($con, $query);
                if(!$result){
                    header("Location: trip.php?id=$id&status=error");
                } else {
                    $row = mysqli_fetch_assoc($result);
                }

            }
        ?>
        
        <div class="flex flex-main-spacebetween flex-col">
            <div style="text-align: center;">
                <p class="heading second-text"><b>TRIP DETAILS</b></p>
                <br>
                <p class="main-text"><?php echo date("D d M g:i A", strtotime($row['departure_date'])); ?></p>
                <div>
                        <i class='fa-solid fa-location-pin' style='color: #ff710d;'></i> <p style="display: inline;"><?php echo $row['start_location']; ?></p><br>
                        <i class='fa-solid fa-location-dot' style='color: #ff710d;'></i> <p style="display: inline;"><?php echo $row['end_location']; ?></p>
                </div>
                <hr>
                <div class="flex flex-main-spacebetween">
                    <?php
                        $id = $_GET['id']; 
                        $query = "SELECT idRates, seat_position, price FROM `rates` WHERE Trip_idTrip = $id;";
                        $result = mysqli_query($con, $query);
                        while($rowers = mysqli_fetch_assoc($result)){
                            echo "<div>
                            <input type='radio' name='seat_id' id='seat-".$rowers['idRates']."' value='".$rowers['idRates']."' checked>
                            <label for='seat-".$rowers['idRates']."'><i class='fa-solid fa-ticket' style='color:#ff710d;'></i> ".$rowers['price']."-".$rowers['seat_position']."</label>
                        </div>";
                        }
                    ?>
                </div>
            </div>
            <hr>
            <div style="text-align: center;">
                <div class="flex flex-main-spacebetween">
                    <div style="text-align: left;">
                        <div class='flex flex-cross-start flex-gap-10'>
                            <div>
                                <img src="./img/<?php echo $row['prof_path'];?>" alt="" style="width: 60px; border-radius: 60px; object-fit: cover; height: 60px;">
                            </div>
                            <div>
                                <p class="main-text"><?php echo $row['fname'].' '.$row['mname'].' '.$row['lname']; ?></p>
                                <p><?php echo $row['uPhone']; ?></p>
                                <p><?php echo $row['uEmail']; ?></p>
                                <p>
                                    <?php 
                                        $stars_string = "";
                                        if($row['avg_rating'] === null){
                                            $stars_string = "Not yet rated";
                                        } else{
                                            for($i = 0; $i < 5; $i++){
                                                if($i < $row['avg_rating']){
                                                    $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #ff710d;'></i>";
                                                } else{
                                                    $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #d0d0d0;'></i>";
                                                }
                                            }
                                            $stars_string = $stars_string." - ".$row['rating_count']." ratings";
                                        }
                                        echo $stars_string;
                                    ?>
                                </p>
                                
                            </div>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <p><?php echo $row['car_make']; ?> <?php echo $row['model']; ?></p>
                        <p><?php echo $row['plate_no']; ?></p>
                        <input type="hidden" name="trip_id" value="<?php echo $id; ?>">
                    </div>
                </div>
                <hr>
                <?php
                    $uID = $_SESSION['uID'];
                    $trip_id = $_GET['id'];
                    $query = "SELECT trip.status FROM trip WHERE idTrip=$trip_id;";
                    $result = mysqli_query($con, $query);
                    $row = mysqli_fetch_assoc($result);
                    $status = $row['status'];
                    $query = "SELECT trip_passengers.Users_idUsers FROM trip_passengers WHERE Trip_idTrip=$trip_id AND Users_idUsers = $uID";
                    $result = mysqli_query($con, $query);
                    if(mysqli_num_rows($result) > 0){
                        $booked = true;
                    } else{
                        $booked = false;
                    }
                    $query = "SELECT `users`.`user_status` FROM users WHERE uID=$uID;";
                    $result3 = mysqli_query($con, $query);
                    $row = mysqli_fetch_row($result3);
                    if($trip_id == $_GET['id'] && $row[0] == 'Pending Booking' && $booked){
                        echo "<input type='submit' name='cancel' value='Cancel Booking' class='button' style='padding: 0.6em 1.2em;'/>";
                    } else if($trip_id == $_GET['id'] && $row[0] == 'Booked'){
                        echo "<p>Already Booked</p>";
                    } else if($trip_id == $_GET['id'] && $status == 'Completed' && !$booked){
                    }else{
                        echo "<input type='submit' name='book' value='Book Now' class='button' style='padding: 0.6em 1.2em;'/>";
                    }
                ?>
                
            </div>
            
        </div>
        
        
        </div>
        </form>
    </div>
    
</body>
</html>