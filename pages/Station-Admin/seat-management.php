    <?php

    session_start();
    if (!$_SESSION["logedin"]) {
        header('Location:../../index.php');
    }
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
        include('../common/branch-offcanvas-nav-bar.php')
        ?>
        <!-- ===============================Main container of Seat====================================== -->
        <main class="pt-3 main-container seat-main-container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 fw-bold fs-3">Seat</div>
                </div>

          

                <!-- table start -->
                <div class="row ms-2">
                    <div class="col-md-12 mb-3">
                        <div class="border-1">
                            <div class="table-header">
                                <span><i class="bi bi-table me-2"></i></span> Regural Schedule
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped data-table vehicles-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Vehicles</th>
                                                <th>Available Seat</th>
                                                <th>Departure Date</th>
                                                <th>Departure Time</th>
                                                <th>To</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                                 <?php
                                            require '../../model/dbcon.php';
                                            $query = "SELECT * FROM schedule WHERE from_city ='$station_city'";
                                            $query_run = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $schedule) {
                                            ?>
                                                   <tr>
                                                       <td> <?= $schedule['vehicles_model'] ?></td>
                                                       <td> <?= $schedule['available_seat'] ?></td>
                                                       <td> <?= $schedule['departure_date'] ?></td>
                                                       <td> <?= $schedule['departure_time'] ?></td>
                                                       <td> <?= $schedule['to_city'] ?></td>
                                                     
                                                      

                                                   </tr>
                                           <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                  <th>Vehicles</th>
                                                <th>Available Seat</th>
                                                <th>Departure Date</th>
                                                <th>Departure Time</th>
                                                <th>To</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button onclick="topFunction()" id="myBtn" title="Go to top">↑</button>
                <!-- table end -->
            </div>
        </main>

        <!-- ===================================Main container of Seat End=================================================== -->

        <!-- Custom Bootstrap-5 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="../../js/stationAdmin.js"></script>
        <script src="../../js/branch_offcanvas_nav_bar.js"></script>
    </body>

    </html>