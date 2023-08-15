<?php
require '../dbcon.php';
if(!isset($_SESSION['uID'])){
  header("Location: ../login.php?message=loginfirst");
  exit;
} else if($_SESSION['uType'] != 'Admin'){
  header("Location: ../login.php?message=loginfirst");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script type="text/javascript" src="../plugins/js/jquery.min.js"></script>
    <script type="text/javascript" src="../plugins/js/popper.min.js"></script>
    <script type="text/javascript" src="../plugins/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="../plugins/js/mdb.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <!-- Plugin file -->
    <script src="https://kit.fontawesome.com/f17013d72c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
      <link rel="stylesheet" href="../plugins/css/bootstrap.min.css">
      <link rel="stylesheet" href="../plugins/css/mdb.min.css">
      <!-- Plugin file -->
      <link rel="stylesheet" href="../plugins/css/addons/datatables.min.css">
      <link rel="stylesheet" href="../plugins/css/style.css">
      <script src="../plugins/js/addons/datatables.min.js"></script>
   </head>
<body>
<script>
   $(document).ready(function () {
    $('#dtBasicExample6,#dtBasicExample7, #dtBasicExample8, #dtBasicExample9').DataTable({
    "pagingType": "full_numbers",
    "paging": true,
    "lengthMenu": [10, 25, 50, 75, 100]
    });
    $('.dataTables_length').addClass('bs-select');
    });
  </script>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">Carpool</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="adminPanel.php">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="report.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Exchange</span>
          </a>
        </li>
        <li>
          <a href="usermasterlist.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">User list</span>
          </a>
        </li>
        <li>
          <a href="analytics.php">
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">User Analytics</span>
          </a>
        </li>
        <li>
          <a href="trips.php" class="active">
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name">Trips List</span>
          </a>
        </li>
        <li class="log_out">
          <a href="#">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>
      
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Trips made</div>
            <?php
              $sql = "SELECT COUNT(idTrip) as COUNT FROM trip";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="number"><?=$row['COUNT']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text"></span>
            </div>
          </div>
          <i class="fa-solid fa-road-barrier"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Most Common Location</div>
            <?php
              $sql = "SELECT COUNT(end_location) AS count1, idTrip, end_location, Users_idUsers FROM trip GROUP BY end_location ORDER BY count1 DESC;";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="number"><?=$row['end_location']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text"></span>
            </div>
          </div>
          <i class="fa-solid fa-location-dot"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic"><?=$row['end_location']?> Count</div>
            <div class="number"><?=$row['count1']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text"></span>
            </div>
          </div>
          <i class="fa-solid fa-user-check"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Least Common Location</div>
            <?php
              $sql = "SELECT COUNT(end_location) AS count1, idTrip, end_location, Users_idUsers FROM trip GROUP BY end_location ORDER BY count1 ASC";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="number"><?=$row['end_location']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text"></span>
            </div>
          </div>
          <i class="fa-solid fa-location-dot"></i>
        </div>
      </div>
        <div class="report-wrapper">
        <div class="sales-boxes three3">
          <div class="top-sales box">
            <div class="title">Active Trips</div>
            <hr>
            <div class="cars">
              <h4>Carpooling History</h4>
              <table id="dtBasicExample6" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead class="">
                  <tr>
                      <th>#</th>
                      <th>Start</th>
                      <th>Location</th>
                      <th>Departure</th>
                      <th>Driver</th>
                      <th>Car</th> 
                      <th>Type</th>
                      <th>Plate</th> 
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  <?php
                        $sql = "SELECT trip.idTrip, trip.start_location, trip.end_location, trip.departure_date, CONCAT(users.fname,' ',users.lname,' ',users.lname) AS name, car.car_make,car.capacity,car.plate_no,car.type
                        FROM trip JOIN users ON users.uID = trip.Users_idUsers JOIN car ON car.idCar = trip.Car_idCar";
                        $result = mysqli_query($con, $sql);
                        while($row = mysqli_fetch_assoc($result)):
                        ?>
                        <td><?=$row['idTrip']?></td>
                        <td><?=$row['start_location']?></td>
                        <td><?=$row['end_location']?></td>
                        <td><?=$row['departure_date']?></td>
                        <td><?=$row['name']?></td>
                        <td><?=$row['car_make']?></td>
                        <td><?=$row['type']?></td>
                        <td><?=$row['plate_no']?></td>   
                    </tr>                    
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
            <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
    sidebar.classList.toggle("active");
    if(sidebar.classList.contains("active")){
    sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
    }else
    sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
 </script>
</body>
</html>