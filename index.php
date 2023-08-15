<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body{
            background-color: #fff;
        }
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
            scale: 1.02;
        }
        #banner{
            height: 40vh;
            background-image: url("./img/banner.jpeg");
            object-fit: cover;
            max-width: 79%; 
            border-radius: 10px;
            overflow: hidden;
            background-size: cover;
            background-position: 50% 35%;
        }
        #filter{
            width: 36%;
            min-width: 0;
            margin: 0;
        }
    </style>
    <link rel="stylesheet" href="utilities.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>Home | TigerRide</title>
    
</head>
<body>

    <?php
        require 'dbcon.php';
        include 'header.php';
        
    ?>
    
    <!-- Available Trips Container -->
    <?php 
            $uID = $_SESSION['uID'];
            $query = "SELECT user_status FROM users WHERE uID=$uID AND uType='Passenger';";
            $result = mysqli_query($con, $query);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                if($row['user_status'] == 'Available' || $row['user_status'] == 'Pending Booking'){
                    mysqli_free_result($result);
                    echo "<script>
                    $(document).ready(function() {
                      $('#search').keyup(function() {
                        var input = $(this).val();
                    
                        if (input != '') {
                          $.ajax({
                            url: 'livesearch.php',
                            method: 'POST',
                            data: { input: input, type: 'location'},
                            success: function(data) {
                              $('#search-result').html(data);
                            }
                          });
                        } else{
                            $.ajax({
                                url: 'livesearch.php',
                                method: 'POST',
                                success: function(data) {
                                  $('#search-result').html(data);
                                }
                              });
                        }
                      });
                      $('#filter-departure').change(function() {
                        var input = $(this).val();

                        if (input != '') {
                            $.ajax({
                              url: 'livesearch.php',
                              method: 'POST',
                              data: { input: input, type: 'date'},
                              success: function(data) {
                                $('#search-result').html(data);
                              }
                            });
                          } else{
                              $.ajax({
                                  url: 'livesearch.php',
                                  method: 'POST',
                                  success: function(data) {
                                    $('#search-result').html(data);
                                  }
                                });
                          }
                      });
                      $('#filter-seats').keyup(function() {
                        var input = $(this).val();
                        if (input != '') {
                            $.ajax({
                              url: 'livesearch.php',
                              method: 'POST',
                              data: { input: input, type: 'seat'},
                              success: function(data) {
                                $('#search-result').html(data);
                              }
                            });
                          } else{
                              $.ajax({
                                  url: 'livesearch.php',
                                  method: 'POST',
                                  success: function(data) {
                                    $('#search-result').html(data);
                                  }
                                });
                          }
                      });
                      
                    });
                    </script>";?>
                    
    <div style="margin: auto; margin-top: 100px;" id="banner">
        
        <div class="slider background-tint-dark">
            <div class="slides background-tint-dark">
                <input type="radio" name="radio-btn" id="radio1">
                <input type="radio" name="radio-btn" id="radio2">
                <input type="radio" name="radio-btn" id="radio3">
                <input type="radio" name="radio-btn" id="radio4">

                <div class="sliding first">
                    
                    <img src="./img/banner2.jpg" alt="">
                </div>
                <div class="sliding">
                    <img src="./img/banner.jpeg" alt="">
                </div>
                <div class="sliding">
                    <img src="./img/banner4.jpg" alt="">
                </div>
                <div class="sliding">
                    <img src="./img/banner3.webp" alt="">
                </div>
            </div>
        </div>
        <script>
        var counter = 1;
        setInterval(function(){
            document.getElementById('radio' + counter).checked = true;
            counter++;
            if(counter > 4){
                counter = 1;
            }
        }, 5000);
        </script>
    </div>
    <div class="flex flex-main-spacebetween flex-gap-20" style="width: 80%; margin: auto; margin-top: 20px; margin-bottom: 20px;">
        <div id="filter" class="container" style="text-align: left;">
            <h3 class="second-text">Filter Trips</h3>
            <br>
            <input type="text" name="" id="search" class="text-box" placeholder="Location" style="display: inline-block; width: 100%;">
            <p class="main-text">Departure Time</p>
            <input type="datetime-local" name="" id="filter-departure" class="text-box" placeholder="Date" min="<?php echo date('Y-m-d H:i:s');?>">
            <input type="number" name="" id="filter-seats" placeholder="Available Seats" class="text-box">
        </div>
        <div style="width: 75%;">
            <div style="max-width: 100%; " class="flex flex-main-start flex-cross-center">
                
                <div class="flex flex-wrap flex-main-start flex-gap-10" style="width: 100%;" id="search-result">
                

                        <?php
                            $query = "SELECT
                            trip.idTrip,
                            trip.start_location,
                            trip.end_location,
                            trip.departure_date,
                            trip.seats_avail,
                            users.fname,
                            users.lname,
                            users.prof_path,
                            car.car_make,
                            car.model,
                            trip.status,
                            MIN(rates.price) AS 'price',
                            driver_ratings.avg_rating,
                            driver_ratings.rating_count
                        FROM
                            trip
                            JOIN users ON users.uID = trip.Users_idUsers
                            JOIN car ON trip.Car_idCar = car.idCar
                            JOIN rates ON rates.Trip_idTrip = trip.idTrip
                            LEFT JOIN (
                                SELECT
                                    trip.Users_idUsers,
                                    AVG(rating.rating_stars) AS avg_rating,
                                    COUNT(rating.idRating) AS rating_count
                                FROM
                                    trip
                                    JOIN rating ON rating.Trip_idTrip = trip.idTrip
                                GROUP BY
                                    trip.Users_idUsers
                            ) AS driver_ratings ON driver_ratings.Users_idUsers = users.uID
                        WHERE
                            trip.status = 'Scheduled'
                            AND trip.departure_date > CURRENT_TIMESTAMP
                        GROUP BY
                            trip.idTrip,
                            trip.start_location,
                            trip.end_location,
                            trip.departure_date,
                            trip.seats_avail,
                            users.fname,
                            users.lname,
                            car.car_make,
                            car.model,
                            trip.status;";
                            $result = mysqli_query($con, $query);
                            while($row = mysqli_fetch_assoc($result)){
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
                                }
                            echo "<a href='trip.php?id=".$row['idTrip']."' style='color: black; text-decoration: none;' class='trip'>
                                <div class='container' style='min-width: 450px; margin: 0; max-width: fit-content;'>
                                <div class='flex flex-main-spacebetween' style='width: 100%;'>
                                    <div style='text-align: left;'>
                                        <div class='flex flex-cross-start flex-gap-10'>
                                            <div>
                                                <img src='./img/".$row['prof_path']."' alt='' style='width: 60px; border-radius: 60px; object-fit: cover; height: 60px;'>
                                            </div>
                                            <div>
                                                <h3 class='main-text'>".$row['fname']." ".$row['lname']."</h3>
                                                <p>".$stars_string."</p>
                                                <i class='fa-solid fa-location-pin' style='color: #ff710d;'></i><p style='display: inline-block; margin-left: 5px;' class='main-text'>".$row['start_location']."</p><br>
                                                <i class='fa-solid fa-location-dot' style='color: #ff710d;'></i><p style='display: inline-block; margin-left: 5px;' class='main-text'>".$row['end_location']."</p><br>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div style='text-align: right;'>
                                        <p style='color:#ff710d; font-weight: bold;'>Starts <i class='fa-solid fa-ticket' ></i> ".$row['price']."</p>
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
        </div>
    </div>
    <!-- Passenger Booked Trip Details Container -->
    <div class="container" id="passenger-container" style="display: none; margin: auto; margin-top: 100px; width: fit-content;">
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
                } else if($row['status'] == 'Scheduled'){
                    echo "<button class='input-btn' style='margin: 20px 0;' id='drop-ride'>Drop Trip</button>";
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
                            }, 2000);
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
                            setTimeout(function (e){
                                location.reload();
                            }, 2000);
                            
                        },
                        error: function(xhr, status, error){
                            console.error(error);
                        }

                    });
                }
                if($('#confirm-onboard').length){
                    document.querySelector("#confirm-onboard").addEventListener("click", function(e){
                    confirmBoard();
                });
                }
                if($('#drop-ride').length){
                    document.querySelector("#drop-ride").addEventListener("click", function(e){
                    console.log("test");
                    dropRide(<?php echo $row['idTrip'];?>);

                });
                }
                
                
            </script>
        </div>
    </div>
    <!-- Driver Register Route Container -->
    <div class="container" id="register-route" style="display: none; width: 50%; text-align: left; margin-top: 100px;">
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
                <p><b>ROUTE DETAILS</b></p>
                <input type="text" name="start_loc" id="" placeholder="Start Location" class="text-box" required>
                <input type="text" name="end_loc" id="" placeholder="End Location" class="text-box" required>
                <input placeholder="Departure Time and Date" class="text-box" type="text" onfocus="(this.type='datetime-local')" id="date" name="departure_date" required min=""/>
                <hr>
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
                    <hr>
                <p><b>PRICING</b></p>
                <br>
                <div class="flex flex-main-spacebetween">
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
        <script>
            console.log('<?php echo $_SESSION['uType'];?>');
        </script>
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
                        $query = "SELECT users.uID, users.fname, users.lname, ( SELECT COUNT(*) FROM trip_passengers WHERE trip_passengers.Users_idUsers = users.uID ) AS trip_count FROM trip_passengers JOIN users ON trip_passengers.Users_idUsers = users.uID WHERE trip_passengers.Trip_idTrip = $trip_id AND trip_passengers.approved = 0;";
                        $result = mysqli_query($con, $query);
                        while($row = mysqli_fetch_assoc($result)){
                            echo "
                            <div class='flex flex-cross-center flex-main-spacebetween flex-gap-10 flex-wrap' id='booking-container'>
                                <div>
                                    <p>".$row['fname']." ".$row['lname']."</p>
                                </div>
                                <div>
                                    <p>".$row['trip_count']."</p>
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
        <div class="container" style="width: 50%; margin-top: 20px; margin-bottom: 50px;">
            <p>Accepted Bookings</p>
            <hr>
            <?php 
                $query = "SELECT 
    users.uID, users.fname, users.lname, users.prof_path, users.uPhone, users.user_status,
    rates.seat_position,
    (
        SELECT COUNT(*) 
        FROM trip_passengers 
        WHERE trip_passengers.Users_idUsers = users.uID
    ) AS trip_count
FROM trip_passengers 
JOIN users ON trip_passengers.Users_idUsers = users.uID
JOIN rates ON trip_passengers.Rates_idRates = rates.idRates
WHERE trip_passengers.Trip_idTrip = $trip_id AND trip_passengers.approved = 1;";
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_assoc($result)){
                    echo "<div class='flex flex-cross-center flex-main-spacebetween flex-gap-10 flex-wrap' style='margin: 7px auto; width: 50%;'>
                        <div><img src='./img/".$row['prof_path']."' style='width: 45px; border-radius: 45px;'></div>
                        <div>".$row['fname']." ".$row['lname']."</div>
                        <div>".$row['uPhone']."</div>
                        <div>".$row['seat_position']."</div>
                        <div style='color: #ff710d; font-weight: bold;'>".$row['user_status']."</div>
                    </div>";
                }
            ?>
        </div>
    </div>
    
</body>
</html>