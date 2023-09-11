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
                    <form method="POST">
                    <?php 
                        if($ongoingTrip['status'] == 'Scheduled'){ ?>
                            <input type="hidden" name="id" value="<?= $ongoingTrip['idTrip'] ?>">
                            <input type="hidden" name="status" value="wait">
                            <input type="submit" value="In Pick-up Location" name="in_location" class="input-btn">
                            <?php
                        }else if($ongoingTrip['status'] == 'Waiting'){ ?>
                            <input type="hidden" name="id" value="<?= $ongoingTrip['idTrip'] ?>">
                            <input type="hidden" name="status" value="start">
                            <input type="submit" value="Start" name="start" class="input-btn">
                            <?php
                        } else{ ?>
                            <input type="hidden" name="id" value="<?= $ongoingTrip['idTrip'] ?>">
                            <input type="hidden" name="status" value="finish">
                            <input type="submit" value="Finish" name="finish" class="input-btn">
                            <?php
                        } 
                    ?>
                    </form>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $ongoingTrip['idTrip'] ?>">
                        <input type="hidden" name="status" value="cancel">
                        <input type="submit" value="Cancel" name="cancel" class="input-btn">
                    </form>
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
?>
</body>
</html>