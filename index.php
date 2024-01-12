<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Font Awesome CSS only -->
  <script src="https://kit.fontawesome.com/31bf9b2eee.js" crossorigin="anonymous"></script>

  <!-- Custom Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
  <!-- Custom Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="./css/main.css" />
  <title>Ethio &ndash; Travel</title>
</head>

<body>
  <header>
    <!-- *************************************************************************** -->
    <!-- Nav bar -->
    <nav class="navbar navbar-expand-lg navcolor navbar-dark">
      <div class="container">
        <a class="navbar-brand fs-4 ethio" href="#"><img src="./assets/bus.ico" alt="" style="width: 55px; height: 52px" />
          Ethio Travel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          
            <li class="nav-item">
              <button type="button" class="btn login-color" data-bs-toggle="modal" data-bs-target="#_login_modal">
                Login
              </button>
              <div class="modal fade" id="_login_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <form id="_login_">
                    <div class="modal-content">
                      <div class="modal-header" style="background-color:#405189;">
                        <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">
                          Login
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body mt-5">
                        <div id="errorMessage" class="alert alert-danger d-none">
                        </div>
                        <div class="form-group">
                          <input type="email" name="_user_name" required autocomplete="off" id="_user_name" class="form-control p-3" placeholder="username" />
                        </div>
                        <div class="form-group mt-5">
                          <input type="password" name="_password" required minlength="6" id="_password" class="form-control p-3" placeholder="password" />
                        </div>
                        <div class="mt-3">
                          <a href="./pages/user/reset-password.php">forgot password?</a>
                        </div>
                      </div>
                      <div class="modal-footer mt-5">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                          Close
                        </button>
                        <a id="#_goto_"></a>
                        <button type="submit" class="btn login">Login</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- Modal of admin update end -->

            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <section class="container-fluid image">
      <div class="container pt-3">
        <div class="container text-center">
          <h1 class="heading fw-bold text-light">Ticket Online</h1>
          <p class="fs-5 fw-semibold paragraph my-5">
            Easily compare and book your next trip with Ethio Travel
          </p>
        </div>
        <!-- *************************************************************************** -->
        <!-- SEARCH THE WHERE YOU WANT TO GO -->
        <form action="./pages/user/reservation-page.php" method="get">
          <div class="row justify-content-center align-items-center">
            <fieldset class="form-box row g-0">
              <div class="col-sm-4 mb-sm-3 col-md-3 col-lg-3 margin-sm">
                <input name="from_city" required pattern="[A-Za-z ]+" minlength="4" title="Please enter city Name." autocomplete="off" class="border-0 p-3 input-1 border-set" style="width: 100%" list="from_citys" id="from_city" placeholder="From" />
                <datalist id="from_citys">
                  <?php
                  require './model/dbcon.php';
                  $sql = "SELECT * FROM station WHERE station_city != '$station_city'";
                  $query_run_from = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($query_run_from) > 0) {
                    foreach ($query_run_from as $station_from) {
                  ?>
                      <option value="<?= $station_from['station_city'] ?>">
                    <?php
                    }
                  }
                    ?>
                </datalist>
              </div>
              <div class="col-sm-4 mb-sm-3 col-md-3 col-lg-3 margin-sm">
                <input name="to_city" pattern="[A-Za-z ]+" required minlength="4" autocomplete="off" title="Please enter city Name." class="border-0 bord p-3 border-set" style="width: 100%" list="to_citys" id="to_city" placeholder="To" />
                <datalist id="to_citys">
                  <?php
                  require './model/dbcon.php';
                  $sql = "SELECT * FROM station WHERE station_city != '$station_city'";
                  $query_run_to = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($query_run_to) > 0) {
                    foreach ($query_run_to as $station_to) {
                  ?>
                      <option value="<?= $station_to['station_city'] ?>">
                    <?php
                    }
                  }
                    ?>
                </datalist>
              </div>
              <div class="col-sm-4 mb-sm-3 col-md-3 col-lg-3 margin-sm">
                <input type="date" required class="border-0 bord p-of-date border-set" id="departure_date" name="departure_date" style="width: 100%" />
              </div>
              <div class="col-md-3 col-lg-3">

                <input type="submit" class="find-now fw-bold" style="width: 100%" id="exampleDataList2" value="Find now" />

              </div>
            </fieldset>
          </div>
        </form>
      </div>
    </section>
    <!-- *************************************************************************** -->
    <!-- TESTMONIAL SECTION -->

    <section class="testmonial">
      <div class="marketing-bar p-3" style="background-color: #405189">
        <div class="row justify-content-end testmonial-in">
          <div class="col-sm-4 d-flex align-items-center justify-content-sm-center">
            <i class="fa fa-star-o fa-2x icon-style" aria-hidden="true"></i><span class="d-flex flex-column ms-2 text-light line-height font-size"><b>The Best Deals</b>
              <span class="font-size-in">Save up to70%</span></span>
          </div>
          <div class="col-sm-4 d-flex align-items-center justify-content-sm-center">
            <i class="fa fa-globe fa-2x icon-style" aria-hidden="true"></i>
            <span class="d-flex flex-column ms-2 text-light line-height font-size"><b>The Most Choices</b>
              <span class="font-size-in">Thousand of routes in Ethiopia</span></span>
          </div>
          <div class="col-sm-4 d-flex align-items-center justify-content-sm-center">
            <i class="fa fa-check fa-2x icon-style" aria-hidden="true"></i>
            <span class="d-flex flex-column ms-2 text-light line-height font-size"><b>Easy and Transparent</b>
              <span class="font-size-in">Compare offers with 1 click</span></span>
          </div>
        </div>
    </section>
    <section class="mt-5 p-5" style="background-color: #405189">
      <div class="container"></div>
      <h2 class="text-center text-light">Our vehcles</h2>
      <p class="lead text-center text-white mb-5">
        Most Popular Buses people like for long distance Travel
      </p>
      <div class="row g-4">
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body">
              <img src="./assets/buse.jpg" class="card-img-top" alt="..." />
              <h3 class="card-title text-center my-3">Bus</h3>
              <p class="card-text">
                The Popular one Bus people like for long distance Travel
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body">
              <img src="./assets/buse.jpg" class="card-img-top" alt="..." />
              <h3 class="card-title text-center my-3">Bus</h3>
              <p class="card-text">
                The Popular one Bus people like for long distance Travel
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body">
              <img src="./assets/buse.jpg" class="card-img-top" alt="..." />
              <h3 class="card-title text-center my-3">Bus</h3>
              <p class="card-text">
                The Popular one Bus people like for long distance Travel
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card">
            <div class="card-body">
              <img src="./assets/buse.jpg" class="card-img-top" alt="..." />
              <h3 class="card-title text-center my-3">Bus</h3>
              <p class="card-text">
                The Popular one Buse people like for long distance Travel
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer class="bd-footer pt-5 mt-5 bg-light">
    <div class="container py-5">
      <div class="row">
        <div class="col-md-3 col-sm-6 mb-3 ms-md-0 ms-footer">
          <a class="align-items-center text-decoration-none" href="#">
            <h6 class="ethio-footer" style="color: #cc5827">ETHIO TRAVEL</h6>
          </a>
          <ul class="list-unstyled">
            <li class="mb-2">
              <a href="" class="text-decoration-none color-footer"><i class="fa-brands fa-facebook" style="height: 32px; width: 32px"></i>Facebook
              </a>
            </li>
            <li class="mb-2">
              <a href="" class="text-decoration-none color-footer"><i class="fa-brands fa-instagram" style="height: 32px; width: 32px"></i>Instagram
              </a>
            </li>
            <li class="mb-2">
              <a href="" class="text-decoration-none color-footer"><i class="fa-brands fa-twitter" style="height: 32px; width: 32px"></i>Twitter
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-3 col-sm-6 mb-3 ms-md-0 ms-footer">
          <h6 class="small">COMPANY</h6>
          <ul class="list-unstyled">
            <li class="mb-2">
              <a href="" class="text-decoration-none color-footer">About </a>
            </li>
            <li class="mb-2">
              <a href="" class="text-decoration-none color-footer">Careers
              </a>
            </li>
            <li class="mb-2">
              <a href="" class="text-decoration-none color-footer">Blog </a>
            </li>
            <li class="mb-2">
              <a href="" class="text-decoration-none color-footer">partener with Ethio Travel
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-3 col-sm-6 mb-3 ms-md-0 ms-footer">
          <h6 class="small">COVERAGE</h6>
          <ul class="list-unstyled">
            <li class="mb-2">
              <a href="" class="text-decoration-none color-footer">All bus amd minibus routes
              </a>
            </li>
            <li class="mb-2">
              <a href="" class="text-decoration-none color-footer">All stations
              </a>
            </li>
            <li class="mb-2">
              <a href="" class="text-decoration-none color-footer">All cities
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-3 col-sm-6 mb-3 ms-md-0 ms-footer">
          <h6 class="small">SUPPORT</h6>
          <ul class="list-unstyled">
            <li class="mb-2">
              <a href="" class="text-decoration-none color-footer">Help </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  <script src="js/script.js"></script>
  <!-- Controller -->
  <script>
    // Admin saving to model with ajax

    $(document).on("submit", "#_login_", function(e) {
      e.preventDefault();

      var formData = new FormData(this);
      formData.append("authenticate_user", true);
      $.ajax({
        type: "POST",
        url: "./model/authentication.php",
        data: formData,
        processData: false,
        contentType: false,

        success: function(response) {
          var res = jQuery.parseJSON(response);
          if (res.status == 422) {
            $("#errorMessage").removeClass("d-none");
            $("#errorMessage").text(res.message);
          } else if (res.status == 200) {
            $("#errorMessage").addClass("d-none");
            $("#_login_modal").modal("hide");
            $("#_login_")[0].reset();
            $role = res.data.user_role;
            $station = res.data.admin_station;
            $user_name = res.data.user_email;
            if ($role == "super_admin" && $station == "all") {

              window.location.href = "./pages/Admin/admin-dashboard.php?_SESSION['logedin']" + <?php echo true ?>;

            } else if ($role == "station_admin") {

              window.location.href =
                "./pages/station-admin/station-admin-dashboard.php?station_city=" +
                $station;
            } else if ($role == "traffic_p") {
              window.location.href = "./pages/user/traffic-page.php?user_email=" + $user_name;
            } else if ($role == "driver") {
              window.location.href = "./pages/user/driver-page.php?user_email=" + $user_name;
            }
          } else {
            $("#errorMessage").removeClass("d-none");
            $("#errorMessage").text(res.message);
          }
        },
      });
    });
  </script>
</body>

</html>