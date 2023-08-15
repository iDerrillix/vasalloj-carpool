<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="modal.css">
    <link rel="stylesheet" href="utilities.css">
    <link rel="stylesheet" href="./login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | TigerRide</title>
</head>
<body>
    <?php 
        session_start();
    ?>
    <div class="modal-background" onclick="toggleModal()"></div>
    <div class="modal" id="modal">
        <h2>Thank you for contacting us!</h2>
        <p>
            Thank you for leaving an honest review!
        </p>
    </div>
    <script src="modal.js">
    </script>
    <div class="login-form center-div">
        <div class="flex flex-main-spacebetween">
            <div id="left" class="flex flex-col flex-main-center flex-cross-center">
                <div class="glass">
                    <h1><b>Navigate</b> the streets, <b>Share</b> the seats.</h1>
                    <p>Navigate the streets with ease, sharing seats for a greener future. Together, let's make every journey efficient and enjoyable.</p>
                </div>
            </div>
            <div id="right">
                <img src="./img/tigerride-white.jpg" alt="" style="width: 100px; border-radius: 100px;">
                <br>
                <h3 style="font-size: 20px;">Welcome Back!</h3>
                <p>Sign-in here</p>
                <br>
                <form action="sign-in.php" method="POST">
                    <label for="">Email Address</label><br>
                    <input type="email" name="uEmail" id="" required class="text-box">
                    <label for="">Password</label><br>
                    <input type="password" name="uPswd" id="" required class="text-box">
                    <?php
                    if(isset($_SESSION['uID'])){
                        unset($_SESSION['uID']);
                        unset($_SESSION['status']);
                        unset($_SESSION['uType']);
                    }
                    if(isset($_GET['error'])){
                        echo "<p style='color: red; text-align: center;'>Wrong email and password</p>";
                    }
                    ?>
                    <input type="submit" value="Login" name="submit" class="button" style="width: 100%;">
                </form>
                
                <br>
                <p>No account yet?</p>
                
                <a href="sign-up.php" class="second-text" style="color: #ff710d; text-decoration: none;">Create one here</a>
            </div>
        </div>
    
    </div>
    
</body>
</html>
<?php
    if(isset($_GET['message']) && $_GET['message'] == 'loginfirst'){
        echo "<script>toggleModal('Login First', 'You must login first');</script>";
    }
    if(isset($_GET['register'])){
        echo "<script>toggleModal('Verify your email address', 'A link has been sent to your email address. Please check your inbox and click the link to verify your email.');</script>";
    } else if(isset($_GET['verified'])){
        echo "<script>toggleModal('Email Verified', 'You can now login using the email associated with your account.');</script>";
    }
?>