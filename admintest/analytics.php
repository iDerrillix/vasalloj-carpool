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
    <title>Analytics</title>
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
    $('#dtBasicExample2,#dtBasicExample3, #dtBasicExample4, #dtBasicExample5').DataTable({
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
          <a href="analytics.php" class="active">
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
          <a href="../login.php">
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
            <div class="box-topic">Popular Residence</div>
            <?php
              $sql = "SELECT COUNT(fname) as COUNT, fname, brgy FROM users GROUP BY brgy ORDER BY COUNT DESC;";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="number"><?=$row['brgy']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text"></span>
            </div>
          </div>
          <i class="fa-solid fa-house-user"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total users</div>
            <?php
              $sql = "SELECT COUNT(uID) AS count2 FROM users";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="number"><?=$row['count2']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text"></span>
            </div>
          </div>
          <i class="fa-solid fa-user-group"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Passengers</div>
            <?php
              $sql = "SELECT COUNT(uID) AS sum2 FROM users WHERE uType = 'Passenger'";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="number"><?=$row['sum2']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text"></span>
            </div>
          </div>
          <i class="fa-solid fa-user-check"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Drivers</div>
            <?php
              $sql = "SELECT COUNT(uID) AS sum2 FROM users WHERE uType = 'Driver'";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="number"><?=$row['sum2']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text"></span>
            </div>
          </div>
          <i class="fa-solid fa-user-gear"></i>
        </div>
      </div>
        <div class="report-wrapper">
        <div class="sales-boxes three3">
          <div class="top-sales box">
            <div class="title">User Analytics</div>
            <hr>
            <?php
              $sql = "SELECT COUNT(fname) as COUNT, fname, brgy FROM users GROUP BY brgy ORDER BY COUNT DESC;";
              $result = mysqli_query($con, $sql);
              $count = array();
              $residence = array();
              while($row=mysqli_fetch_array($result)){
                $count[] = $row['COUNT'];
                $residence[] = $row['brgy'];
              }
            ?>
            <div class="analytics-wrapper">
              <div class="donut-heading">
                <h1>Residence of users</h1>
              </div>
              <div class="donut-report">
                <canvas id="myChart"></canvas>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
              </div>
              <hr>
              <?php
                $sql = "SELECT COUNT(uID) AS driver from users WHERE uType = 'Driver'";
                $sql2 = "SELECT COUNT(uID) AS passenger from users WHERE uType = 'Passenger'";
                $result = mysqli_query($con, $sql);
                $result2 = mysqli_query($con, $sql2);
                $driver = array();
                $passenger = array();
                while($row=mysqli_fetch_array($result)){
                  $driver[] = $row['driver']; 
                }
                while($row=mysqli_fetch_array($result2)){
                  $passenger[] = $row['passenger'];
                }
              ?>
              <div class="donut-report-wrapper">
                <div class="donut-report2">
                  <canvas id="myChart2" style="width: 50%;"></canvas>
                  <script>
                // Script for pakening donut chart
                const driver = <?php echo json_encode($driver)?>;
                const pass = <?php echo json_encode($passenger)?>;
                console.log(driver);
                console.log(pass);
                function generateData() {
                  const dataCount = 5;
                  const data = [];
                  for (let i = 0; i < dataCount; i++) {
                    data.push(Math.floor(Math.random() * 100));
                  }
                  return data;
                }
                const data = {
                  labels: ['Driver', 'Passenger'],
                  datasets: [{
                    label: 'Difference',
                    data: [driver,pass],
                    backgroundColor: [
                      'red', 'orange', 'yellow', 'green', 'blue'
                    ],
                  }]
                };
                const config = {
                  type: 'doughnut',
                  data: data,
                  options: {
                    responsive: true,
                    plugins: {
                      legend: {
                        position: 'top',
                      },
                      title: {
                        display: true,
                        text: ''
                      }
                    }
                  },
                };
                const myChart = new Chart(
                  document.getElementById('myChart2'),
                  config
                );
              </script>
                  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                </div>
                  <div class="donut-name">
                    <h1>Passenger to Driver ratio</h1>
                  </div>
              </div>
              <hr>
              <div class="donut-report-wrapper polar-wrap">
                <div class="donut-report2">
                  <?php
                  $sql = "SELECT COUNT(model) AS count, model, capacity, car_make, type FROM car GROUP BY model ORDER BY count DESC;";
                  $result = mysqli_query($con, $sql);
                  $carCount  = array();
                  $carName = array();
                  while($row=mysqli_fetch_array($result)){
                    $carCount[] = $row['count'];
                    $carName[] = $row['model'];
                  }
                  ?>
                  <canvas id="myChart3" style="width: 50%;"></canvas>
                  <script>
                    const carCount = <?php echo json_encode($carCount)?>;
                    const carName = <?php echo json_encode($carName)?>;
                    const data2 = {
                    labels: carName,
                    datasets: [{
                      label: 'Model',
                      data: carCount,
                      backgroundColor2: [
                        'rgb(255, 99, 132)',
                        'rgb(75, 192, 192)',
                        'rgb(255, 205, 86)',
                        'rgb(201, 203, 207)',
                        'rgb(54, 162, 235)'
                      ]
                    }]
                    };
                    const config2 = {
                      type: 'polarArea',
                      data: data2,
                      options: {}
                    };
                    const myChart2 = new Chart(
                      document.getElementById('myChart3'),
                      config2
                    );
                  </script>
                  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                </div>
                <div class="donut-name">
                    <h1>Most common user vehicle</h1>
                  </div>
              </div>
            </div>
            <script> //script for Residence
              var colors = ['red', 'green', 'blue', 'orange', 'yellow', 'gray', 'violet', 'pink'];
              var colorArray = colors[Math.floor(Math.random() * colors.length)];
              const residence = <?php echo json_encode($residence)?>;
              const count = <?php echo json_encode($count)?>;
              var backgroundColors = [];
              console.log(residence);
              console.log(count);
              for (var i = 0; i < residence.length; i++) {
                var colorIndex = i % colors.length;
                backgroundColors.push(colors[colorIndex]);
              }
              const ctx = document.getElementById('myChart');
              new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: residence,
                  datasets: [{
                    label: 'Residences',
                    data: count,
                    borderWidth: 1,
                    backgroundColor: backgroundColors 
                  }]
                },
                options: {
                  scales: {
                    y: {
                      beginAtZero: true
                    }
                  }
                }
              });
            </script>
             </div>
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