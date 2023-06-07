<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .nav{
        width: 100%;
        border-radius: 8px;
        background-color: #0062ff;
        padding: 0.6em 0.3em;
        border: none;
        margin-top: 50px;
        color: white;
        text-decoration: none;;
        }
        .book{
            text-decoration: none;
            font-weight: bold;
            color: #93fd70;
        }
        .trip{
            transition: scale 0.5s;
        }
        .trip:hover{
            scale: 1.05;
        }
    </style>
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
    <!-- Available Trips Container -->
    <div style="margin: auto; margin-top: 20px; max-width: 75%;" class="flex flex-main-center flex-cross-center">
        <div class="flex flex-wrap flex-main-center flex-gap-20" style="width: 90%;">
        <?php 
            $uID = $_SESSION['uID'];
            $query = "SELECT user_status FROM users WHERE uID=$uID AND uType='Passenger';";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                if($row['user_status'] == 'Available'){
                    mysqli_free_result($result);
                    $query = "SELECT trip.idTrip, trip.start_location, trip.end_location, trip.departure_date, trip.seats_avail, users.fname, users.lname, car.car_make, car.model, trip.status FROM trip JOIN users ON users.uID = trip.Users_idUsers JOIN car ON trip.Car_idCar = car.idCar WHERE trip.status='Scheduled' AND trip.departure_date > CURRENT_TIMESTAMP";
                    $result = mysqli_query($con, $query);
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<a href='trip.php?id=".$row['idTrip']."' style='color: black; text-decoration: none;' class='trip'>
                        <div class='container' style='min-width: 350px; margin: 0; max-width: fit-content;'>
                        <div class='flex flex-main-spacearound' style='width: 100%;'>
                            <div style='text-align: left;'>
                                <h3>".$row['fname']." ".$row['lname']."</h3>
                                <p>".$row['car_make']." ".$row['model']."</p>
                                <i class='fa-solid fa-location-pin' style='color: #ff710d;'></i><p style='display: inline-block; margin-left: 5px;'>".$row['start_location']."</p><br>
                                <i class='fa-solid fa-location-dot' style='color: #ff710d;'></i><p style='display: inline-block; margin-left: 5px;'>".$row['end_location']."</p><br>
                            </div>
                            <div style='text-align: right;'>
                                <p>Starts at ₱400</p>
                                <p>".date("D d M", strtotime($row['departure_date']))."</p>
                                <p>".date("g:i A", strtotime($row['departure_date']))."</p>
                                <p>".$row['seats_avail']." seats left</p>
                            </div>
                        </div>
                    </div>
                    </a>";
                    }
                }
            }
            
        ?>
        </div>
    </div>

    <!-- Passenger Booked Trip Details Container -->
    <div class="container" id="passenger-container" style="display: none; margin: auto;width: fit-content;">
        <?php 
            $id = $_SESSION['uID'];
            $query = "SELECT user_status, uType FROM users WHERE uID=$id;";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            $p_stat = $row['user_status'];
            if($row['uType'] == 'Passenger'){
                if($row['user_status'] != 'Pending Booking' && $row['user_status'] != 'Available'){
                    echo "<script>document.querySelector('#passenger-container').style.display = 'block';</script>";
                }
                
            }
        ?>
        <div id="trip-passenger" >
            <?php 
                if(isset($_GET['action']) && $_GET['action'] == 'dropped'){
                    
                }
            ?>
            <p>Booked Trip</p>
            <br>
            <?php 
                $query = "SELECT * FROM trip WHERE idTrip = (SELECT MAX(Trip_idTrip) FROM trip_passengers WHERE Users_idUsers = ".$_SESSION['uID'].");";
                $row = mysqli_fetch_assoc(mysqli_query($con, $query));
            ?>
            <div class="flex flex-main-center flex-gap-20" style="text-align: left;">
                <div>
                    <p><b>Pickup Location</b></p>
                    <p><b>Destination</b></p>
                    <p><b>Departure</b></p>
                    <p><b>Status</b></p>
                </div>
                <div>
                    <p><?php echo $row['start_location'];?></p>
                    <p><?php echo $row['end_location'];?></p>
                    <p><?php echo date("D d M g:i A", strtotime($row['departure_date']));?></p>
                    <p><?php echo $row['status'];?></p>
                </div>
            </div>
            
            <?php 
                if($row['status'] == 'Waiting' && $p_stat != 'Onboard'){
                    echo "
                        <hr>
                        <button class='input-btn' style='margin: 20px 0;' id='confirm-onboard'>Confirm Onboard</button>
                        <button class='input-btn' style='margin: 20px 0;' id='drop-ride'>Drop Trip</button>
                    ";
                }
            ?>

            
            <script>
                function confirmBoard(){
                    $.ajax({
                        url: 'confirm_drop.php',
                        method: 'POST',
                        data: {
                            action: 'confirm',
                            id: '37'
                        },
                        success: function(response){
                            
                            var status = response.response_status;
                            var heading = response.heading;
                            var paragraph = response.paragraph;
                            toggleModal(heading, paragraph);
                            setTimeout(function (e){
                                location.reload();
                            }, 3000);
                        },
                        error: function(xhr, status, error){
                            console.error(error);
                            console.log(error);
                        }

                    });
                }
                function dropRide(trip_id){
                    $.ajax({
                        url: 'confirm_drop.php',
                        method: 'POST',
                        data: {
                            action: 'drop',
                            id: trip_id
                        },
                        success: function(response){
                            var status = response.response_status;
                            var heading = response.heading;
                            var paragraph = response.paragraph;
                            toggleModal(heading, paragraph);
                            
                        },
                        error: function(xhr, status, error){
                            console.error(error);
                        }

                    });
                }
                document.querySelector("#confirm-onboard").addEventListener("click", function(e){
                    confirmBoard();
                });
                document.querySelector("#drop-ride").addEventListener("click", function(e){
                    dropRide(<?php echo $row['idTrip'];?>);
                });
            </script>
        </div>
    </div>
    <!-- Driver Register Route Container -->
    <div class="container" id="register-route" style="display: none; width: 50%;">
        <div class="register-route" >
            <?php 
                if(isset($_GET['success'])){
                    echo "<p style='color: green;'>Successfully registered a route</p>";
                } else if(isset($_GET['fail'])){
                    if($_GET['fail'] == 'pending'){
                        echo "<p style='color: red;'>You have a pending trip!</p>";
                    }
                }
            ?>
            <?php 
            $id = $_SESSION['uID'];
            $query = "SELECT uType FROM users WHERE uID=$id";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            if($row['uType'] == 'Driver'){
                echo "<script>document.querySelector('#register-route').style.display = 'block';</script>";
            ?>
            <form action="register-route.php" method="POST">
                <p>Route Details</p>
                <input type="text" name="start_loc" id="" placeholder="Start Location" class="text-box" required>
                <input type="text" name="end_loc" id="" placeholder="End Location" class="text-box" required>
                <input placeholder="Departure Time and Date" class="text-box" type="text" onfocus="(this.type='datetime-local')" id="date" name="departure_date" required/>
                <P>Select Car</P>
                    <select name="idCar" id="" class="text-box" required>
                        <?php 
                            $id = $_SESSION['uID'];
                            $query = "SELECT * FROM car WHERE Users_idUsers=$id AND approved=1";
                            $result = mysqli_query($con, $query);
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['idCar']."'>".$row['car_make']." ".$row['model']."(".$row['plate_no'].")</option>";
                            }
                        ?>
                    </select>
                <p>Pricing</p>
                <div class="flex main-center">
                    <div>
                        <th>Front Seat</th>
                        <input type="number" name="front_seat" id="" placeholder="Enter Price" class="text-box" required>
                    </div>
                    <div>
                        <th>Middle Seat</th>
                        <input type="number" name="middle_seat" id="" placeholder="Enter Price" class="text-box" required>
                    </div>
                    <div>
                        <th>Left Seat</th>
                        <input type="number" name="left_seat" id="" placeholder="Enter Price" class="text-box" required>
                    </div>
                    <div>
                        <th>Right Seat</th>
                        <input type="number" name="right_seat" id="" placeholder="Enter Price" class="text-box" required>
                    </div>
                </div>
                <input type="submit" value="Register Route" class="button" name="submit">
            </form>
            <?php
            }
        ?>
        </div>
    </div>
    <!-- Driver Scheduled Trip Details -->
    <div id="trip-details" style="display: none;">
        <?php 
            $id = $_SESSION['uID'];
            $query = "SELECT user_status, uType FROM users WHERE uID=$id;";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);
            if($row['user_status'] != 'Available' && $row['uType'] == 'Driver'){
                echo "<script>document.querySelector('#trip-details').style.display = 'block';</script>";
            }
        ?>
        <div style="margin: auto; margin-top: 20px; max-width: 50%;" class="flex flex-main-spacebetween flex-cross-start flex-wrap">
                <div class="container" style="width: 49%; text-align: left; margin: 0; display: inline;">
                    <p>Trip Settings</p>
                    <hr>
                    <div class="flex flex-main-spacebetween flex-cross-start flex-wrap">
                        <div>
                            <h6>Trip ID</h6>
                            <h6>Pickup Location</h6>
                            <h6>Destination</h6>
                            <h6>Departure Date</h6>
                            <h6>Seats Available</h6>
                            <h6>Status</h6>
                        </div>
                        <div>
                            <?php 
                                $uID = $_SESSION['uID'];
                                $query = "SELECT user_status FROM users WHERE uID=$uID AND uType='Driver';";
                                $result = mysqli_query($con, $query);
                                if(mysqli_num_rows($result)> 0){
                                    $query = "SELECT idTrip, start_location, end_location, departure_date, seats_avail, status FROM `trip` WHERE Users_idUsers = $uID ORDER BY idTrip DESC LIMIT 1;";
                                    $result = mysqli_query($con, $query);
                                    $row = mysqli_fetch_assoc($result);
                                    $trip_id = $row['idTrip'];
                                    echo "
                                        <p>".$row['idTrip']."</p>
                                        <p>".$row['start_location']."</p>
                                        <p>".$row['end_location']."</p>
                                        <p>".date("D d M g:i A", strtotime($row['departure_date']))."</p>
                                        <p>".$row['seats_avail']."</p>
                                        <p>".$row['status']."</p>
                                    ";
                                }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <?php 
                        if($row['status'] == 'Scheduled'){
                            echo "<a href='driver-trip.php?id=".$row['idTrip']."&status=wait' class='input-btn'>In Pick-up Location</a>";
                        }else if($row['status'] == 'Waiting'){
                            echo "<a href='driver-trip.php?id=".$row['idTrip']."&status=start' class='input-btn'>Start</a>";
                        } else{
                            echo "<a href='driver-trip.php?id=".$row['idTrip']."&status=finish' class='input-btn'>Finish</a>";
                        }
                        echo " <a href='driver-trip.php?id=".$row['idTrip']."&status=cancel' class='input-btn'>Cancel</a>";
                    ?>
                    
                </div>
                <div class="container" style="width: 49%; text-align: left; margin: 0;" id='booking-container'>
                    <p>Booking</p>
                    <hr>
                    
                <script src="fetch_bookings.js"></script>
                <script>
                    $(document).ready(function() {
                        fetchBookings(<?php echo $trip_id;?>);
                    });
                </script>
                    <!-- <p>Booking</p>
                    <hr>
                    <?php 
                        $query = "SELECT users.uID, users.fname, users.lname, users.uPhone FROM trip_passengers JOIN users ON trip_passengers.Users_idUsers = Users.uID WHERE Trip_idTrip=$trip_id AND approved=0";
                        $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result)){
                            echo "
                            <div class='flex flex-cross-center flex-main-spacebetween flex-gap-10 flex-wrap' id='booking-container'>
                                <div>
                                    <p>".$row['fname']." ".$row['lname']."</p>
                                </div>
                                <div>
                                    <p>".$row['uPhone']."</p>
                                </div>
                                <div style='text-align: center;'>
                                    <a href='booking-approval.php?id=".$row['uID']."&book=true&trip=".$trip_id."' class='input-btn'><i class='fa-solid fa-check'></i></a>
                                    <a href='booking-approval.php?id=".$row['uID']."&book=false&trip=".$trip_id."' class='input-btn'><i class='fa-solid fa-xmark'></i></a>
                                </div>
    
                            </div>
                            ";
                        }
                    ?> -->
                </div>
        </div>
        <div class="container" style="width: 50%; margin-top: 20px;">
            <p>Accepted Bookings</p>
            <hr>
            <?php 
                $query = "SELECT users.fname, users.mname, users.lname, users.uPhone, users.user_status FROM trip_passengers JOIN users ON users.uID = trip_passengers.Users_idUsers WHERE trip_passengers.approved = 1 AND Trip_idTrip = $trip_id;";
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_assoc($result)){
                    echo "<div class='flex flex-cross-center flex-main-spacebetween flex-gap-10 flex-wrap' style='margin: 7px auto; width: 50%;'>
                        <div>".$row['fname']." ".$row['lname']."</div>
                        <div>".$row['uPhone']."</div>
                        <div style='color: #ff710d; font-weight: bold;'>".$row['user_status']."</div>
                    </div>";
                }
            ?>
        </div>
    </div>
    
    
</body>
</html>