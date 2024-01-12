<?php
session_start();

if ($_SESSION["logedin"] != 1) {
  header("location:../../index.php");
}
require '../../model/dbcon.php';
$user_email = $_GET['user_email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/31bf9b2eee.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../../css/seat-reservation.css" />
  <link rel="stylesheet" href="../../css/main.css" />
  <link rel="stylesheet" href="../../css/driver.css" />
  <!-- Custom Alertfy -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <title>Ethio Travel</title>
</head>

<body id="myTable">
  <!--***************************************** HEADER *********************************************-->

  <header>
    <!--***************************************** NAV BAR *********************************************-->
    <nav class="navbar navbar-expand-lg fixed-top navcolor navbar-dark">
      <div class="container">
        <a class="navbar-brand fs-4 ethio" href="../../index.php"><img src="../../assets/bus.ico" alt="" style="width: 55px; height: 52px">
          Ethio Travel</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <div class="d-flex">
              <li class="nav-item">
                <a class="nav-link fw-bolder colorNav" href="#">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-bolder colorNav" href="../../index.php">Home</a>
              </li>

              <li class="nav-item nav-item-img">
                <img src="../../assets/member-2.ico" class="profile" onclick="toggleMenu()">
              </li>
            </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="sub-menu-wrap" id="subMenu">
      <div class="sub-menu">
        <div class="user-info">
          <img src="../../assets/member-2.ico" alt="" class="profile">
          <?php
          $sql = "SELECT * FROM user WHERE user_email='$user_email'";
          $query_run_tou = mysqli_query($conn, $sql);
          $user = mysqli_fetch_array($query_run_tou);
          ?>
          <h6><?php echo $user['user_first_name']; ?> <?php echo $user['user_middle_name']; ?> </h6>
        </div>
        <hr>
        <a href="#collapseExample" class="sub-menu-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">
          <!-- <i class="bi bi-person-fill icons"></i> -->
          <img src="../../assets/profile.png" alt="">
          <p>Edit Profile</p>

        </a>
        <div class="collapse" id="collapseExample">
          <button type="button" value="<?php echo $user_email ?>" class="sub-sub-menu-link edit_profile border-0 bg-none edit-btn">
            <!-- <i class=" bi bi-person-fill icons"></i> -->
            <img src="../../assets/logout.png" alt="">
            <p>change username</p>

          </button>
          <a href="" class="sub-sub-menu-link" data-bs-toggle="modal" data-bs-target="#password_modal">
            <!-- <i class=" bi bi-person-fill icons"></i> -->
            <img src="../../assets/logout.png" alt="">
            <p>change password</p>

          </a>
        </div>
        <a href="../../model/logout.php" class="sub-menu-link">
          <!-- <i class="bi bi-person-fill icons"></i> -->
          <img src="../../assets/logout.png" alt="">
          <p>Logout</p>

        </a>
        <!-- Change name -->
        <div class="modal fade" id="_login_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form id="manage_profile">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#405189;">
                  <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">
                    Update Your Profile
                  </h1>
                </div>
                <div class="modal-body">

                  <!-- Name Update -->
                  <div class="row">
                    <div id="error_on_pro" class="alert alert-warning d-none">
                    </div>
                    <div class="mb-3">
                      <input type="hidden" name="user_email" id="user_email" value="<?php echo $user_email ?>">
                    </div>
                    <div class="col-4">
                      <label for="admin-name" class="col-form-label"> First Name:</label>
                      <input type="text" class="form-control" pattern="[A-Za-z ]+" required name="profile_first_name" id="profile_first_name" />
                    </div>
                    <div class="col-4">
                      <label for="admin-name" class="col-form-label"> Middle Name:</label>
                      <input type="text" class="form-control" pattern="[A-Za-z ]+" required name="profile_middle_name" id="profile_middle_name" />
                    </div>
                    <div class="col-4">
                      <label for="admin-name" class="col-form-label"> Last Name:</label>
                      <input type="text" class="form-control" pattern="[A-Za-z ]+" required name="profile_last_name" id="profile_last_name" />
                    </div>
                  </div>
                  <!-- admin phone Number -->
                  <div class="mb-3">
                    <label for="password" class="col-form-label">Phone Number:</label>
                    <input type="tel" class="form-control" pattern="09[0-9]{8}" autocomplete="off" required name="profile_phone_number" id="profile_phone_number" />
                  </div>
                  <div class="mb-3">
                    <label for="admin-email" class="col-form-label">Enter Your Password</label>
                    <input type="password" class="form-control" name="password" id="password" />
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- Modal name end -->


        <!-- Change name -->
        <div class="modal fade" id="password_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form id="change_pass">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#405189;">
                  <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">
                    Change Your Password
                  </h1>
                </div>
                <div class="modal-body">
                  <div id="error_on_pass" class="alert alert-warning d-none">
                  </div>
                  <div class="mb-3">
                    <input type="hidden" name="user_email" id="user_email" value="<?php echo $user_email ?>">
                  </div>
                  <div class="mb-3">
                    <label for="password" class="col-form-label">Current Password:</label>
                    <input type="password" class="form-control" name="c_password" id="c_password" />
                  </div>
                  <div class="mb-3">
                    <label for="password" class="col-form-label">New Password</label>
                    <input type="password" class="form-control" name="n_password" id="n_password" />
                  </div>
                  <div class="mb-3">
                    <label for="password" class="col-form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="co_password" id="co_password" />
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- Modal name end -->


      </div>
    </div>
  </header>


  <div class="pt-4 container-driver row ms-1">

    <div class="col-md-6 ">
      <div class="mb-4">
        <button class="p-clicked d-none">100</button>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="myTable" class="table table-striped data-table vehicles-table" style="width: 100%">
            <thead>
              <tr>

                <th>Licence Plate</th>
                <th>Departure Time</th>
                <th>From</th>
                <th>To</th>
                <th>Transport Cost</th>

              </tr>
            </thead>
            <tbody>
              <?php
              require '../../model/dbcon.php';
              $query = "SELECT * FROM schedule";
              $query_run = mysqli_query($conn, $query);
              if (mysqli_num_rows($query_run) > 0) {
                foreach ($query_run as $schedule) {
              ?>
                  <tr>

                    <td> <?= $schedule['vehicles_licence_plate'] ?></td>
                    <td> <?= $schedule['departure_time'] ?></td>
                    <td> <?= $schedule['from_city'] ?></td>
                    <td> <?= $schedule['to_city'] ?></td>
                    <td> <?= $schedule['transport_cost'] ?></td>


                  </tr>
              <?php
                }
              }
              ?>
            </tbody>
            <tfoot>
              <tr>

                <th>Licence Plate</th>
                <th>Departure Time</th>
                <th>From</th>
                <th>To</th>
                <th>Transport Cost</th>

              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6 row mb-5">
      <h4><span class="heading" style="margin-left: 225px;"> Seat Status</span></h4>
      <!-- 60 seats -->
      <div class="row ms-3">
        <div class="col-6">
          <div class="mb-4">
            <button type="button" class="btn btn-success"></button>
            <p>Not Booked</p>
          </div>
          <div class="mb-4">
            <button type="button" class="btn btn-danger"></button>
            <p>Already Booked</p>
          </div>
        </div>
        <div class="col-6">
          <form id="request">
            <div>
              <button type="button" class="btn btn-primary">Request For Exit Ticket</button>
            </div>
          </form>
        </div>
      </div>
      <?php
      require '../../model/dbcon.php';


      $query = "SELECT * FROM vehicles WHERE driver_email = '$user_email'";
      $query_run = mysqli_query($conn, $query);
      $driver = mysqli_fetch_array($query_run);
      $vehicles_licence_plate = $driver['vehicles_licence_plate'];
      $check_seat_query = "SELECT * FROM seat WHERE vehicles_licence_plate = '$vehicles_licence_plate'";
      $result = mysqli_query($conn, $check_seat_query);
      $selected_seats = array();

      while ($row = mysqli_fetch_assoc($result)) {
        array_push($selected_seats, $row["selected_seat"]);
      }


      ?>
      <div class="col-md-12 div-btn">
        <button class="seat">1</button>
        <button class="seat">2</button>
        <button class="seat seat-mergin">3</button>
        <button class="seat">4</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">5</button>
        <button class="seat">6</button>
        <button class="seat seat-mergin">7</button>
        <button class="seat">8</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">9</button>
        <button class="seat">10</button>
        <button class="seat seat-mergin">11</button>
        <button class="seat">12</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">13</button>
        <button class="seat">14</button>
        <button class="seat seat-mergin">15</button>
        <button class="seat">16</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">17</button>
        <button class="seat">18</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">19</button>
        <button class="seat">20</button>
        <button class="seat seat-mergin">21</button>
        <button class="seat">22</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">23</button>
        <button class="seat">24</button>
        <button class="seat seat-mergin">25</button>
        <button class="seat">26</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">27</button>
        <button class="seat">28</button>
        <button class="seat seat-mergin">29</button>
        <button class="seat">30</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">31</button>
        <button class="seat">32</button>
        <button class="seat">33</button>
        <button class="seat">34</button>
        <button class="seat">35</button>
      </div>
    </div>


  </div>
  <script>
    let selectedSeats = <?php echo json_encode($selected_seats); ?>;
    let seat = document.querySelectorAll(".seat");
    let p_clicked = document.querySelector(".p-clicked");

    for (let i = 0; i < seat.length; i++) {
      if (selectedSeats.includes(seat[i].textContent)) {
        seat[i].style.backgroundColor = "#ff0000";
        seat[i].disabled = true;
      }
    }
  </script>

  <!--***************************************** FOOTER *********************************************-->
  <?php include('../common/footer.php'); ?>
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  <!-- Alertify JS -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <!-- Javascript Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS file -->
  <script src="../../js/driver.js"></script>
  <!-- PHP Controller file require -->
  <?php
  require '../../controller/driver-page-controller.php';
  ?>

</body>

</html>