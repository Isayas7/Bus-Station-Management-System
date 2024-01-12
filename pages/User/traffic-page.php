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
    <link rel="stylesheet" href="../../css/driver.css" />
    <!-- Custom Alertfy -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

    <link rel="stylesheet" href="../../css/reservation.css" />
</head>

<body>
    <header>
        <!-- *************************************************************************** -->
        <!-- Nav bar -->
        <nav class="navbar navbar-expand-lg  navcolor navbar-dark">
            <div class="container">
                <a class="navbar-brand fs-4 ethio" href="#"><img src="../../assets/bus.ico" alt="" style="width: 55px; height: 52px" />
                    Ethio Travel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- search button -->
                                <form class="d-flex ms-auto" role="search">
                                    <div class="input-group my-3 my-lg-0">
                                        <input id="search" type="text" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2" />
                                        <button class="btn btn-search" type="button" id="button-addon2">
                                            <i class="bi bi-search text-light"></i>
                                        </button>
                                    </div>
                                </form>
                                <!-- search btn end -->
                        <li class="nav-item nav-item-img ms-2 mt-1">
                            <img src="../../assets/member-2.ico" class="profile" onclick="toggleMenu()">
                        </li>
                    </ul>
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

    <main class="pt-3 main-container seat-main-container">
        <!-- ==================Modal================== -->
        <div class="modal fade" id="vehicles_detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <form id="vehicles_info">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                Schedule Detail
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" id="schedule_id">
                            <!-- admin Name -->
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="admin-name" class="col-form-label">Vehicle Model:</label><br>
                                    <label for="admin-name" id="vehicles_model" name="vehicles_model" class="col-form-label">Vehicle Model:</label>
                                </div>
                                <!-- admin station -->
                                <div class="col-6 mb-3">
                                    <label for="admin-station" class="col-form-label"> Vehicle Licence Plate:</label><br>
                                    <label for="admin-station" id="vehicles_licence_plate" name="vehicles_licence_plate" class="col-form-label"></label>
                                    <input type="hidden" id="vehicles_licence_plates" name="vehicles_licence_plates" class="col-form-label">
                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-6 mb-3">
                                    <label for="admin-station" class="col-form-label">Driver Name:</label><br>
                                    <label for="admin-station" id="driver_name" name="driver_name" class="col-form-label"></label>
                                </div>
                                <div class=" col-6 mb-3">
                                    <label for="admin-station" class="col-form-label">Driver Email:</label><br>
                                    <label for="admin-station" id="driver_email" name="driver_email" class="col-form-label"></label>
                                </div>
                            </div>
                            <!-- admin email -->
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="admin-name" class="col-form-label">Passengers Number:</label><br>
                                    <label for="admin-name" id="reserved_people" name="reserved_people" class="col-form-label"></label>
                                </div>
                                <!-- admin station -->
                                <div class=" col-6 mb-3">
                                    <label for="admin-station" class="col-form-label">Departure Time::</label><br>
                                    <label for="admin-station" id="departure_time" name="departure_time" class="col-form-label"></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="admin-name" class="col-form-label">From:</label><br>
                                    <label for="admin-name" id="from_city" name="from_city" class="col-form-label">From:</label>
                                </div>
                                <!-- admin station -->
                                <div class=" col-6 mb-3">
                                    <label for="admin-station" class="col-form-label">To:</label><br>
                                    <label for="admin-station" id="to_city" name="to_city" class="col-form-label">Station:</label>
                                </div>
                            </div>
                            <div class="row">

                                <label for="admin-email" class="col-form-label">Report Type</label>
                                <select name="report_type" id="report_type" class="form-select">
                                    <option value="take_extra">Overloading</option>
                                    <option value="pass_T">Traffic Offence</option>
                                    <option value="emergency">Accident</option>
                                </select>
                            </div>
                            <!-- admin email -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-danger">
                                Report It?
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal of admin registration end -->
        <!-- table -->
        <div class="container-fluid">
            <!-- table start -->
            <div class="row ms-2">
                <div class="col-md-12 mb-3">
                    <div class="border-1">
                        <div class="table-header">
                            <span><i class="bi bi-table me-2"></i></span> Available Vehicles
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped data-table vehicles-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Vehicles</th>
                                            <th>Licence Plate</th>
                                            <th>Driver Name</th>
                                            <th>Driver Email</th>
                                            <th>Reserve Person</th>
                                            <th>Departure Time</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Detail</th>
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
                                                    <td> <?= $schedule['vehicles_model'] ?></td>
                                                    <td> <?= $schedule['vehicles_licence_plate'] ?></td>
                                                    <td> <?= $schedule['driver_name'] ?></td>
                                                    <td> <?= $schedule['driver_email'] ?></td>
                                                    <td> <?= $schedule['available_seat'] ?></td>
                                                    <td> <?= $schedule['departure_time'] ?></td>
                                                    <td> <?= $schedule['from_city'] ?></td>
                                                    <td> <?= $schedule['to_city'] ?></td>

                                                    <td>
                                                        <button type="button" value="<?= $schedule['schedule_id']; ?>" class="detailbtn btn bg-success rounded-4 border-0"> <span class="material-icons-outlined text-light p-1 rounded-4">
                                                                edit
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
                                            <th>Vehicles</th>
                                            <th>Licence Plate</th>
                                            <th>Driver Name</th>
                                            <th>Driver Email</th>
                                            <th>Reserve Person</th>
                                            <th>Departure Time</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Detail</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table end -->
        </div>
        <button onclick="topFunction()" id="myBtn" title="Go to top">↑</button>
    </main>

    <!-- ===================================Main container of Seat End=================================================== -->

    <!-- Custom Bootstrap-5 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="../../js/stationAdmin.js" type="module"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <!-- Alertify JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!-- Javascript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/driver.js"></script>
    <?php
    require '../../controller/traffic-page-controller.php';
    ?>

</body>

</html>