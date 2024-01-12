  <?php
    session_start();

    if ($_SESSION["logedin"] != 1) {
        header("location:../../index.php");
    }
    ?>
  <?php
    require '../../model/dbcon.php';
    $station_city = $_GET['station_city'];
    // Prepare the SELECT statement
    $sql = "SELECT * FROM station WHERE station_city = '$station_city'";
    // Execute the query
    $result = mysqli_query($conn, $sql);
    // Fetch the result as an associative array
    $station = mysqli_fetch_assoc($result);
    $station_city = $station['station_city'];

    ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Ethio Travel</title>
      <!-- Custom Bootstrap-5 CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
      <!-- Custom googlefont Icon -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
      <!-- Custom bootstrap icon -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />
      <!-- Custom Icon -->
      <link rel="icon" href="/assets/1036165.ico" />
      <!-- Custom CSS -->
      <link rel="stylesheet" href="../../css/station-admin.css" />
  </head>

  <body>

      <!-- Offcanvas-bar container requre -->
      <?php
        include('../common/branch-offcanvas-nav-bar.php');
        ?>

      <!-- Main container of dashboard -->
      <main class="pt-3 main-container">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-12 fw-bold fs-3">Dashboard</div>
              </div>

              <div class="row text-center">
               
                <!-- Card end -->
                <div class="col-md-6 ">
                    <?php
                    $count = 0;
                    $station_query = "SELECT * FROM schedule WHERE from_city='$station_city'";
                    $station_query_run = mysqli_query($conn, $station_query);
                    if (mysqli_num_rows($station_query_run) > 0) {
                        foreach ($station_query_run as $stations) {
                            $count++;
                        }
                    }
                    ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Vehicles</h5>
                            <img src="../../assets/vehicles.ico" alt="" />
                            <h5 class="fw-bold"><?php echo $count ?></h5>
                        </div>
                    </div>
                </div>
                <!-- Cards -->
                <!-- Card end -->
                <div class="col-md-6 ">
                    <?php
                    $count = 0;
                    $station_query = "SELECT * FROM seat WHERE from_city='$station_city' ";
                    $station_query_run = mysqli_query($conn, $station_query);
                    if (mysqli_num_rows($station_query_run) > 0) {
                        foreach ($station_query_run as $stations) {
                            $count++;
                        }
                    }
                    ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Passenger</h5>
                            <img src="../../assets/passenger.ico" alt="" />
                            <h5 class="fw-bold"><?php echo $count ?></h5>
                        </div>
                    </div>
                </div>

            </div>
          </div>
          <button onclick="topFunction()" id="myBtn" title="Go to top">↑</button>
      </main>

      <!-- Main container of dashboard -->

      <!-- Custom Bootstrap-5 JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
      <script src="../../js/stationAdmin.js" type="module"></script>
      <script src="../../js/branch_offcanvas_nav_bar.js"></script>

  </body>

  </html>