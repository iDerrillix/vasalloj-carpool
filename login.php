<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        session_start();
    ?>
    <div class="login-form" style="transform: translateY(50%);">
    <?php
        if(isset($_SESSION['uID'])){
            unset($_SESSION['uID']);
        }
        if(isset($_GET['message']) && $_GET['message'] == 'loginfirst'){
            echo "<script>alert('You must be logged in first');</script>";
        }
        if(isset($_GET['error'])){
            echo "<p style='color: red'>Wrong email and password</p>";
        }
    ?>
    <h3>Login</h3>
    <form action="sign-in.php" method="POST">
        <label for="">Email Address</label><br>
        <input type="email" name="uEmail" id="" required class="text-box"><br>
        <label for="">Password</label><br>
        <input type="password" name="uPswd" id="" required class="text-box"><br>
        <input type="submit" value="Login" name="submit" class="button">
    </form>
    <p>No account yet?</p>
    <a href="sign-up.php">Create one here</a>
    </div>
    
</body>
</html>