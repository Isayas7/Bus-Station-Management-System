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
       <link rel="icon" href="../../assets/1036165.ico" />
       <!-- Custom CSS -->
       <link rel="stylesheet" href="../../css/station-admin.css" />
       <!-- Custom Alertfy -->
       <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
   </head>

   <body>

       <!-- Offcanvas-bar container requre -->
       <?php
        include('../common/branch-offcanvas-nav-bar.php')
        ?>
       <!-- ===============================Main container of schedule====================================== -->
       <main class="pt-3 main-container schedule-main-container">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-md-12 fw-bold fs-3">Schedule</div>
               </div>

               <!-- Modal used to register admin -->
               <button type="button" class="btn btn-register ms-3" data-bs-toggle="modal" data-bs-target="#scheduleAddModal" data-bs-whatever="@mdo">
                   Newly Arrived-Vehicles
               </button>

               <div class="modal fade" id="scheduleAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                       <form id="saveSchedule">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h1 class="modal-title fs-5" id="exampleModalLabel">
                                       Newly Arrived-Vehicles
                                   </h1>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                               </div>
                               <div class="modal-body">
                                   <!-- Vehicles Licence Plate -->
                                   <div class="mb-3">
                                       <label class="col-form-label" for="licence_plate">Vehicles Licence Plate</label>
                                       <select class="form-select" name="vehicles_licence_plate">
                                           <option selected>Licence Plate</option>
                                           <?php
                                            require '../../model/dbcon.php';
                                            $query = "SELECT * FROM vehicles";

                                            $query_run_vehicles = mysqli_query($conn, $query);

                                            if (mysqli_num_rows($query_run_vehicles) > 0) {
                                                foreach ($query_run_vehicles as $vehicles) {
                                            ?>

                                                   <option value='<?= $vehicles['vehicles_licence_plate'] ?>'><?= $vehicles['vehicles_licence_plate'] ?></option>

                                           <?php
                                                }
                                            }
                                            ?>
                                       </select>
                                   </div>
                                   <!--Departure Date -->
                                   <div class="mb-3">
                                       <label for="departure_date" class="col-form-label">Departure Date</label>
                                       <input type="date" class="form-control" name="departure_date" />
                                   </div>

                                   <!-- Departure Time -->
                                   <div class="mb-3">
                                       <label for="departure_time" class="col-form-label">Departure Time</label>
                                       <input type="time" class="form-control" name="departure_time" />
                                   </div>
                                   <!-- >Destination City -->
                                   <div class="mb-3">
                                       <label for="admin-email" class="col-form-label">To</label>
                                       <select class="form-select" name="to_city">

                                           <?php
                                            $sql = "SELECT * FROM station WHERE station_city != '$station_city'";
                                            $query_run_station = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($query_run_station) > 0) {
                                                foreach ($query_run_station as $station) {
                                            ?>
                                                   <option value="<?= $station['station_city'] ?>"><?= $station['station_city'] ?></option>
                                           <?php
                                                }
                                            }
                                            ?>
                                       </select>
                                   </div>
                                   <!-- cost -->
                                   <div class="mb-3">
                                       <label for="transport_cost" class="col-form-label">Transport Cost</label>
                                       <input type="number" class="form-control" name="transport_cost" />
                                   </div>
                               </div>
                               <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                       Cancel
                                   </button>
                                   <button type="submit" class="btn btn-save">Save</button>
                               </div>
                           </div>
                       </form>
                   </div>
               </div>
               <!-- Modal of admin registration end -->

               <!-- table start -->
               <div class="row ms-2">
                   <div class="col-md-12 mb-3">
                       <div class="border-1">
                           <div class="table-header">
                               <span><i class="bi bi-table me-2"></i></span> Regural Schedule
                           </div>
                           <div class="card-body">
                               <div class="table-responsive">
                                   <table id="myTable" class="table table-striped data-table vehicles-table" style="width: 100%">
                                       <thead>
                                           <tr>
                                               <th>Driver Name</th>
                                               <th>Licence Plate</th>
                                               <th>Vehicles</th>
                                               <th>Available Seat</th>
                                               <th>Departure Date</th>
                                               <th>Departure Time</th>
                                               <th>To</th>
                                               <th>Transport Cost</th>
                                               <th>Action</th>
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
                                                       <td> <?= $schedule['driver_name'] ?></td>
                                                       <td> <?= $schedule['vehicles_licence_plate'] ?></td>
                                                       <td> <?= $schedule['vehicles_model'] ?></td>
                                                       <td> <?= $schedule['available_seat'] ?></td>
                                                       <td> <?= $schedule['departure_date'] ?></td>
                                                       <td> <?= $schedule['departure_time'] ?></td>
                                                       <td> <?= $schedule['to_city'] ?></td>
                                                       <td> <?= $schedule['transport_cost'] ?></td>
                                                       <td>
                                                           <button type="button" value="<?= $schedule['schedule_id']; ?>" class="deleteScheduleBtn btn bg-success rounded-4 border-0"> <i class="bi bi-check"></i></button>
                                                       </td>

                                                   </tr>
                                           <?php
                                                }
                                            }
                                            ?>
                                       </tbody>
                                       <tfoot>
                                           <tr>
                                               <th>Driver Name</th>
                                               <th>Licence Plate</th>
                                               <th>Vehicles</th>
                                               <th>Available Seat</th>
                                               <th>Departure Date</th>
                                               <th>Departure Time</th>
                                               <th>To</th>
                                               <th>Transport Cost</th>
                                               <th>Action</th>
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
           <button onclick="topFunction()" id="myBtn" title="Go to top">↑</button>
       </main>

       <!-- ===================================Main container of Schedule End=================================================== -->

       <!-- Custom Bootstrap-5 JavaScript -->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
       <script src="../../js/stationAdmin.js"></script>
       <!-- JQuery -->
       <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
       <!-- Alertify JS -->
       <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
       <script src="../../js/branch_offcanvas_nav_bar.js"></script>
       <?php
        require '../../controller/schedule-management-controller.php';
        ?>
   </body>

   </html>