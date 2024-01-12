<?php
session_start();

require '../../model/dbcon.php';
$from_city = $_GET['from_city'];
$to_city = $_GET['to_city'];
$departure_date = $_GET['departure_date'];


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
    <link rel="icon" href="../../assets/1036165.ico" />
    <link rel="stylesheet" href="../../css/reservation.css" />
</head>

<body>
    <header>
        <!-- *************************************************************************** -->
        <!-- Nav bar -->
        <nav class="navbar navbar-expand-lg navcolor fixed-top  navbar-dark">
            <div class="container">
                <a class="navbar-brand fs-4 ethio" href="#"><img src="../../assets/bus.ico" alt="" style="width: 55px; height: 52px" />
                    Ethio Travel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link fw-bolder colorNav" href="../../index.php">Home</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- ===============================Main container of Seat====================================== -->
    <main class="pt-3 main-container seat-main-container" style="margin-top:75px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 fw-bold fs-3 mb-3">Buses From <?php echo $from_city ?> to <?php echo $to_city ?> by <?php echo $departure_date ?></div>
            </div>

            <div class="row text-center">
                <!-- Cards -->

                <div class="col-md-6 col-sm-6 mb-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Booked-Seat</h5>
                            <img src="../../assets/vehicles.ico" alt="" />
                            <h5 class="fw-bold">122</h5>
                        </div>
                    </div>
                </div>
                <!-- Cards end -->
                <!-- Cards -->
                <div class="col-md-6 col-sm-6 m-xs-5 mb-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Available-Seat</h5>
                            <img src="../../assets/station.ico" alt="" />
                            <h5 class="fw-bold">12</h5>
                        </div>
                    </div>
                </div>
                <!-- Card end -->
            </div>

            <!-- table start -->
            <div class="row ms-2">
                <div class="col-md-12 mb-3">
                    <div class="border-1">
                        <div class="table-header">
                            <span><i class="bi bi-table me-2"></i></span> Available Vehicles
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped data-table vehicles-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Vehicles</th>
                                            <th>Licence Plate</th>
                                            <th>Driver Name</th>
                                            <th>Available Seat</th>

                                            <th>Departure Time</th>
                                            <th>Transport Cost</th>
                                            <th>Reserve</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $query = "SELECT * FROM schedule WHERE from_city = '$from_city' AND to_city='$to_city' AND departure_date ='$departure_date'";
                                        $query_run = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $schedule) {
                                        ?>
                                                <tr>
                                                    <td> <?= $schedule['vehicles_model'] ?></td>
                                                    <td> <?= $schedule['vehicles_licence_plate'] ?></td>
                                                    <td> <?= $schedule['driver_name'] ?></td>
                                                    <td> <?= $schedule['available_seat'] ?></td>

                                                    <td> <?= $schedule['departure_time'] ?></td>
                                                    <td> <?= $schedule['transport_cost'] ?></td>
                                                    <td>

                                                        <!-- Modal used to register admin -->
                                                        <a href="./registration-page.php? vehicles_licence_plate=<?php echo $schedule['vehicles_licence_plate'] ?>&driver_name=<?php echo $schedule['driver_name'] ?>&transport_cost=<?php echo $schedule['transport_cost'] ?>&from_city=<?php echo $from_city ?>&to_city=<?php echo $to_city ?>"><button type="button" class="btn btn-reserve ms-3 bg-primary text-light rounded-4 border-0">
                                                                Reserve
                                                            </button></a>


                                                    </td>

                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Vehicles</th>
                                            <th>Licence Plate</th>
                                            <th>Driver Name</th>
                                            <th>Available Seat</th>
                                            <th>Departure Time</th>
                                            <th>Transport Cost</th>
                                            <th>Reserve</th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table end -->
            <!-- ==================Modal================== -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Reserve</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <!-- admin Name -->
                                <div class="mb-3">
                                    <label for="admin-name" class="col-form-label">Vehicle Model:</label>
                                    <input type="text" class="form-control" id="admin-name" />
                                </div>
                                <!-- admin station -->
                                <div class="mb-3">
                                    <label for="admin-station" class="col-form-label">Station:</label>
                                    <input type="text" class="form-control" id="admin-station" />
                                </div>

                                <!-- admin email -->
                                <div class="mb-3">
                                    <label for="admin-email" class="col-form-label">Admin Email:</label>
                                    <input type="email" class="form-control" id="admin-email" />
                                </div>
                                <!-- admin phone Number -->
                                <div class="mb-3">
                                    <label for="admin-email" class="col-form-label">Admin Phone Number:</label>
                                    <input type="tel" class="form-control" id="admin-phone" />
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" class="btn btn-save">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal of admin registration end -->
        </div>
    </main>

    <!-- ===================================Main container of Seat End=================================================== -->

    <!-- Custom Bootstrap-5 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../../js/stationAdmin.js" type="module"></script>
    <script src="../../controller/reservationController.js"></script>
</body>

</html>