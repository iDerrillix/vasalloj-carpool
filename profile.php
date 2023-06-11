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
    <title>Document</title>
</head>
<body>
    <?php
        require 'dbcon.php';
        include 'header.php'; 
        if(!isset($_SESSION['uID'])){
            header("Location: login.php?message=loginfirst");
            exit;
        }
        $id = $_SESSION['uID'];
        $query = "SELECT * FROM users WHERE uID=$id";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
    ?>
    <div class="container" style="width: 50%; margin: 0 auto; margin-top: 100px; text-align: left; overflow:hidden;">
        <?php 
            if(isset($_GET['status']) && $_GET['status'] == 'success'){
                echo "<p style='color:green;'>Successfully Updated</p>";
            }
        ?>
        <div class="heading">
            <p class="main-text">UPDATE INFORMATION</p>
        </div>
        
        <form action="./script/update.php" method="POST" enctype="multipart/form-data">
            <div class="flex">
                <div>
                    <br>
                    <img src="./img/<?php echo $row['prof_path'];?>" alt="" style="width: 60px; border-radius: 60px; object-fit: cover; height: 60px;">
                </div>
                <div class="text-div" style="width: 50%;">
                    <p>Personal Information</p>
                    <p></p>
                    <input type="text" name="uFName" id="" required placeholder="First Name" class="text-box" value="<?php echo $row['fname']." ".$row['mname']." ".$row['lname'];?>" readonly>
                    <input type="email" name="uEmail" id="" readonly placeholder="Email Address" class="text-box" value="<?php echo $row['uEmail'];?>">
                    <input type="tel" name="uPhone" id="" required placeholder="Phone Number" class="text-box" value="<?php echo $row['uPhone'];?>">
                    <input placeholder="Birthday" class="text-box" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" name="bday" value="<?php echo $row['birthday'];?>" required readonly/>
                    <p>Profile Picture</p>
                    <input type="file" name="file" id="" accept="image/png, image/gif, image/jpeg">
                </div>
                <div class="text-div" style="width: 50%;">
                    <p>Address</p>
                    <input type="text" name="street" id="" required placeholder="Street" class="text-box" value="<?php echo $row['street'];?>">
                    <input type="text" name="brgy" id="" required placeholder="Barangay" class="text-box" value="<?php echo $row['brgy'];?>">
                    <input type="text" name="city" id="" required placeholder="City" class="text-box" value="<?php echo $row['city'];?>">
                    <input type="text" name="prov" id="" required placeholder="Province" class="text-box" value="<?php echo $row['prov'];?>">
                    
                </div>
            </div>
            <br>
            <div>
                <div class="heading">
                    <p class="main-text">ACCOUNT INFORMATION</p>
                </div>
                
                <div class="flex col main-left text-div">
                    <?php 
                        if($row['uType'] == 'Driver'){
                            echo "Driver License No:";
                            echo $row['lic_no'];
                            echo "<br>";
                        }
                        echo $_SESSION['uType']
                    ?>
                    
                    
                </div>
                

            </div>
            
            
            
            
            <input type="submit" value="Update" class="input-btn" name="submit" style="float: right; display: block;">
        </form>
        
    </div>
    <?php 
        if($_SESSION['uType'] == 'Passenger'){
    ?>
    <div style="width: 50%; margin: 20px auto;">
        <hr>
        <h3>Past Trips</h3>
        <?php
            $query = "SELECT trip.idTrip, trip.departure_date, car.car_make, car.model, car.plate_no, trip.start_location, trip.end_location, rates.price AS 'price', rating.rating_stars AS 'rating' FROM trip JOIN car ON trip.Car_idCar = car.idCar JOIN trip_passengers ON trip.idTrip = trip_passengers.Trip_idTrip JOIN rates ON rates.idRates = trip_passengers.Rates_idRates LEFT JOIN rating ON trip.idTrip = rating.Trip_idTrip WHERE trip_passengers.Users_idUsers = $id AND trip.status = 'Completed'; ";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)){
                if($row['rating'] === null){
                    echo "
                    <a href='trip-history.php?id=".$row['idTrip']."' style='text-decoration: none; display: block;' class='past-trips'>
                    <div class='container flex flex-main-spacebetween' style='min-width: 100%; margin: 10px 0; text-align:left;'>
                        <div>
                            <h3 style='color: #ff710d;'>".date("D d M", strtotime($row['departure_date']))."</h3>
                            <p>".$row['car_make']." ".$row['model']." ".$row['plate_no']."</p>
                        </div>
                        <div>
                            <p><i class='fa-solid fa-location-pin' style='color: #ff710d;'></i> ".$row['start_location']."</p>
                            <p><i class='fa-solid fa-location-dot' style='color: #ff710d;'></i> ".$row['end_location']."</p>
                        </div>
                        <div style='text-align: right;'>
                            <p> - <i class='fa-solid fa-ticket' style='color:#ff710d;'></i> ".$row['price']."</p>
                            <p>Not yet rated</p>
                        </div>
                    </div>
                </a>
                ";
                } else{
                    $stars_string = "";
                    for($i = 0; $i < 5; $i++){
                        if($i < $row['rating']){
                            $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #ff710d;'></i>";
                        } else{
                            $stars_string = $stars_string."<i class='fa-solid fa-star' style='color: #d0d0d0;'></i>";
                        }
                    }
                    echo "
                    <a href='trip-history.php?id=".$row['idTrip']."' style='text-decoration: none; display: block;' class='past-trips'>
                    <div class='container flex flex-main-spacebetween' style='min-width: 100%; margin: 10px 0; text-align:left;'>
                        <div>
                            <h3 style='color: #ff710d;'>".date("D d M", strtotime($row['departure_date']))."</h3>
                            <p>".$row['car_make']." ".$row['model']." ".$row['plate_no']."</p>
                        </div>
                        <div>
                            <p><i class='fa-solid fa-location-pin' style='color: #ff710d;'></i> ".$row['start_location']."</p>
                            <p><i class='fa-solid fa-location-dot' style='color: #ff710d;'></i> ".$row['end_location']."</p>
                        </div>
                        <div style='text-align: right;'>
                            <p>- <i class='fa-solid fa-ticket' style='color:#ff710d;'></i> ".$row['price']."</p>
                            <p>".$stars_string."</p>
                        </div>
                    </div>
                </a>
                ";
                }
                
            }
        ?>
        


        
        
    </div>
    <?php }?>
    <?php 
        if($_SESSION['uType'] == 'Driver'){
    ?>
    <div style="width: 50%; margin: 20px auto;">
        <hr>
        <h3>Past Trips</h3>
        <?php
            $query = "SELECT trip.idTrip, trip.departure_date, car.car_make, car.model, car.plate_no, trip.start_location, trip.end_location FROM trip JOIN car ON trip.Car_idCar = car.idCar WHERE trip.Users_idUsers = $id AND trip.status = 'Completed' ORDER BY trip.departure_date DESC; ";
            $result = mysqli_query($con, $query);
            while($row = mysqli_fetch_assoc($result)){
                echo "
                    <a href='trip-history.php?id=".$row['idTrip']."' style='text-decoration: none; display: block;' class='past-trips'>
                    <div class='container flex flex-main-spacebetween' style='min-width: 100%; margin: 10px 0; text-align:left;'>
                        <div>
                            <h3 style='color: #ff710d;'>".date("D d M", strtotime($row['departure_date']))."</h3>
                            <p>".$row['car_make']." ".$row['model']." ".$row['plate_no']."</p>
                        </div>
                        <div>
                            <p><i class='fa-solid fa-location-pin' style='color: #ff710d;'></i> ".$row['start_location']."</p>
                            <p><i class='fa-solid fa-location-dot' style='color: #ff710d;'></i> ".$row['end_location']."</p>
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