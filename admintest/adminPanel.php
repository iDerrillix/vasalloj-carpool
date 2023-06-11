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
    <script src="https://kit.fontawesome.com/f17013d72c.js" crossorigin="anonymous"></script>
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
    $('#dtBasicExample, #dtBasicExample2').DataTable({
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
          <a href="adminPanel.php" class="active">
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
            <div class="box-topic">Approved Cars</div>
            <?php
              $sql = "SELECT COUNT(idCar) AS cars FROM car";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="number"><?=$row['cars']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text"></span>
            </div>
          </div>
          <i class="fa-solid fa-car"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Applicants</div>
            <?php
              $sql = "SELECT COUNT(applicant) as counts FROM users WHERE applicant=1";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="number"><?=$row['counts']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text"></span>
            </div>
          </div>
          <i class="fa-solid fa-users"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Unregistered cars</div>
            <?php
              $sql = "SELECT COUNT(approved) as count FROM car WHERE approved=0";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="number"><?=$row['count']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text"></span>
            </div>
          </div>
          <i class="fa-sharp fa-solid fa-car-side" style=""></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Most popular Car</div>
            <?php
              $sql = "SELECT COUNT(model) AS count, model, capacity, car_make, type FROM CAR GROUP BY model ORDER BY count DESC";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
            ?>
            <div class="number"><?=$row['model']?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text"></span>
            </div>
          </div>
          <i class="fa-solid fa-car-on"></i>
        </div>
      </div>

      <div class="separator">
        <div class="sales-boxes">
          <div class="top-sales box one">
            <div class="title">Vehicle Registrants</div>
            <hr>
            <div class="accounts">
              <table id="dtBasicExample" class="table table-bordered table-sm table-hover" cellspacing="0" width="100%">
                <thead class="">
                    <tr>
                      <th>Owner</th>
                      <th>Make</th>
                      <th>Model</th>
                      <th>Plate No.</th>
                      <th>Chassis No.</th>
                      <th>Type</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $sql = "SELECT users.uID, car.idCar, users.fname, users.mname, users.lname, car.idCar, car.car_make, car.model, car.plate_no, car.chassis_no, car.type FROM users JOIN car ON users.uID = car.Users_idUsers WHERE users.applicant=1 OR car.approved=0;";
                        $result = mysqli_query($con, $sql);
                        while($row = mysqli_fetch_assoc($result)):
                        ?>
                        <td><?=$row['fname']?></td>
                        <td><?=$row['car_make']?></td>
                        <td><?=$row['model']?></td>
                        <td><?=$row['plate_no']?></td>
                        <td><?=$row['chassis_no']?></td>
                        <td><?=$row['type']?></td>
                        <td><a href="../script/approve.php?car_id=<?=$row['idCar']?>&uID=<?=$row['uID']?>"><i class="fa-solid fa-square-check"></i></a>&nbsp<a href=""><i class="fa-solid fa-square-xmark"></i></a></td>
                    </tr>                    
                    <?php endwhile; ?>
                </tbody>
                <tfoot>                 
                </tfoot>
              </table>
            </div>       
          </div>
        </div>
        <div class="sales-boxes two">
          <div class="top-sales box">
            <div class="title">Cash in Cash out</div>
            <hr>
            <div class="cars">
              <table id="dtBasicExample2" class="table table-bordered table-sm table-hover" cellspacing="0" width="100%">
                <thead class="">
                  <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Amount</th>                 
                    <th>Fee</th>
                    <th>Gcash Ref. ID</th>
                    <th>Gcash No.</th>
                    <!-- <th>Balance</th> -->
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    $placeholder = 'REF ID';
                    $self = $_SERVER['PHP_SELF'];
                    $sql = "SELECT * FROM cashtransaction WHERE transac_status='Pending';";
                    $result = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($result)):
                      $date = $row['transac_date'];
                      $newDate = date("d-m-Y", strtotime($date));
                      if($row['transac_type'] == 'Cash In'){
                        $fee = $row['convert_fee'];  
                      }else if($row['transac_type'] == 'Cash Out'){                      
                        $fee = $row['process_fee'];                  
                      }
                      if($row['gcash_ref'] == NULL){
                        $id = $row['idCashTransac'];
                        $ref = "<form method='GET' action='$self'>
                        <input type ='number' placeholder='$placeholder' style='width: 60%;' name='ref' value='ref'>
                        <input type='hidden' name='id' value='$id'><input type='submit' value='send'>
                        </form>";
                      }else{
                        $ref = $row['gcash_ref'];
                      }
                    ?>
                    <td><?=$row['idCashTransac']?></td>
                    <td><?=$row['transac_type']?></td>
                    <td><?=$newDate?></td>
                    <td><?=$row['transac_amount']?></td>
                    <td><?=$fee?></td>
                    <td><?=$ref?></td>
                    <td><?=$row['gcash_no']?></td>
                    <!-- <td></?=$row['transac_bal']?></td> -->
                    <td><?=$row['transac_status']?></td>
                    <td><a id="link" href="../script/approve-transaction.php?idCashTransac=<?=$row['idCashTransac']?>&approve=true">
                    <i class="fa-solid fa-square-check"></i></a>&nbsp
                    <a href="../script/approve-transaction.php?idCashTransac=<?=$row['idCashTransac']?>&approve=false">
                    <i class="fa-solid fa-square-xmark"></i></a>
                  </td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <div class="breaker"></div>
        
            
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
