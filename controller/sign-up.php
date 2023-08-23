<?php
    $database = new Database(require 'core/config.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    $errors = [];
    if(isset($_SESSION['fname']) && isset($_SESSION['mname']) && isset($_SESSION['lname']) && isset($_SESSION['phone']) && isset($_SESSION['email']) && isset($_SESSION['pswd'])){
        $fname = $_SESSION['fname'];
        $mname = $_SESSION['mname'];
        $lname = $_SESSION['lname'];
        $phone = $_SESSION['phone'];
        $bday = $_SESSION['bday'];
        $street = $_SESSION['street'];
        $brgy = $_SESSION['brgy'];
        $city = $_SESSION['city'];
        $prov = $_SESSION['prov'];
        $email = $_SESSION['email'];
        $password = password_hash($_SESSION['pswd'], PASSWORD_DEFAULT);
        $utype = 'Passenger';
        
        
        if($database->execQuery("INSERT INTO users VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 10, null, 0, 'Available', 0, DEFAULT);", [$fname, $mname, $lname, $phone, $bday, $street, $brgy, $city, $prov,  $email, $password, $utype])){
            unset($_SESSION['fname']);
            unset($_SESSION['mname']);
            unset($_SESSION['lname']);
            unset($_SESSION['phone']);
            unset($_SESSION['bday']);
            unset($_SESSION['street']);
            unset($_SESSION['brgy']);
            unset($_SESSION['city']);
            unset($_SESSION['prov']);
            unset($_SESSION['email']);
            unset($_SESSION['pswd']);
            header("Location: /vasalloj-carpool/login?verified");
        } else{
            dd('error registering user to system');
        }
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $result = $database->fetch("SELECT uEmail FROM users WHERE uEmail=?", [$email])->fetchAll();
            $rowCount = count($result);
            if($rowCount > 0){
                $errors['taken'] = 'Email is already taken';
            } else{
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

                header("Location: /vasalloj-carpool/login?register");
            }
        }
    }
    require 'view/sign-up.view.php';