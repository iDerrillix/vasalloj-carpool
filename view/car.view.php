<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="utilities.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars | TigerRide</title>
</head>
<body>
    <?php
    if(isset($response['success'])){
        echo "<script>hideLayer(2);</script>";
    }
    ?>
    <div class="container" style="width: 50%; margin: 0 auto; margin-top: 100px;">
        <form method="POST" id="form">
            <div id="license" style="text-align: center;">
                <p class="heading second-text"><b>Enter Your License Number</b></p>
                <br>
                <input type="text" name="lic_no" id="lic_no" placeholder="License No." value="<?php echo $lic_no['lic_no'];?>" required="true" class="text-box" pattern="[A-Z][0-9][0-9]-[0-9][0-9]-[0-9][0-9][0-9][0-9][0-9][0-9]" title="11 Digit License No. [A00-00-000000]">
                <input type="button" value="Next" id="license-next" class="button" onclick="hideLayer(1);"> 
            </div>
            <div id="details" style="text-align: center; display: none;">
                <h4>Enter Vehicle Information</h4>
                <input type="text" name="plate_no" id="plate_no" placeholder="Plate No." required="true" class="text-box" pattern="[A-Z][A-Z][A-Z]-[0-9][0-9][0-9][0-9]">
                <input type="text" name="make" id="make" placeholder="Make e.g. Kia" required="true" class="text-box">
                <input type="text" name="model" id="model" placeholder="Model e.g. Stonic" required="true" class="text-box">
                <input type="text" name="chassis_no" id="chassis_no" placeholder="Chassis No." required="true" class="text-box" minlength="17" maxlength="17" title="Found in the vehicle's C.O.R.">
                <select name="car_type" id="car_type" class="text-box" required="true">
                    <option value="SUV">SUV</option>
                    <option value="Sedan">Sedan</option>
                    <option value="MPV">MPV</option>
                </select>
                <input type="number" name="capacity" id="capacity" placeholder="Capacity" required="true" class="text-box" min="0" max="4">
                <input type="button" value="Register Car" id="details-next" class="button"> 
            </div>
            <div id="approval" style="text-align: center; display: none;">
                <h4>Waiting for Approval</h4>
                <p>Please keep your communication lines open for updates</p>
                <input type="submit" value="Done" class="button"  name="submit">
            </div>
        </form>
    </div>
    <div id="cars" class="container" style="width: 50%; margin: 0 auto; margin-top: 20px;">
        <p class="heading second-text"><b>Registered Cars</b></p>
        <table class="simple-table" style="width: 100%;">
                <?php
                    foreach($cars as $car){
                        if($car['approved'] == 0){
                            $approve = "Not Registered";
                        } else {
                            $approve = "Registered";
                        }
                        echo "<tr>
                        <td>".$car['idCar']."</td>
                        <td>".$car['plate_no']."</td>
                        <td>".$car['car_make']."</td>
                        <td>".$car['model']."</td>
                        <td>".$car['type']."</td>
                        <td>".$car['capacity']."</td>
                        <td>".$approve."</td>
                        </tr>";
                    }
                ?>
        </table>
        </div>
    
    <script>
        
        function hideLayer(num){
            if(num == 1){
                if(document.querySelector("#lic_no").value == "" || !document.querySelector("#lic_no").checkValidity()){
                    alert("Missing or Wrong Fields");
                } else {
                    document.querySelector("#cars").style.display = "none";
                    document.querySelector("#license").style.display = "none";
                    document.querySelector("#details").style.display = "block";
                }
                
            } else if (num == 2){
                if(!document.querySelector("#plate_no").checkValidity() || !document.querySelector("#model").checkValidity() || !document.querySelector("#make").checkValidity() || !document.querySelector("#chassis_no").checkValidity() || !document.querySelector("#capacity").checkValidity() || !document.querySelector("#car_type").checkValidity()){
                    alert("Missing Fields");
                    document.querySelector("#plate_no").reportValidity();
                    document.querySelector("#model").reportValidity();
                    document.querySelector("#make").reportValidity();
                    document.querySelector("#chassis_no").reportValidity();
                    document.querySelector("#capacity").reportValidity();
                    document.querySelector("#car_type").reportValidity();
                } else {
                    document.querySelector("#license").style.display = "none";
                    document.querySelector("#details").style.display = "none";
                    document.querySelector("#approval").style.display = "block";
                }
                
            }
        }
        document.querySelector("#details-next").addEventListener("click", function(e){
            e.preventDefault();
            hideLayer(2);
        }, false);
    </script>
</body>
</html>