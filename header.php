<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="modal.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php 
        if(!isset($_SESSION['uID'])){
            header("Location: login.php?message=loginfirst");
            exit;
        }
    ?>
    <header>
        <h3>Carpool</h3>
        <ul>
            <li>
                <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            </li>
            <li>
                <a href="profile.php"><i class="fa-solid fa-id-card"></i> Profile</a>
            </li>
            <li>
                <a href="tickets.php"><i class="fa-solid fa-ticket"></i> Tickets</a>
            </li>
            <li>
                <a href="car.php"><i class="fa-solid fa-car"></i> Cars</a>
            </li>
            
            <li>
                <?php 
                    if(isset($_SESSION['uID'])){
                        echo "<a class='log-btn' href='login.php'><b>Logout</b></a>";
                    } else {
                        echo "<a class='log-btn' href='login.php'>Login</a>";
                    }
                ?>
                
            </li>
        </ul>
    </header>
    <div class="modal-background" onclick="toggleModal()"></div>
    <div class="modal" id="modal">
        <h2>Thank you for contacting us!</h2>
        <p>
            Thank you for leaving an honest review!
        </p>
    </div>
    <script src="modal.js">
    </script>
    <script src="alert.js">
    </script>
    
    <script>
          $(document).ready(function() {
            checkBookingStatus('<?php echo $_SESSION['uType'];?>');
        });
    </script>
</body>
</html>