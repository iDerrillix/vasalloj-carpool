<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="utilities.css">
    <link rel="stylesheet" href="flex.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Trip | TigerRide</title>
</head>
<body>
    <?php
        if($_SESSION['uType'] == "Passenger"){
    ?>
    <div class="container" style="min-width: fit-content; max-width: 30%; margin: 0 auto; margin-top: 100px; text-align: left;">
        <?php
        if(isset($responses['rating_success'])){
            echo "<p style='background-color: #b9ff94; color: green; border-radius: 3px; padding: 0.3em 1.2em; margin-bottom: 20px; text-align: center;'>Thank you for your feedback!</p>";
        }
        if(isset($errors['db_error'])){
            echo "<p style='background-color: #ff9b94; color: red; border-radius: 3px; padding: 0.3em 1.2em; margin-bottom: 20px; text-align: center;'>An error has occured. Could not submit rating.</p>";
        }
        ?>
        <div class="flex flex-main-spacebetween">
            <div>
                <h3 style='color: #ff710d;'> Trip No. <?= $_GET['id']; ?></h3>
                <p><?php echo date("d M Y - g:i A", strtotime($tripDetails['departure_date']));?></p>
                <p>Kia Stonic CBM-7625</p>
                <br>
                <p style='color: #ff710d;'><i class='fa-solid fa-location-pin'></i> <?php echo $tripDetails['start_location'];?></p>
                <p style='color: #ff710d;'><i class='fa-solid fa-location-dot'></i> <?php echo $tripDetails['end_location'];?></p>
            </div>
            <div style="text-align: right;">
                <p><?php echo $tripDetails['status'];?></p>
                <p><?php echo $tripDetails['seat_position'];?></p>
                <p style="color: #ff710d;">₱<?php echo $tripDetails['price'];?></p>
            </div>
        </div>
        
        <hr>
        <div class="flex flex-main-spacebetween">
            <div>
                <div class="flex flex-cross-start">
                    <div>
                        <img src="./img/<?php echo $tripDetails['prof_path'];?>" alt="" style="width: 60px; border-radius: 60px; object-fit: cover; height: 60px;">
                    </div>
                    <div>
                        <h3><?php echo $tripDetails['fname']." ".$tripDetails['lname'];?></h3>
                        <p><?php echo $tripDetails['uPhone'];?></p>
                        <p><?php echo $tripDetails['uEmail'];?></p>
                        <p><?php echo $tripDetails['lic_no'];?></p>
                    </div>
                </div>
                
                
            </div>
            <div style="text-align: right;">
            <?php 
                if($tripDetails['rating'] === null){
                    echo "<p>Not yet rated</p>";
                } else{
                    $stars_string = "";
                    for($i = 0; $i < 5; $i++){
                        if($i < $tripDetails['rating']){
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
        if($tripDetails['rating'] === null){
    ?>
        <div class="container" style="min-width: fit-content; max-width: 30%; margin-top: 20px; margin: 20px auto;">
        <h3 style="color:#ff710d;">Rate your experience with <?php echo $tripDetails['fname']." ".$tripDetails['lname'];?></h3>
        <form action="trip-history.php" method="POST">
            <input type="hidden" name="trip_id" required value="<?php echo $tripDetails['idTrip'];?>">
            <input type="number" name="stars" id="" class="text-box" placeholder="Stars" required min="1" max="5">
            <textarea name="message" id="" cols="30" rows="5" class="text-box" placeholder="Message"></textarea>
            <input type="submit" value="Submit" class="input-btn" name="submit">
        </form>
        </div>
    <?php }?>
    <?php } else{
        ?>
        <div class="container" style="min-width: fit-content; max-width: 30%; margin: 0 auto; margin-top: 100px; text-align: left;">
        <div class="flex flex-main-spacebetween">
            <div>
                <h3 style='color: #ff710d;'> Trip No. <?php echo $trip_id;?></h3>
        
                <p><?php echo date("d M Y - g:i A", strtotime($driverTripDetails['departure_date']));?></p>
                <p>Kia Stonic CBM-7625</p>
                <br>
                <p style='color: #ff710d;'><i class='fa-solid fa-location-pin'></i> <?php echo $driverTripDetails['start_location'];?></p>
                <p style='color: #ff710d;'><i class='fa-solid fa-location-dot'></i> <?php echo $driverTripDetails['end_location'];?></p>
            </div>
            <div style="text-align: right;">
                <p><?php echo $driverTripDetails['status'];?></p>
            </div>
        </div>
        
    </div>
    <div class="container" style="min-width: fit-content; max-width: 30%; margin: 0 auto; margin-top: 20px; text-align: left;">
        <p class="heading second-text"><b>Passengers</b></p>
        <br>
        <div class="flex flex-col">
            <?php
                foreach($tripPassengers as $passenger){
                    $stars_string = "";
                    if($passenger['rating_stars'] === null){
                        $stars_string = "Not yet rated";
                    } else{
                        for($i = 0; $i < 5; $i++){
                            if($i < $passenger['rating_stars']){
                                $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #ff710d;'></i>";
                            } else{
                                $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #d0d0d0;'></i>";
                            }
                        }
                    }
                    echo "
                    <div class='flex flex-main-spacebetween'>
                        <div class='flex flex-main-spacebetween'>
                            <img src='./img/".$passenger['prof_path']."' alt='' style='width: 45px; border-radius: 45px; object-fit: cover; height: 45px;'>
                            <div>
                                <p class='main-text'>".$passenger['fname']." ".$passenger['lname']."</p>
                                <p>".$passenger['uPhone']."</p>
                                <p>\"".$passenger['rating_msg']."\"</p>
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