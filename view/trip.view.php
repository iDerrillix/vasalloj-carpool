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
    <div style="width: 50%; margin: 100px auto;">
        <form method="POST">
            <div class="container">
                <?php
                foreach($errors as $error => $msg){
                    echo "<p style='color: red;'>".$msg."</p>";
                }
                foreach($responses as $response => $msg){
                    echo "<p style='color: green;'>".$msg."</p>";
                }
                ?>
                <div class="flex flex-main-spacebetween flex-col">
                    <div style="text-align: center;">
                        <p class="heading second-text"><b>TRIP DETAILS</b></p>
                        <br>
                        <p class="main-text"><?= date("D d M g:i A", strtotime($trip_details['departure_date'])); ?></p>
                        <div>
                                <i class='fa-solid fa-location-pin' style='color: #ff710d;'></i> <p style="display: inline;"><?= $trip_details['start_location']; ?></p><br>
                                <i class='fa-solid fa-location-dot' style='color: #ff710d;'></i> <p style="display: inline;"><?= $trip_details['end_location']; ?></p>
                        </div>
                        <hr>
                        <div class="flex flex-main-spacebetween">
                            <?php
                                foreach($rates as $rate){
                                    echo "<div>
                                        <input type='radio' name='seat_id' id='seat-".$rate['idRates']."' value='".$rate['idRates']."' checked>
                                        <label for='seat-".$rate['idRates']."'><i class='fa-solid fa-ticket' style='color:#ff710d;'></i> ".$rate['price']."-".$rate['seat_position']."</label>
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
                                        <img src="./img/<?= $trip_details['prof_path'];?>" alt="" style="width: 60px; border-radius: 60px; object-fit: cover; height: 60px;">
                                    </div>
                                    <div>
                                        <p class="main-text"><?= $trip_details['fname'].' '.$trip_details['mname'].' '.$trip_details['lname']; ?></p>
                                        <p><?= $trip_details['uPhone']; ?></p>
                                        <p><?= $trip_details['uEmail']; ?></p>
                                        <p>
                                            <?php 
                                                $stars_string = "";
                                                if($trip_details['avg_rating'] === null){
                                                    $stars_string = "Not yet rated";
                                                } else{
                                                    for($i = 0; $i < 5; $i++){
                                                        if($i < $trip_details['avg_rating']){
                                                            $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #ff710d;'></i>";
                                                        } else{
                                                            $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #d0d0d0;'></i>";
                                                        }
                                                    }
                                                    $stars_string = $stars_string." - ".$trip_details['rating_count']." ratings";
                                                }
                                                echo $stars_string;
                                            ?>
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                            <div style="text-align: right;">
                                <p><?= $trip_details['car_make']; ?> <?= $trip_details['model']; ?></p>
                                <p><?= $trip_details['plate_no']; ?></p>
                                <input type="hidden" name="trip_id" value="<?= $id; ?>">
                            </div>
                        </div>
                        <hr>
                        <?php
                            if($user_status['user_status'] == 'Pending Booking' && $_GET['id'] == $id && $booked){
                                echo "<input type='submit' name='cancel-book' value='Cancel Booking' class='button' style='padding: 0.6em 1.2em;'/>";
                                
                            } else if($user_status['user_status'] == 'Booked'  && $_GET['id'] == $id){
                                echo "<p>Already Booked</p>";
                            } else if($trip_details['status'] == 'Completed' && !$booked){
                                echo "<p>Trip Ended</p>";
                            }else{
                                echo "<input type='submit' name='book-ride' value='Book Now' class='button' style='padding: 0.6em 1.2em;'/>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>