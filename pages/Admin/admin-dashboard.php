<?php
session_start();

if ($_SESSION["logedin"] != 1) {
    header("location:../../index.php");
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

    <!--======================== Main container of dashboard================================= -->
    <main class="pt-3 main-container dashboard-main-container">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 fw-bold fs-3">Dashboard</div>
            </div>
            <div class="row text-center">
                <!-- Cards -->
                <div class="col-md-3 col-sm-6 m-xs-5 mb-3">


                    <?php
                    $count = 0;
                    $station_query = "SELECT * FROM station";
                    $station_query_run = mysqli_query($conn, $station_query);
                    if (mysqli_num_rows($station_query_run) > 0) {
                        foreach ($station_query_run as $stations) {
                            $count++;
                        }
                    }
                    ?>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Stations</h5>
                            <img src="../../assets/station.ico" alt="" />
                            <h5 class="fw-bold"><?php echo $count ?></h5>
                        </div>
                    </div>
                </div>
                <!-- Cards -->
                <!-- Card end -->
                <div class="col-md-3 col-sm-6 mb-3">
                    <?php
                    $count = 0;
                    $station_query = "SELECT * FROM vehicles";
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
                <div class="col-md-3 col-sm-6 mb-3">
                    <?php
                    $count = 0;
                    $user_role = 'traffic_p';
                    $station_query = "SELECT * FROM user WHERE user_role='$user_role'";
                    $station_query_run = mysqli_query($conn, $station_query);
                    if (mysqli_num_rows($station_query_run) > 0) {
                        foreach ($station_query_run as $stations) {
                            $count++;
                        }
                    }
                    ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Traffic-Police</h5>
                            <img src="../../assets/traffic.ico" alt="" />
                            <h5 class="fw-bold"><?php echo $count ?></h5>
                        </div>
                    </div>
                </div>
                <!-- Cards -->
                <!-- Card end -->
                <div class="col-md-3 col-sm-6 mb-3">
                    <?php
                    $count = 0;
                    $station_query = "SELECT * FROM seat";
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
            <div class="row text-center">
                <!-- Card end -->
                <!-- Cards -->
                <div class="col-md-3 col-sm-6 mb-3">
                    <?php
                    $count = 0;
                    $user_role = 'traffic_p';
                    $station_query = "SELECT * FROM user WHERE user_role='$user_role'";
                    $station_query_run = mysqli_query($conn, $station_query);
                    if (mysqli_num_rows($station_query_run) > 0) {
                        foreach ($station_query_run as $stations) {
                            $count++;
                        }
                    }
                    ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Routes</h5>
                            <img src="../../assets/routes.ico" alt="" />
                            <h5 class="fw-bold"><?php echo $count ?></h5>
                        </div>
                    </div>
                </div>
                <!-- Card end -->
                <!-- Cards -->
                <div class="col-md-3 col-sm-6 mb-3">
                    <?php
                    $count = 0;
                    $stat = 'Deactive';
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
                            <img src="../../assets/vehicles.ico" alt="" />
                            <h5 class="fw-bold"><?php echo $count ?></h5>
                        </div>
                    </div>
                </div>
                <!-- Card end -->
                <!-- Cards -->
                <div class="col-md-3 col-sm-6 mb-3">
                    <?php
                    $count = 0;
                    $station_query = "SELECT * FROM schedule";
                    $station_query_run = mysqli_query($conn, $station_query);
                    if (mysqli_num_rows($station_query_run) > 0) {
                        foreach ($station_query_run as $stations) {
                            $count++;
                        }
                    }
                    ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Daily-Travel</h5>
                            <img src="../../assets/daily.ico" alt="" />
                            <h5 class="fw-bold"><?php echo $count ?></h5>
                        </div>
                    </div>
                </div>
                <!-- Card end -->
                <!-- Cards -->
                <div class="col-md-3 col-sm-6 mb-3">
                    <?php
                    $count = 0;
                    $stat = 'not_seen';
                    $station_query = "SELECT * FROM report WHERE a_status='$stat'";
                    $station_query_run = mysqli_query($conn, $station_query);
                    if (mysqli_num_rows($station_query_run) > 0) {
                        foreach ($station_query_run as $stations) {
                            $count++;
                        }
                    }
                    ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Alert</h5>
                            <img src="../../assets/alert.ico" alt="" />
                            <h5 class="fw-bold"><?php echo $count ?></h5>
                        </div>
                    </div>
                </div>
                <!-- Card end -->
            </div>
        </div>


        <!-- Modal used to register admin -->
        <button type="button" class="btn btn-register ms-3" data-bs-toggle="modal" data-bs-target="#adminAddModal" data-bs-whatever="@mdo">
            Add Admin
        </button>

        <div class="modal fade" id="adminAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="saveAdmin">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                Admin Registration
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <!-- Name Registration -->
                            <div class="row">
                                <div id="errorMessage" class="alert alert-warning d-none">
                                </div>
                                <div class="col-4">
                                    <label for="admin-name" class="col-form-label"> First Name:</label>
                                    <input type="text" required pattern="[A-Za-z]" autocomplete="off" class="form-control" name="user_first_name" />
                                </div>
                                <div class="col-4">
                                    <label for="admin-name" class="col-form-label"> Middle Name:</label>
                                    <input type="text" required pattern="[A-Za-z ]" autocomplete="off" class="form-control" name="user_middle_name" />
                                </div>
                                <div class="col-4">
                                    <label for="admin-name" class="col-form-label"> Last Name:</label>
                                    <input type="text" required pattern="[A-Za-z ]" autocomplete="off" class="form-control" name="user_last_name" />
                                </div>

                                <!-- admin email -->
                                <div class="mb-3">
                                    <label for="admin-email" class="col-form-label">Admin Email:</label>
                                    <input type="email" required autocomplete="off" class="form-control" name="user_email" />
                                </div>
                            </div>
                            <!-- admin station -->
                            <?php


                            ?>
                            <div class="mb-3">
                                <label for="admin-station" class="col-form-label">Station:</label>
                                <select class="form-select" name="admin_station" id="admin_station">
                                    <?php
                                    $sql = "SELECT * FROM station";
                                    $query_run_tou = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($query_run_tou) > 0) {
                                        foreach ($query_run_tou as $stationtou) {
                                    ?>
                                            <option value="<?= $stationtou['station_city'] ?>"><?= $stationtou['station_city'] ?></option>

                                    <?php
                                        }
                                    }
                                    ?>
                                    <option value="all">All</option>
                                </select>
                            </div>


                            <!-- admin phone Number -->
                            <div class="mb-3">
                                <label for="admin-email" class="col-form-label">Admin Phone Number:</label>
                                <input type="tel" required pattern="09[0-9]{8}" class="form-control" name="user_phone_number" />
                            </div>
                            <!-- Status -->
                            <div class="mb-3">
                                <label for="admin-status" class="col-form-label">Admin Status:</label>
                                <select class="form-select" name="user_status">
                                    <option value="Activated">Activate</option>
                                    <option value="Deactivated">Deactivate</option>
                                </select>
                            </div>
                            <!-- role -->
                            <div class="mb-3">
                                <label for="admin-email" class="col-form-label">Role</label>
                                <select class="form-select" name="user_role">
                                    <option value="station_admin">Station Admin</option>
                                    <option value="super_admin">System Admin</option>
                                </select>
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
        <!-- Modal of admin registration end -->


        <!-- Modal used to update admin -->

        <div class="modal fade" id="adminEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="updateAdmin">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                Admin Updating
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
                                    <label for="admin-name" class="col-form-label"> First Name:</label>
                                    <input type="text" required pattern="[A-Za-z ]+" autocomplete="off" class="form-control" name="user_first_name" id="user_first_name" />
                                </div>
                                <div class="col-4">
                                    <label for="admin-name" class="col-form-label"> Middle Name:</label>
                                    <input type="text" required pattern="[A-Za-z ]+" autocomplete="off" class="form-control" name="user_middle_name" id="user_middle_name" />
                                </div>
                                <div class="col-4">
                                    <label for="admin-name" class="col-form-label"> Last Name:</label>
                                    <input type="text" required pattern="[A-Za-z ]+" autocomplete="off" class="form-control" name="user_last_name" id="user_last_name" />
                                </div>

                                <!-- admin email -->
                                <div class="mb-3">
                                    <label for="admin-email" class="col-form-label">Admin Email:</label>
                                    <input type="email" required class="form-control" name="user_email" id="user_email" />
                                </div>
                            </div>
                            <!-- admin station -->
                            <div class="mb-3">
                                <label for="admin-station" class="col-form-label">Station:</label>
                                <select class="form-select" name="admin_station" id="admin_station">
                                    <?php
                                    $sql = "SELECT * FROM station";
                                    $query_run_tou = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($query_run_tou) > 0) {
                                        foreach ($query_run_tou as $stationtou) {
                                    ?>
                                            <option value="<?= $stationtou['station_city'] ?>"><?= $stationtou['station_city'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>


                            <!-- admin phone Number -->
                            <div class="mb-3">
                                <label for="admin-email" class="col-form-label">Admin Phone Number:</label>
                                <input type="tel" required pattern="09[0-9]{8}" class="form-control" name="user_phone_number" id="user_phone_number" />
                            </div>
                            <!-- Status -->
                            <div class="mb-3">
                                <label for="admin-status" class="col-form-label">Admin Status:</label>
                                <select class="form-select" name="user_status" id="user_status">
                                    <option value="Activated">Activate</option>
                                    <option value="Deactivated">Deactivate</option>
                                </select>
                            </div>
                            <!-- role -->
                            <div class="mb-3">
                                <label for="admin-email" class="col-form-label">To</label>
                                <select class="form-select" name="user_role" id="user_role">
                                    <option value="station_admin">Station Admin</option>
                                    <option value="super_admin">System Admin</option>
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
        <!-- Modal of admin update end -->

        <!-- table start -->
        <div class="row ms-2">
            <div class="col-md-12 mb-3">
                <div class="border-1">
                    <div class="table-header">
                        <span><i class="bi bi-table me-2"></i></span> Admins Data Table
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped data-table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Station</th>
                                        <th>Phone Number</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require '../../model/dbcon.php';
                                    $query = "SELECT * FROM user WHERE user_role='station_admin'";
                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $user) {

                                    ?>
                                            <tr>

                                                <td> <?= $user['user_first_name'] ?></td>
                                                <td> <?= $user['user_middle_name'] ?></td>
                                                <td> <?= $user['user_last_name'] ?></td>
                                                <td> <?= $user['user_email'] ?></th>
                                                <td> <?= $user['admin_station'] ?></th>
                                                <td> <?= $user['user_phone_number'] ?></th>
                                                <td> <?= $user['user_status'] ?></th>
                                                <td>


                                                    <button type="button" value="<?= $user['user_id']; ?>" class="editAdminBtn btn bg-success rounded-4 border-0"> <span class="material-icons-outlined text-light p-1 rounded-4">
                                                            edit
                                                        </span></button>
                                                    <button type="button" value="<?= $user['user_id']; ?>" class="deleteAdminBtn btn bg-danger rounded-4 border-0"> <span class="material-icons-outlined text-light p-1">
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
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Station</th>
                                        <th>Phone Number</th>
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
    <!-- ===============================Main container of dashboard End ========================================-->
    <!-- Custom Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <!-- Alertify JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script src="../../js/adminScripts.js"></script>
    <script src="../../js/offcanvas_nav_bar.js"></script>
    <?php
    require '../../controller/admin-dashboard-controller.php';
    ?>
</body>

</html>