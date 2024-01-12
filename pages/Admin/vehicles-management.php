 <?php
    session_start();
    if (!$_SESSION["logedin"]) {
        header('Location:../../index.php');
    }
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
     <!-- Custom Alertfy -->
     <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
     <!-- Custom CSS -->
     <link rel="stylesheet" href="../../css/admin-styles.css" />
 </head>

 <body>
     <!-- Offcanvas-bar container requre -->
     <?php
        include('../common/offcanvas-nav-bar.php')
        ?>

     <!-- Main container of Vehicles -->
     <main class="pt-3 main-container">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-12 fw-bold fs-3">Vehicles</div>
             </div>
             <div class="row text-center">
                 <!-- Cards -->

                 <div class="col-md-6 col-sm-6 mb-3">
                              <?php
                    $count = 0;
                    $stat='Active';
                    $station_query = "SELECT * FROM vehicles WHERE status='$stat'";
                    $station_query_run = mysqli_query($conn, $station_query);
                    if (mysqli_num_rows($station_query_run) > 0) {
                        foreach ($station_query_run as $stations) {
                            $count++;
                        }
                    }
                    ?>
                     <div class="card mb-3">
                         <div class="card-body">
                             <h5 class="card-title">Active-Vehicles</h5>
                             <img src="../../assets/vehicles.ico" alt="" />
                             <h5 class="fw-bold"><?php echo $count ?></h5>
                         </div>
                     </div>
                 </div>
                 <!-- Cards end -->
                 <!-- Cards -->
                 <div class="col-md-6 col-sm-6 m-xs-5 mb-3">
                                  <?php
                    $count = 0;
                    $stat='Deactive';
                    $station_query = "SELECT * FROM vehicles WHERE status='$stat'";
                    $station_query_run = mysqli_query($conn, $station_query);
                    if (mysqli_num_rows($station_query_run) > 0) {
                        foreach ($station_query_run as $stations) {
                            $count++;
                        }
                    }
                    ?>
                     <div class="card mb-3">
                         <div class="card-body">
                             <h5 class="card-title">Deactivated-Vehicles</h5>
                             <img src="../../assets/station.ico" alt="" />
                             <h5 class="fw-bold"><?php echo $count ?></h5>
                         </div>
                     </div>
                 </div>
                 <!-- Card end -->
             </div>
         </div>

         <!-- Modal used to register Vehicle -->
         <button type="button" class="btn btn-register ms-3" data-bs-toggle="modal" data-bs-target="#vehiclesAddModal" data-bs-whatever="@mdo">
             Register Vehicles
         </button>

         <div class="modal fade" id="vehiclesAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog mt-0">
                 <form id="saveVehicles">
                     <div class="modal-content">
                         <div class="modal-header ">
                             <h1 class="modal-title fs-5" id="exampleModalLabel">
                                 Vehicles Registration
                             </h1>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">

                             <!-- Driver Name -->
                             <div class="row">
                                 <div id="errorMessage" class="alert alert-warning d-none">
                                 </div>
                                 <div class="col-4">
                                     <label for="" class="col-form-label"> First Name:</label>
                                     <input type="text" required pattern="[A-Za-z ]+" autocomplete="off" class="form-control" name="user_first_name" />
                                 </div>
                                 <div class="col-4">
                                     <label for="" class="col-form-label"> Middle Name:</label>
                                     <input type="text" required pattern="[A-Za-z ]+" autocomplete="off" class="form-control" name="user_middle_name" />
                                 </div>
                                 <div class="col-4">
                                     <label for="" class="col-form-label"> Last Name:</label>
                                     <input type="text" required  pattern="[A-Za-z ]+" autocomplete="off" class="form-control" name="user_last_name" />
                                 </div>
                             </div>
                             <!-- Driver email -->
                             <div class="mb-3">
                                 <label for="" class="col-form-label">Driver Email:</label>
                                 <input type="email" required autocomplete="off" class="form-control" name="user_email" />
                             </div>

                             <!-- Driver Phone -->
                             <div class="mb-3">
                                 <label for="" class="col-form-label">Driver Phone:</label>
                                 <input type="tel" pattern="09[0-9]{8}" required class="form-control" name="user_phone_number" />
                             </div>

                             <!-- Vehicles Model -->
                             <div class="mb-3">
                                 <label for="admin-email" class="col-form-label">Vehicles Model:</label>
                                 <input type="text" class="form-control" name="vehicles_model" />
                             </div>
                             <!-- Vehicles Licence Plate -->
                             <div class="mb-3">
                                 <label for="admin-email" class="col-form-label">Vehicles Licence-Plate:</label>
                                 <input type="text" class="form-control" name="vehicles_licence_plate" />
                             </div>
                             <!-- Status -->
                             <div class="mb-3">
                                 <label for="admin-status" class="col-form-label">Admin Status:</label>
                                 <select class="form-select" name="vehicles_status" id="vehicles_status">
                                     <option value="Active">Active</option>
                                     <option value="Deactive">Deactive</option>
                                 </select>
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
         <!-- Modal of Vehicles registration end -->


         <!-- Modal used to update vehicles -->

         <div class="modal fade " id="vehiclesEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog mt-0">
                 <form id="updateVehicles">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h1 class="modal-title fs-5" id="exampleModalLabel">
                                 Vehicles Updating
                             </h1>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">

                             <!-- Name Update -->
                             <div class="row">
                                 <div id="errorMessageUpdate" class="alert alert-warning d-none">
                                 </div>
                                 <div class="mb-3">
                                     <input type="hidden" name="vehicles_id" id="vehicles_id">
                                 </div>
                                 <div class="col-4">
                                     <label for="driver-name" class="col-form-label"> First Name:</label>
                                     <input type="text" required pattern="[A-Za-z ]+" autocomplete="off" class="form-control" name="driver_first_name" id="driver_first_name" />
                                 </div>
                                 <div class="col-4">
                                     <label for="driver-name" class="col-form-label"> middle Name:</label>
                                     <input type="text" required pattern="[A-Za-z ]+" autocomplete="off" class="form-control" name="driver_middle_name" id="driver_middle_name" />
                                 </div>
                                 <div class="col-4">
                                     <label for="driver-name" class="col-form-label"> Last Name:</label>
                                     <input type="text" required pattern="[A-Za-z ]+" autocomplete="off" class="form-control" name="driver_last_name" id="driver_last_name" />
                                 </div>
                             </div>
                             <!-- driver email -->
                             <div class="mb-3">
                                 <label for="dirver-email" class="col-form-label">Driver Email:</label>
                                 <input type="email" required class="form-control" name="driver_email" id="driver_email" />
                             </div>
                             <!-- driver phone -->
                             <div class="mb-3">
                                 <label for="" class="col-form-label">Driver Phone Number:</label>
                                 <input type="tel" pattern="09[0-9]{8}"  required class="form-control" name="driver_phone" id="driver_phone" />
                             </div>
                             <div class="mb-3">
                                 <label for="" class="col-form-label">Vehicle Model:</label>
                                 <input type="tel" class="form-control" name="vehicles_model" id="vehicles_model" />
                             </div>

                             <!-- licence-palate -->
                             <div class="mb-3">
                                 <label for="vehicles_licence_plate" class="col-form-label">Vehicle Licence-Plate</label>
                                 <input type="text" required class="form-control" name="vehicles_licence_plate" id="vehicles_licence_plate" />
                             </div>
                             <div class="mb-3">
                                 <label for="admin-status" class="col-form-label">Vehicle Status:</label>
                                 <select class="form-select" name="vehicles_status" id="vehicles_status">
                                     <option value="Active">Active</option>
                                     <option value="Deactive">Deactive</option>
                                 </select>
                             </div>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-primary">Update
                             </button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
         <!-- Modal of Vehicles update end -->


         <!-- table start -->
         <div class="row ms-2">
             <div class="col-md-12 mb-3">
                 <div class="border-1">
                     <div class="table-header">
                         <span><i class="bi bi-table me-2"></i></span> Admins Data Table
                     </div>
                     <div class="card-body">
                         <div class="table-responsive">
                             <table id="myTable" class="table table-striped data-table vehicles-table" style="width: 100%">
                                 <thead>
                                     <tr>
                                         <th>Driver First Name</th>
                                         <th>Driver Last Name</th>
                                         <th>Driver Email</th>
                                         <th>Phone Number</th>
                                         <th>Vehicle Model</th>
                                         <th>Licence plate</th>
                                         <th>Status </th>

                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                        require '../../model/dbcon.php';
                                        $query = "SELECT * FROM vehicles";
                                        $query_run = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $vehicles) {
                                        ?>
                                             <tr>
                                                 <td><?= $vehicles['driver_first_name'] ?></td>
                                                 <td><?= $vehicles['driver_middle_name'] ?></td>
                                                 <td><?= $vehicles['driver_email'] ?></td>
                                                 <td><?= $vehicles['driver_phone'] ?></td>
                                                 <td><?= $vehicles['vehicles_model'] ?></td>
                                                 <td><?= $vehicles['vehicles_licence_plate'] ?></td>
                                                 <td><?= $vehicles['status'] ?></td>
                                                 <td>
                                                     <button type="button" value="<?= $vehicles['vehicles_id']; ?>" class="editVehiclesBtn btn bg-success rounded-4 border-0"> <span class="material-icons-outlined text-light p-1 rounded-4">
                                                             edit
                                                         </span></button>
                                                     <button type="button" value="<?= $vehicles['vehicles_id']; ?>" class="deleteVehiclesBtn btn bg-danger rounded-4 border-0"> <span class="material-icons-outlined text-light p-1">
                                                             delete
                                                         </span></button>
                                                 </td>
                                             </tr>
                                     <?php
                                            }
                                        }
                                        ?>
                                 </tbody>
                                 <tfoot>
                                     <tr>
                                         <th>Driver First Name</th>
                                         <th>Driver Last Name</th>
                                         <th>Driver Email</th>
                                         <th>Phone Number</th>
                                         <th>Vehicle Model</th>
                                         <th>Licence plate</th>
                                         <th>Status</th>
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
     </main>

     <!-- Main container of vehicles End -->

     <!-- Custom Bootstrap JavaScript -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
     <!-- JQuery -->
     <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
     <!-- Alertify JS -->
     <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
     <script src="../../js/adminScripts.js"></script>
     <script src="../../js/offcanvas_nav_bar.js"></script>

     <?php
        require '../../controller/vehicles-management-controller.php';
        ?>

 </body>

 </html>