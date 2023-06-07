<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Account Registration</h1>
    <hr>
    <form action="./register.php" method="POST">
        <p>Personal Information</p>
        <input type="text" name="fname" id="" placeholder="First Name" required class="text-box"><br>
        <input type="text" name="mname" id="" placeholder="Middle Name" required class="text-box"> <br>
        <input type="text" name="lname" id="" placeholder="Last Name" required class="text-box"><br>
        <input type="tel" name="phone" id="" placeholder="Phone Number" required class="text-box"> <br>
        <input placeholder="Birthday" class="text-box" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" name="bday" required/>
        <p>Address</p>
        <input type="text" name="street" id="" placeholder="Street" required class="text-box"><br>
        <input type="text" name="brgy" id="" placeholder="Barangay" required class="text-box"><br>
        <input type="text" name="city" id="" placeholder="City" required class="text-box"><br>
        <input type="text" name="prov" id="" placeholder="Province" required class="text-box"><br>
        <br>
        <input type="email" name="email" id="" placeholder="Email Address" required class="text-box"><br>
        <input type="password" name="pswd" id="" placeholder="Password" required class="text-box"><br>
        <input type="submit" value="Register" name="submit" class="button">
    </form>
    </div>
    
    
</body>
</html>