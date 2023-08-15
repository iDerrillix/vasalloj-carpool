<?php 
    require 'dbcon.php';
    if(isset($_POST['input']) && isset($_POST['type'])){
        $input = $_POST['input'];
        $type = $_POST['type'];
        if($type == 'location'){
            $query = "SELECT trip.idTrip, trip.start_location, trip.end_location, trip.departure_date, trip.seats_avail, users.fname, users.lname, users.prof_path, car.car_make, car.model, 
            trip.status, MIN(rates.price), driver_ratings.avg_rating, driver_ratings.rating_count AS 'price' FROM trip JOIN users ON users.uID = trip.Users_idUsers JOIN car ON trip.Car_idCar = car.idCar JOIN rates ON rates.Trip_idTrip = trip.idTrip 
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
                            ) AS driver_ratings ON driver_ratings.Users_idUsers = users.uID WHERE trip.status = 'Scheduled' AND trip.departure_date > CURRENT_TIMESTAMP AND (trip.start_location LIKE '%{$input}%' OR trip.end_location LIKE '{$input}%') GROUP BY trip.idTrip, trip.start_location, trip.end_location, trip.departure_date, trip.seats_avail, users.fname, users.lname, car.car_make, car.model, trip.status; ";
        } else if($type == 'date'){
            $query = "SELECT trip.idTrip, trip.start_location, trip.end_location, trip.departure_date,  trip.seats_avail, users.fname, users.lname, users.prof_path, car.car_make, car.model,
            trip.status, MIN(rates.price), driver_ratings.avg_rating, driver_ratings.rating_count AS 'price' FROM trip JOIN users ON users.uID = trip.Users_idUsers JOIN car ON trip.Car_idCar = car.idCar JOIN rates ON rates.Trip_idTrip = trip.idTrip LEFT JOIN (
                                SELECT
                                    trip.Users_idUsers,
                                    AVG(rating.rating_stars) AS avg_rating,
                                    COUNT(rating.idRating) AS rating_count
                                FROM
                                    trip
                                    JOIN rating ON rating.Trip_idTrip = trip.idTrip
                                GROUP BY
                                    trip.Users_idUsers
                            ) AS driver_ratings ON driver_ratings.Users_idUsers = users.uID WHERE trip.status = 'Scheduled' AND trip.departure_date > CURRENT_TIMESTAMP AND trip.departure_date >= '$input' GROUP BY trip.idTrip, trip.start_location, trip.end_location, trip.departure_date, 
            trip.seats_avail, users.fname,  users.lname, car.car_make, car.model, trip.status;";
        } else if($type == 'seat'){
            $query = "SELECT trip.idTrip, trip.start_location, trip.end_location, trip.departure_date,  trip.seats_avail, users.fname, users.lname, users.prof_path, car.car_make, car.model,
                    trip.status, MIN(rates.price), driver_ratings.avg_rating, driver_ratings.rating_count AS 'price' FROM trip JOIN users ON users.uID = trip.Users_idUsers JOIN car ON trip.Car_idCar = car.idCar JOIN rates ON rates.Trip_idTrip = trip.idTrip LEFT JOIN (
                                SELECT
                                    trip.Users_idUsers,
                                    AVG(rating.rating_stars) AS avg_rating,
                                    COUNT(rating.idRating) AS rating_count
                                FROM
                                    trip
                                    JOIN rating ON rating.Trip_idTrip = trip.idTrip
                                GROUP BY
                                    trip.Users_idUsers
                            ) AS driver_ratings ON driver_ratings.Users_idUsers = users.uID WHERE trip.status = 'Scheduled' AND trip.departure_date > CURRENT_TIMESTAMP AND trip.seats_avail >= $input GROUP BY trip.idTrip, trip.start_location, trip.end_location, trip.departure_date, 
                    trip.seats_avail, users.fname,  users.lname, car.car_make, car.model, trip.status;";
        }
        
        
    } else{
        $query = "SELECT trip.idTrip, trip.start_location, trip.end_location, trip.departure_date,  trip.seats_avail, users.fname, users.lname, users.prof_path, car.car_make, car.model,
                    trip.status, MIN(rates.price), driver_ratings.avg_rating, driver_ratings.rating_count AS 'price' FROM trip JOIN users ON users.uID = trip.Users_idUsers JOIN car ON trip.Car_idCar = car.idCar JOIN rates ON rates.Trip_idTrip = trip.idTrip LEFT JOIN (
                                SELECT
                                    trip.Users_idUsers,
                                    AVG(rating.rating_stars) AS avg_rating,
                                    COUNT(rating.idRating) AS rating_count
                                FROM
                                    trip
                                    JOIN rating ON rating.Trip_idTrip = trip.idTrip
                                GROUP BY
                                    trip.Users_idUsers
                            ) AS driver_ratings ON driver_ratings.Users_idUsers = users.uID WHERE trip.status = 'Scheduled' AND trip.departure_date > CURRENT_TIMESTAMP GROUP BY trip.idTrip, trip.start_location, trip.end_location, trip.departure_date, 
                    trip.seats_avail, users.fname,  users.lname, car.car_make, car.model, trip.status;";
    }
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0){
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
                                <h3>".$row['fname']." ".$row['lname']."</h3>
                                <p>".$stars_string."</p>
                                <i class='fa-solid fa-location-pin' style='color: #ff710d;'></i><p style='display: inline-block; margin-left: 5px;' class='main-text'>".$row['start_location']."</p><br>
                                <i class='fa-solid fa-location-dot' style='color: #ff710d;'></i><p style='display: inline-block; margin-left: 5px;' class='main-text'>".$row['end_location']."</p><br>
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