<!DOCTYPE html>
<html lang="en">
<head>
    <style></style>
    <link rel="stylesheet" href="utilities.css">
    <link rel="stylesheet" href="flex.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | TigerRide</title>
</head>
<body>
<!-- PROFILE INFO -->
    <div class="container" style="width: 50%; margin: 0 auto; margin-top: 100px; text-align: left; overflow:hidden;">
        <?= (isset($responses['success'])) ? "<p style='color:green;'>".$responses['success']."</p>" : '' ?>
        <div class="heading">
            <p class="main-text">UPDATE INFORMATION</p>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="flex">
                <div>
                    <br>
                    <img src="./img/<?php echo $user['prof_path'];?>" alt="" style="width: 60px; border-radius: 60px; object-fit: cover; height: 60px;">
                </div>
                <div class="text-div" style="width: 50%;">
                    <p>Personal Information</p>
                    <p></p>
                    <input type="text" name="uFName" id="" required placeholder="First Name" class="text-box" value="<?php echo $user['fname']." ".$user['mname']." ".$user['lname'];?>" readonly>
                    <input type="email" name="uEmail" id="" readonly placeholder="Email Address" class="text-box" value="<?php echo $user['uEmail'];?>">
                    <input type="tel" name="uPhone" id="" required placeholder="Phone Number" class="text-box" value="<?php echo $user['uPhone'];?>">
                    <input placeholder="Birthday" class="text-box" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" name="bday" value="<?php echo $user['birthday'];?>" required readonly/>
                    <p>Profile Picture</p>
                    <input type="file" name="file" id="" accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="text-div" style="width: 50%;">
                    <p>Address</p>
                    <input type="text" name="street" id="" required placeholder="Street" class="text-box" value="<?php echo $user['street'];?>">
                    <input type="text" name="brgy" id="" required placeholder="Barangay" class="text-box" value="<?php echo $user['brgy'];?>">
                    <input type="text" name="city" id="" required placeholder="City" class="text-box" value="<?php echo $user['city'];?>">
                    <input type="text" name="prov" id="" required placeholder="Province" class="text-box" value="<?php echo $user['prov'];?>">
                    
                </div>
            </div>
            <br>
            <div>
                <div class="heading">
                    <p class="main-text">ACCOUNT INFORMATION</p>
                </div>
                <div class="flex col main-left text-div">
                    <?php
                        if($user['uType'] == 'Driver'){
                            echo "Driver License No:";
                            echo $user['lic_no'];
                            echo "<br>";
                        }
                        echo $_SESSION['uType'];
                    ?>
                </div>
            </div>
            <input type="submit" value="Update" class="input-btn" name="submit" style="float: right; display: block;">
        </form>
    </div>
<!-- PAST TRIPS -->
    <?php
        if($_SESSION['uType'] == 'Passenger'){
    ?>
    <div style="width: 50%; margin: 20px auto;">
        <hr>
        <h3>Past Trips</h3>
        <?php
            foreach($passengerTrips as $trip){
                if($trip['rating'] === null){
                    echo "
                    <a href='trip-history.php?id=".$trip['idTrip']."' style='text-decoration: none; display: block;' class='past-trips'>
                    <div class='container flex flex-main-spacebetween' style='min-width: 100%; margin: 10px 0; text-align:left;'>
                        <div>
                            <h3 style='color: #ff710d;'>".date("D d M", strtotime($trip['departure_date']))."</h3>
                            <p>".$trip['car_make']." ".$trip['model']." ".$trip['plate_no']."</p>
                        </div>
                        <div>
                            <p><i class='fa-solid fa-location-pin' style='color: #ff710d;'></i> ".$trip['start_location']."</p>
                            <p><i class='fa-solid fa-location-dot' style='color: #ff710d;'></i> ".$trip['end_location']."</p>
                        </div>
                        <div style='text-align: right;'>
                            <p> - <i class='fa-solid fa-ticket' style='color:#ff710d;'></i> ".$trip['price']."</p>
                            <p>Not yet rated</p>
                        </div>
                    </div>
                </a>
                ";
                } else{
                    $stars_string = "";
                    for($i = 0; $i < 5; $i++){
                        if($i < $trip['rating']){
                            $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #ff710d;'></i>";
                        } else{
                            $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #d0d0d0;'></i>";
                        }
                    }
                    echo "
                    <a href='/vasalloj-carpool/past-trip?id=".$trip['idTrip']."' style='text-decoration: none; display: block;' class='past-trips'>
                    <div class='container flex flex-main-spacebetween' style='min-width: 100%; margin: 10px 0; text-align:left;'>
                        <div>
                            <h3 style='color: #ff710d;'>".date("D d M", strtotime($trip['departure_date']))."</h3>
                            <p>".$trip['car_make']." ".$trip['model']." ".$trip['plate_no']."</p>
                        </div>
                        <div>
                            <p><i class='fa-solid fa-location-pin' style='color: #ff710d;'></i> ".$trip['start_location']."</p>
                            <p><i class='fa-solid fa-location-dot' style='color: #ff710d;'></i> ".$trip['end_location']."</p>
                        </div>
                        <div style='text-align: right;'>
                            <p>- <i class='fa-solid fa-ticket' style='color:#ff710d;'></i> ".$trip['price']."</p>
                            <p>".$stars_string."</p>
                        </div>
                    </div>
                </a>
                ";
                }
                
            }
        ?>  
    </div>
    <?php }else if($_SESSION['uType'] == 'Driver'){?>
    <div style="width: 50%; margin: 20px auto;">
        <hr>
        <h3>Past Trips</h3>
        <?php
            foreach($driverTrips as $trip){
                echo "
                    <a href='/vasalloj-carpool/past-trip?id=".$trip['idTrip']."' style='text-decoration: none; display: block;' class='past-trips'>
                    <div class='container flex flex-main-spacebetween' style='min-width: 100%; margin: 10px 0; text-align:left;'>
                        <div>
                            <h3 style='color: #ff710d;'>".date("D d M", strtotime($trip['departure_date']))."</h3>
                            <p>".$trip['car_make']." ".$trip['model']." ".$trip['plate_no']."</p>
                        </div>
                        <div>
                            <p><i class='fa-solid fa-location-pin' style='color: #ff710d;'></i> ".$trip['start_location']."</p>
                            <p><i class='fa-solid fa-location-dot' style='color: #ff710d;'></i> ".$trip['end_location']."</p>
                        </div>
                    </div>
                </a>
                ";
            }
        ?>
    </div>
    <?php }?>
</body>
</html>