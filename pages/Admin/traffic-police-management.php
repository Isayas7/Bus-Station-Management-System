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
     <!-- Main container of dashboard -->
     <main class="pt-3 main-container">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-md-12 fw-bold fs-3">Traffic-Police</div>
             </div>
         </div>

         <!-- Modal used to register Traffic -->
         <button type="button" class="btn btn-register ms-3" data-bs-toggle="modal" data-bs-target="#trafficAddModal" data-bs-whatever="@mdo">
             Register Traffic
         </button>

         <div class="modal fade" id="trafficAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog">
                 <form id="saveTraffic">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h1 class="modal-title fs-5" id="exampleModalLabel">
                                 Traffic Registration
                             </h1>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">

                             <!-- Traffic Name -->
                             <div class="row">
                                 <div id="errorMessage" class="alert alert-warning d-none">
                                 </div>
                                 <div class="col-4">
                                     <label for="" class="col-form-label"> Traffic First Name:</label>
                                     <input type="text" pattern="[A-Za-z ]+" autocomplete="off" class="form-control" name="user_first_name" />
                                 </div>
                                 <div class="col-4">
                                     <label for="" class="col-form-label">Traffic Middle Name:</label>
                                     <input type="text" pattern="[A-Za-z ]+" autocomplete="off" class="form-control" name="user_middle_name" />
                                 </div>
                                 <div class="col-4">
                                     <label for="" class="col-form-label">Traffic Last Name:</label>
                                     <input type="text" pattern="[A-Za-z ]+" autocomplete="off" class="form-control" name="user_last_name" />
                                 </div>
                             </div>
                             <!-- traffic email -->
                             <div class="mb-3">
                                 <label for="" class="col-form-label">Traffic Email:</label>
                                 <input type="email" autocomplete="off" class="form-control" name="user_email" />
                             </div>

                             <!-- traffic Phone -->
                             <div class="mb-3">
                                 <label for="" class="col-form-label">Traffic Phone:</label>
                                 <input type="tel" class="form-control" name="user_phone_number" />
                             </div>

                             <!-- traffic Model -->
                             <div class="mb-3">
                                 <label for="admin-email" class="col-form-label">Route:</label>
                                 <input type="text" class="form-control" name="admin_station" />
                             </div>
                             <!-- Status -->
                             <div class="mb-3">
                                 <label for="admin-status" class="col-form-label">Traffic Status:</label>
                                 <select class="form-select" name="user_status">
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
         <!-- Modal of Traffic registration end -->



         <!-- Modal used to update traffic -->

         <div class="modal fade" id="trafficEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog">
                 <form id="updateTraffic">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h1 class="modal-title fs-5" id="exampleModalLabel">
                                 traffic Updating
                             </h1>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">

                             <!-- Name Update -->
                             <div class="row">
                                 <div id="errorMessageUpdate" class="alert alert-warning d-none">
                                 </div>
                                 <div class="mb-3">
                                     <input type="hidden" name="user_id" id="user_id">
                                 </div>
                                 <div class="col-4">
                                     <label for="traffic-name" class="col-form-label"> Traffic First Name:</label>
                                     <input type="text" pattern="[A-Za-z ]+" autocomplete="off" class="form-control" name="user_first_name" id="user_first_name" />
                                 </div>
                                 <div class="col-4">
                                     <label for="traffic-name" class="col-form-label"> Traffic Middle Name:</label>
                                     <input type="text" pattern="[A-Za-z ]+" autocomplete="off" class="form-control" name="user_middle_name" id="user_middle_name" />
                                 </div>
                                 <div class="col-4">
                                     <label for="traffic-name" class="col-form-label"> Traffic Last Name:</label>
                                     <input type="text" pattern="[A-Za-z ]+" autocomplete="off" class="form-control" name="user_last_name" id="user_last_name" />
                                 </div>
                             </div>
                             <!-- traffic email -->
                             <div class="mb-3">
                                 <label for="dirver-email" class="col-form-label">Traffic Email:</label>
                                 <input type="email" class="form-control" name="user_email" id="user_email" />
                             </div>
                             <!-- traffic phone -->
                             <div class="mb-3">
                                 <label for="" class="col-form-label">Traffic Phone Number:</label>
                                 <input type="tel" class="form-control" name="user_phone_number" id="user_phone_number" />
                             </div>
                             <div class="mb-3">
                                 <label for="" class="col-form-label">Route:</label>
                                 <input type="tel" class="form-control" name="admin_station" id="admin_station" />
                             </div>
                             <!-- Status -->
                             <div class="mb-3">
                                 <label for="admin-status" class="col-form-label">Traffic Status:</label>
                                 <select class="form-select" name="user_status" id="user_status">
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
         <!-- Modal of traffic update end -->



         <!-- table start -->
         <div class="row ms-2">
             <div class="col-md-12 mb-3">
                 <div class="border-1">
                     <div class="table-header">
                         <span><i class="bi bi-table me-2"></i></span>Traffic-Police Data Table
                     </div>
                     <div class="card-body">
                         <div class="table-responsive">
                             <table id="myTable" class="table table-striped data-table traffic-table" style="width: 100%">
                                 <thead>
                                     <tr>
                                         <th>Traffic-P First Name</th>
                                         <th>Traffic-P Last Name</th>
                                         <th>Traffic-Police Email</th>
                                         <th>Phone Number</th>
                                         <th>Route</th>
                                         <th>Status</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                        require '../../model/dbcon.php';
                                        $role = 'traffic_p';
                                        $query = "SELECT * FROM user WHERE user_role='$role'";
                                        $query_run = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $user) {
                                        ?>
                                             <tr>
                                                 <td><?= $user['user_first_name'] ?></td>
                                                 <td><?= $user['user_middle_name'] ?></td>
                                                 <td><?= $user['user_email'] ?></td>
                                                 <td><?= $user['user_phone_number'] ?></td>
                                                 <td><?= $user['admin_station'] ?></td>
                                                 <td><?= $user['user_status'] ?></td>
                                                 <td>
                                                     <button type="button" value="<?= $user['user_id']; ?>" class="editTrafficBtn btn bg-success rounded-4 border-0"> <span class="material-icons-outlined text-light p-1 rounded-4">
                                                             edit
                                                         </span></button>
                                                     <button type="button" value="<?= $user['user_id']; ?>" class="deleteTrafficBtn btn bg-danger rounded-4 border-0"> <span class="material-icons-outlined text-light p-1">
                                                             delete
                                                         </span></button>
                                                 </td>
                                             </tr> <?php
                                                }
                                            }
                                                    ?>
                                 </tbody>
                                 <tfoot>
                                     <tr>
                                         <th>Traffic-P First Name</th>
                                         <th>Traffic-P Last Name</th>
                                         <th>Traffic-Police Email</th>
                                         <th>Phone Number</th>
                                         <th>Route</th>
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

     <!-- Main container of dashboard -->

     <!-- Custom Bootstrap JavaScript -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
     <!-- JQuery -->
     <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
     <!-- Alertify JS -->
     <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
     <script src="../../js/adminScripts.js"></script>
     <script src="../../js/offcanvas_nav_bar.js"></script>
     <?php
        require '../../controller/traffic-police-management-controller.php';
        ?>
 </body>

 </html>