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
          <a href="report.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Exchange</span>
          </a>
        </li>
        <li>
          <a href="usermasterlist.php" class="active">
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
            <div class="title">Users Masterlist</div>
            <hr>
            <div class="cars">
              <h4>Passengers Masterlist</h4>
              <table id="dtBasicExample3" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead class="">
                  <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Birthday</th>
                      <th>Street</th>
                      <th>Brgy</th>
                      <th>City</th>
                      <th>Prov</th>
                      <th>Balance</th>              
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  <?php
                        $sql = "SELECT * FROM users WHERE utype = 'Passenger'";
                        $result = mysqli_query($con, $sql);
                        while($row = mysqli_fetch_assoc($result)):
                        ?>
                        <td><?=$row['uID']?></td>
                        <td><?php echo $row['fname'].' '.$row['mname'].' '.$row['lname']?></td>
                        <td><?=$row['uPhone']?></td>
                        <td><?=$row['uEmail']?></td>
                        <td><?=$row['birthday']?></td>
                        <td><?=$row['street']?></td>
                        <td><?=$row['brgy']?></td>
                        <td><?=$row['city']?></td>
                        <td><?=$row['prov']?></td>
                        <td><?=$row['ticket_bal']?></td>             
                    </tr>                    
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
            <hr>
            <div class="cars">
              <h4>Registered Drivers Masterlist</h4>
              <table id="dtBasicExample4" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead class="">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Birthday</th>
                    <th>Street</th>
                    <th>Brgy</th>
                    <th>City</th>
                    <th>Prov</th>
                    <th>License no</th>
                    <th>Balance</th>                   
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                      $sql = "SELECT * FROM users WHERE uType = 'Driver'";
                      $result = mysqli_query($con, $sql);
                      while($row = mysqli_fetch_assoc($result)):
                    ?>
                      <td><?=$row['uID']?></td>
                      <td><?php echo $row['fname'].' '.$row['mname'].' '.$row['lname']?></td>
                      <td><?=$row['uPhone']?></td>
                      <td><?=$row['uEmail']?></td>
                      <td><?=$row['birthday']?></td>
                      <td><?=$row['street']?></td>
                      <td><?=$row['brgy']?></td>
                      <td><?=$row['city']?></td>
                      <td><?=$row['prov']?></td>
                      <td><?=$row['lic_no']?></td>
                      <td><?=$row['ticket_bal']?></td>        
                    </tr>                 
                  <?php endwhile; ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
            <hr>
            <div class="cars">
              <h4>Unregistered Drivers Masterlist</h4>
              <table id="dtBasicExample5" class="table table-bordered table-sm table-hover" cellspacing="0" width="100%">
                <thead class="">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Birthday</th>
                    <th>Street</th>
                    <th>Brgy</th>
                    <th>City</th>
                    <th>Prov</th>
                    <th>License no</th>
                    <th>Balance</th>              
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                      $sql = "SELECT * FROM users WHERE applicant = 1";
                      $result = mysqli_query($con, $sql);
                      while($row = mysqli_fetch_assoc($result)):
                    ?>
                      <td><?=$row['uID']?></td>
                      <td><?php echo $row['fname'].' '.$row['mname'].' '.$row['lname']?></td>
                      <td><?=$row['uPhone']?></td>
                      <td><?=$row['uEmail']?></td>
                      <td><?=$row['birthday']?></td>
                      <td><?=$row['street']?></td>
                      <td><?=$row['brgy']?></td>
                      <td><?=$row['city']?></td>
                      <td><?=$row['prov']?></td>
                      <td><?=$row['lic_no']?></td>
                      <td><?=$row['ticket_bal']?></td>      
                    </tr>                 
                  <?php endwhile; ?>
                </tbody>
                <tfoot>
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