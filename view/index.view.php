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
if($user_type == 'Passenger'){
    if($user_status == 'Available' || $user_status == 'Pending Booking'){
?>
<!-- Available Trips Container -->
    <script>
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
                </script>
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
                            foreach($trips as $trip){
                                $stars_string = "";
                                if($trip['avg_rating'] === null){
                                    $stars_string = "Not yet rated";
                                } else{
                                    for($i = 0; $i < 5; $i++){
                                        if($i < $trip['avg_rating']){
                                            $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #ff710d;'></i>";
                                        } else{
                                            $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #d0d0d0;'></i>";
                                        }
                                    }
                                }
                                echo "
                                <a href='/vasalloj-carpool/trip?id=".$trip['idTrip']."' style='color: black; text-decoration: none;' class='trip'>
                                <div class='container' style='min-width: 450px; margin: 0; max-width: fit-content;'>
                                <div class='flex flex-main-spacebetween' style='width: 100%;'>
                                    <div style='text-align: left;'>
                                        <div class='flex flex-cross-start flex-gap-10'>
                                            <div>
                                                <img src='./img/".$trip['prof_path']."' alt='' style='width: 60px; border-radius: 60px; object-fit: cover; height: 60px;'>
                                            </div>
                                            <div>
                                                <h3 class='main-text'>".$trip['fname']." ".$trip['lname']."</h3>
                                                <p>".$stars_string."</p>
                                                <i class='fa-solid fa-location-pin' style='color: #ff710d;'></i><p style='display: inline-block; margin-left: 5px;' class='main-text'>".$trip['start_location']."</p><br>
                                                <i class='fa-solid fa-location-dot' style='color: #ff710d;'></i><p style='display: inline-block; margin-left: 5px;' class='main-text'>".$trip['end_location']."</p><br>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div style='text-align: right;'>
                                        <p style='color:#ff710d; font-weight: bold;'>Starts <i class='fa-solid fa-ticket' ></i> ".$trip['price']."</p>
                                        <p>".date("D d M", strtotime($trip['departure_date']))."</p>
                                        <p>".date("g:i A", strtotime($trip['departure_date']))."</p>
                                        <p>".$trip['seats_avail']." seats left</p>
                                    </div>
                                </div>
                            </div>
                            </a>
                                ";
                            }
                    
                ?>
                </div>
            </div>
        </div>
    </div>
<?php } else{ ?>
<!-- Passenger Booked Trip Details Container -->
    <div class="container" id="passenger-container" style="margin: auto; margin-top: 100px; width: fit-content;">
        <div id="trip-passenger" >
            <p>Booked Trip</p>
            <br>
            <div class="flex flex-main-center flex-gap-20" style="text-align: left;">
                <div>
                    <p><b>Pickup Location</b></p>
                    <p><b>Destination</b></p>
                    <p><b>Departure</b></p>
                    <p><b>Status</b></p>
                </div>
                <div>
                    <p><?= $bookedTrip['start_location'];?></p>
                    <p><?= $bookedTrip['end_location'];?></p>
                    <p><?= date("D d M g:i A", strtotime($bookedTrip['departure_date']));?></p>
                    <p><?= $bookedTrip['status'];?></p>
                </div>
            </div>
            
            <?php 
                if($bookedTrip['status'] == 'Waiting' && $p_stat != 'Onboard'){
                    echo "
                        <hr>
                        <button class='input-btn' style='margin: 20px 0;' id='confirm-onboard'>Confirm Onboard</button>
                        <button class='input-btn' style='margin: 20px 0;' id='drop-ride'>Drop Trip</button>
                    ";
                } else if($bookedTrip['status'] == 'Scheduled'){
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
                    dropRide(<?php echo $bookedTrip['idTrip'];?>);

                });
                }
                
                
            </script>
        </div>
    </div>
