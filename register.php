<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    require 'dbcon.php';

    if(isset($_POST['submit'])){
        
        $_SESSION['fname'] = $_POST['fname'];
        $_SESSION['mname'] = $_POST['mname'];
        $_SESSION['lname'] = $_POST['lname'];
        $_SESSION['phone'] = $_POST['phone'];
        $_SESSION['bday'] = $_POST['bday'];
        $_SESSION['street'] = $_POST['street'];
        $_SESSION['brgy'] = $_POST['brgy'];
        $_SESSION['city'] = $_POST['city'];
        $_SESSION['prov'] = $_POST['prov'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['pswd'] = $_POST['pswd'];
        $email = $_SESSION['email'];
        $result = mysqli_query($con, "SELECT uEmail FROM users WHERE uEmail='$email'");
        $rowCount = mysqli_num_rows($result);
        if($result){
            if($rowCount > 0){
                echo "<script>alert('Email is already taken');window.location.href='sign-up.php';</script>";
                exit;
            } else {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'iderrillixkr@gmail.com';
                $mail->Password = 'vidmzdrajpqnpgqh';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                // $mail->setFrom('jjfoodtrays@gmail.com');
                $mail->addAddress($_SESSION['email']);
                $mail->From = 'iderrillixkr@gmail.com';
                $mail->addReplyTo($_SESSION['email'], 'Carpool App');
                $mail->isHTML(true);
                $mail->Subject = 'Carpool App';
                $mail->Body = "<html><b>Carpool App</b><hr>Good day, you only have one step to use the app. Click the link below to finalize the carpool App Registration<br><a href='localhost/vasalloj-carpool/verify.php'>Verifying Email Address</a></html>";
                $mail->send();
                

                header("Location: login.php?register");
                exit;
            }
            
        } else {
            echo 'failed';
        }
        

    }
?>