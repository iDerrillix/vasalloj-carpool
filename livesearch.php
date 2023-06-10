<?php 
    require 'dbcon.php';
    if(isset($_POST['input'])){
        $input = $_POST['input'];

        $query = "SELECT trip.idTrip, trip.start_location, trip.end_location, trip.departure_date,  trip.seats_avail, users.fname, users.lname, users.prof_path, car.car_make, car.model,
                    trip.status, MIN(rates.price) AS 'price' FROM trip JOIN users ON users.uID = trip.Users_idUsers JOIN car ON trip.Car_idCar = car.idCar JOIN rates ON rates.Trip_idTrip = trip.idTrip
                  WHERE trip.status = 'Scheduled' AND trip.departure_date > CURRENT_TIMESTAMP AND trip.start_location LIKE '{$input}%' GROUP BY trip.idTrip, trip.start_location, trip.end_location, trip.departure_date, 
                    trip.seats_avail, users.fname,  users.lname, car.car_make, car.model, trip.status;";
        
    } else{
        $query = "SELECT trip.idTrip, trip.start_location, trip.end_location, trip.departure_date,  trip.seats_avail, users.fname, users.lname, users.prof_path, car.car_make, car.model,
                    trip.status, MIN(rates.price) AS 'price' FROM trip JOIN users ON users.uID = trip.Users_idUsers JOIN car ON trip.Car_idCar = car.idCar JOIN rates ON rates.Trip_idTrip = trip.idTrip
                  WHERE trip.status = 'Scheduled' AND trip.departure_date > CURRENT_TIMESTAMP GROUP BY trip.idTrip, trip.start_location, trip.end_location, trip.departure_date, 
                    trip.seats_avail, users.fname,  users.lname, car.car_make, car.model, trip.status;";
    }
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<a href='trip.php?id=".$row['idTrip']."' style='color: black; text-decoration: none;' class='trip'>
                <div class='container' style='min-width: 450px; margin: 0; max-width: fit-content;'>
                <div class='flex flex-main-spacebetween' style='width: 100%;'>
                    <div style='text-align: left;'>
                        <div class='flex flex-cross-start flex-gap-10'>
                            <div>
                                <img src='./img/".$row['prof_path']."' alt='' style='width: 60px; border-radius: 60px; object-fit: cover; height: 60px;'>
                            </div>
                            <div>
                                <h3>".$row['fname']." ".$row['lname']."</h3>
                                <p>".$row['car_make']." ".$row['model']."</p>
                                <i class='fa-solid fa-location-pin' style='color: #ff710d;'></i><p style='display: inline-block; margin-left: 5px;'>".$row['start_location']."</p><br>
                                <i class='fa-solid fa-location-dot' style='color: #ff710d;'></i><p style='display: inline-block; margin-left: 5px;'>".$row['end_location']."</p><br>
                            </div>
                        </div>
                        
                    </div>
                    <div style='text-align: right;'>
                        <p>Starts <i class='fa-solid fa-ticket' style='color:#ff710d;'></i> ".$row['price']."</p>
                        <p>".date("D d M", strtotime($row['departure_date']))."</p>
                        <p>".date("g:i A", strtotime($row['departure_date']))."</p>
                        <p>".$row['seats_avail']." seats left</p>
                    </div>
                </div>
            </div>
            </a>";
            }
    } else{
        echo "<p>No data found</p>";
    }
?>