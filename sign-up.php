<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="utilities.css">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color: #252e42;
        }
        #sign-up{
        background-color: white;
    margin: auto;
    width: 50%;
    border-radius: 8px;
    text-align: left;
    box-shadow: 0 0.6em 1.2em rgba(28, 0, 80, 0.06);
    }
    </style>
    
</head>
<body>
    <div class="container center-div" style="margin: auto; width: 70%;" id="sign-up">
        <div class="flex flex-main-spacebetween">
            <div id="right">
                <a href="login.php" class="second-text" style="color: #ff710d; text-decoration: none;">Back to Login</a>
                <h3 style="font-size: 20px;">Create an account</h3>
                <hr>
                <form action="./register.php" method="POST">
                    <div class="flex flex-main-spacebetween flex-gap-10">
                        <div>
                            
                            <p>Personal Information</p>
                            <input type="text" name="fname" id="" placeholder="First Name" required class="text-box">
                            <input type="text" name="mname" id="" placeholder="Middle Name" required class="text-box">
                            <input type="text" name="lname" id="" placeholder="Last Name" required class="text-box">
                            <input type="tel" name="phone" id="" placeholder="Phone Number" required class="text-box">
                            <input placeholder="Birthday" class="text-box" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" name="bday" required max="<?php echo date("Y-m-d", strtotime("-18 year", time()));?>"/>
                        </div>
                        <div>
                            <p>Address</p>
                            <input type="text" name="street" id="" placeholder="Street" required class="text-box">
                            <input type="text" name="brgy" id="" placeholder="Barangay" required class="text-box">
                            <input type="text" name="city" id="" placeholder="City" required class="text-box">
                            <input type="text" name="prov" id="" placeholder="Province" required class="text-box">
                        </div>
                    </div>
                    <hr>
                    <input type="email" name="email" id="" placeholder="Email Address" required class="text-box">
                    <input type="password" name="pswd" id="" placeholder="Password" required class="text-box">
                    <input type="submit" value="Create Account" name="submit" class="button" style="width: 100%;">
                </form>
            </div>
            <div id="left" class="flex flex-col flex-main-center flex-cross-center" style="width: 50%">
                <div class="glass">
                    <h1><b>Navigate</b> the streets, <b>Share</b> the seats.</h1>
                    <p>Navigate the streets with ease, sharing seats for a greener future. Together, let's make every journey efficient and enjoyable.</p>
                </div>
            </div>
        </div>
    </div>
    
    
</body>
</html>