<?php 
    }
} else if($user_type == 'Driver'){ 
    if($user_status == 'Available'){?>
<!-- Driver Register Route Container -->
    <div class="container" id="register-route" style="width: 50%; text-align: left; margin-top: 100px;">
        <div class="register-route" >
            <?php 
                if(isset($responses['route-success'])){
                    echo "<p style='color: green;'>Successfully registered a route</p>";
                } else if(isset($errors['pending-trip'])){
                    echo "<p style='color: red; text-align: center;'>You have a pending trip!</p>";
                } else if(isset($errors['pdo'])){
                    echo "<p style='color: red;'>".$errors['pdo']."</p>";
                }
            ?>
            <form method="POST">
                <p><b>ROUTE DETAILS</b></p>
                <input type="text" name="start_loc" id="" placeholder="Start Location" class="text-box" required>
                <input type="text" name="end_loc" id="" placeholder="End Location" class="text-box" required>
                <input placeholder="Departure Time and Date" class="text-box" type="text" onfocus="(this.type='datetime-local')" id="date" name="departure_date" required min=""/>
                <hr>
                    <select name="idCar" id="" class="text-box" required>
                        <?php
                            foreach($cars as $car){
                                echo "<option value='".$car['idCar']."'>".$car['car_make']." ".$car['model']."(".$car['plate_no'].")</option>";
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
                <input type="submit" value="Register Route" class="button" name="register-route">
            </form>
        </div>
    </div>
<?php } else{?>
<!-- Driver Scheduled Trip Details -->
    <div id="trip-details">
        <div style="margin: auto; margin-top: 100px; max-width: 50%;" class="flex flex-main-spacebetween flex-cross-start flex-wrap">
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
                            <p><?= $ongoingTrip['idTrip'] ?></p>
                            <p><?= $ongoingTrip['start_location'] ?></p>
                            <p><?= $ongoingTrip['end_location'] ?></p>
                            <p><?= date("D d M g:i A", strtotime($ongoingTrip['departure_date'])) ?></p>
                            <p><?= $ongoingTrip['seats_avail'] ?></p>
                            <p><?= $ongoingTrip['status'] ?></p>
                        </div>
                    </div>
                    <hr>
                    <?php 
                        if($ongoingTrip['status'] == 'Scheduled'){
                            echo "<a href='driver-trip.php?id=".$ongoingTrip['idTrip']."&status=wait' class='input-btn'>In Pick-up Location</a>";
                        }else if($ongoingTrip['status'] == 'Waiting'){
                            echo "<a href='driver-trip.php?id=".$ongoingTrip['idTrip']."&status=start' class='input-btn'>Start</a>";
                        } else{
                            echo "<a href='driver-trip.php?id=".$ongoingTrip['idTrip']."&status=finish' class='input-btn'>Finish</a>";
                        }
                        echo " <a href='driver-trip.php?id=".$ongoingTrip['idTrip']."&status=cancel' class='input-btn'>Cancel</a>";
                    ?>
                    
                </div>
                <div class="container" style="width: 49%; text-align: left; margin: 0;" id='booking-container'>
                    <p>Booking</p>
                    <hr>
                    <script src="fetch_bookings.js"></script>
                    <script>
                        $(document).ready(function() {
                            fetchBookings(<?php echo $ongoingTrip['idTrip'];?>);
                        });
                    </script>
                    <?php
                        foreach($incomingBookings as $booking){
                            echo "
                            <div class='flex flex-cross-center flex-main-spacebetween flex-gap-10 flex-wrap' id='booking-container'>
                                <div>
                                    <p>".$booking['fname']." ".$booking['lname']."</p>
                                </div>
                                <div>
                                    <p>".$booking['trip_count']."</p>
                                </div>
                                <div style='text-align: center;'>
                                    <a href='booking-approval.php?id=".$booking['uID']."&book=true&trip=".$ongoingTrip['idTrip']."' class='input-btn'><i class='fa-solid fa-check'></i></a>
                                    <a href='booking-approval.php?id=".$booking['uID']."&book=false&trip=".$ongoingTrip['idTrip']."' class='input-btn'><i class='fa-solid fa-xmark'></i></a>
                                </div>
    
                            </div>
                            ";
                        }
                    ?>
                </div>
        </div>
        <div class="container" style="width: 50%; margin-top: 20px; margin-bottom: 50px;">
            <p>Accepted Bookings</p>
            <hr>
            <?php 
                foreach($acceptedBookings as $user){
                    echo "<div class='flex flex-cross-center flex-main-spacebetween flex-gap-10 flex-wrap' style='margin: 7px auto; width: 50%;'>
                        <div><img src='./img/".$user['prof_path']."' style='width: 45px; border-radius: 45px;'></div>
                        <div>".$user['fname']." ".$user['lname']."</div>
                        <div>".$user['uPhone']."</div>
                        <div>".$user['seat_position']."</div>
                        <div style='color: #ff710d; font-weight: bold;'>".$user['user_status']."</div>
                    </div>";
                }
            ?>
        </div>
    </div>
  
<?php   
    }
}
?>
</body>
</html>