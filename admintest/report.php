<?php
require '../dbcon.php';
if(!isset($_SESSION['uID'])){
  header("Location: login.php?message=loginfirst");
  exit;
} else if($_SESSION['uType'] != 'Admin'){
  header("Location: login.php?message=loginfirst");
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
          <a href="report.php" class="active">
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
          <a href="#">
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name">Stock</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-book-alt' ></i>
            <span class="links_name">Total order</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-user' ></i>
            <span class="links_name">Team</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-message' ></i>
            <span class="links_name">Messages</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-heart' ></i>
            <span class="links_name">Favrorites</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-cog' ></i>
            <span class="links_name">Setting</span>
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
            <div class="box-topic">Most Cash ins</div>
            <?php
              $sql = "SELECT COUNT(cashtransaction.idCashTransac) AS count,
              CONCAT(users.fname ,' ',users.lname) AS name,
              transac_type,
              SUM(cashtransaction.transac_amount) AS count2,
              convert_fee
              FROM cashtransaction
              JOIN users ON users.uID = cashtransaction.Users_idUsers
              WHERE transac_status = 'complete'
              AND transac_type = 'Cash In'
              GROUP BY cashtransaction.Users_idUsers;";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="number"><?=$row['count2']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">by: <?=$row['name']?></span>
            </div>
          </div>
          <i class="fa-solid fa-money-bill-trend-up"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Most Cash outs</div>
            <?php
              $sql = "SELECT COUNT(cashtransaction.idCashTransac) AS count,
              CONCAT(users.fname ,' ',users.lname) AS name,
              transac_type,
              SUM(cashtransaction.transac_amount) AS count2,
              convert_fee
              FROM cashtransaction
              JOIN users ON users.uID = cashtransaction.Users_idUsers
              WHERE transac_status = 'complete'
              AND transac_type = 'Cash Out'
              GROUP BY cashtransaction.Users_idUsers;";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="number"><?=$row['count2']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">By: <?=$row['name']?></span>
            </div>
          </div>
          <i class="fa-solid fa-hand-holding-dollar"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Exchange Profit</div>
            <?php
              $sql = "SELECT SUM(convert_fee) + SUM(process_fee) AS sum2 FROM cashtransaction WHERE transac_status = 'complete'";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="number"><?=$row['sum2']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text"></span>
            </div>
          </div>
          <i class="fa-solid fa-money-bill-transfer"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Ticket Pool</div>
            <?php
              $sql = "SELECT SUM(ticket_bal) AS sum FROM users";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="number"><?=$row['sum']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text"></span>
            </div>
          </div>
          <i class="fa-solid fa-ticket"></i>
        </div>
      </div>
        <div class="report-wrapper">
        <div class="sales-boxes three3">
          <div class="top-sales box">
            <div class="title">Cash transactions</div>
            <hr>
            <div class="cars">
              <h4>Cash in transactions</h4>
              <table id="dtBasicExample3" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead class="">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Conversion Fee</th>                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    $sql = "SELECT cashtransaction.idCashTransac, users.fname, users.mname, users.lname, cashtransaction.transac_amount, cashtransaction.convert_fee FROM cashtransaction JOIN users ON cashtransaction.Users_idUsers = users.uID WHERE cashtransaction.transac_status = 'Complete' AND cashtransaction.transac_type='Cash In';";
                    $sqlTotal = "SELECT SUM(transac_amount) AS total1, SUM(convert_fee) AS total2 FROM cashtransaction WHERE transac_type='Cash In' AND transac_status='Complete';";
                    $resultTotal = mysqli_query($con, $sqlTotal);
                    $rowTotal = mysqli_fetch_assoc($resultTotal);
                    $result = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($result)):
                    ?>
                    <td><?=$row['idCashTransac']?></td>
                    <td><?php echo $row['fname'].' '. $row['lname'];?></td>
                    <td><?=$row['transac_amount']?></td>
                    <td><?=$row['convert_fee']?></td> 
                    </tr>                 
                  <?php endwhile; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>Total: <?=$rowTotal['total1']?></td>
                    <td>Total: <?=$rowTotal['total2']?></td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <hr>
            <div class="cars">
              <h4>Cash out transactions</h4>
              <table id="dtBasicExample4" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead class="">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Processing Fee</th>                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    $sql = "SELECT cashtransaction.idCashTransac, users.fname, users.mname, users.lname, cashtransaction.transac_amount, cashtransaction.process_fee FROM cashtransaction JOIN users ON cashtransaction.Users_idUsers = users.uID WHERE cashtransaction.transac_status = 'Complete' AND cashtransaction.transac_type='Cash Out';";
                    $sqlTotal = "SELECT SUM(transac_amount) AS total1, SUM(process_fee) AS total2 FROM cashtransaction WHERE transac_type='Cash Out' AND transac_status='Complete';";
                    $resultTotal = mysqli_query($con, $sqlTotal);
                    $rowTotal = mysqli_fetch_assoc($resultTotal);
                    $result = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($result)):
                    ?>
                    <td><?=$row['idCashTransac']?></td>
                    <td><?php echo $row['fname'].' '. $row['lname'];?></td>
                    <td><?=$row['transac_amount']?></td>
                    <td><?=$row['process_fee']?></td> 
                    </tr>                 
                  <?php endwhile; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>Total: <?=$rowTotal['total1']?></td>
                    <td>Total: <?=$rowTotal['total2']?></td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <hr>
            <div class="cars">
              <h4>Balance Tickets</h4>
              <table id="dtBasicExample5" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead class="">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Balance</th>                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    $sql = "SELECT uID, fname, mname, lname, ticket_bal FROM users WHERE uType='Passenger' OR uType='Driver';";
                    $sqlTotal = "SELECT SUM(ticket_bal) AS total FROM users WHERE uType='Passenger' OR uType='Driver';";
                    $resultTotal = mysqli_query($con, $sqlTotal);
                    $rowTotal = mysqli_fetch_assoc($resultTotal);
                    $result = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($result)):
                    ?>
                    <td><?=$row['uID']?></td>
                    <td><?php echo $row['fname'].' '. $row['lname'];?></td>
                    <td><?=$row['ticket_bal']?></td> 
                    </tr>                 
                  <?php endwhile; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>Total: <?=$rowTotal['total']?></td>
                  </tr>
                </tfoot>
              </table>
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