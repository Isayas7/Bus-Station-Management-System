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
        <!-- Custom Alertfy -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../../css/station-admin.css" />
    </head>

    <body>
        <!-- Offcanvas-bar container requre -->
        <?php
        include('../common/branch-offcanvas-nav-bar.php')
        ?>


        <!-- Main container of dashboard -->
        <main class="pt-3 main-container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 fw-bold fs-3">Passenger</div>
                </div>
             

            <!-- Modal used to register passenger -->
            <button type="button" class="btn btn-register ms-3" data-bs-toggle="modal" data-bs-target="#passengerAddModal" data-bs-whatever="@mdo">
                Register Passenger
            </button>

            <div class="modal fade" id="passengerAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="savePassenger">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                    Passenger Registration
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <!-- passenger Name -->
                                <div class="row">
                                    <div id="errorMessage" class="alert alert-warning d-none">
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="col-form-label"> Passenger First Name:</label>
                                        <input type="text" class="form-control" name="passenger_first_name" />
                                    </div>
                                    <div class="col-6">
                                        <label for="" class="col-form-label">Passenger Last Name:</label>
                                        <input type="text" class="form-control" name="passenger_last_name" />
                                    </div>
                                </div>
                                <!-- passenger email -->
                                <div class="mb-3">
                                    <label for="" class="col-form-label">passenger Email:</label>
                                    <input type="email" class="form-control" name="passenger_email" />
                                </div>

                                <!-- passenger Phone -->
                                <div class="mb-3">
                                    <label for="" class="col-form-label">passenger Phone:</label>
                                    <input type="tel" class="form-control" name="passenger_phone" />
                                </div>

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
            <!-- Modal of passenger registration end -->


            <!-- Modal used to update passenger -->

            <div class="modal fade" id="passengerEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="updatePassenger">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                    Passenger Updating
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <!-- Name Update -->
                                <div class="row">
                                    <div id="errorMessageUpdate" class="alert alert-warning d-none">
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" name="passenger_id" id="passenger_id">
                                    </div>
                                    <div class="col-6">
                                        <label for="passenger-name" class="col-form-label"> Passenger First Name:</label>
                                        <input type="text" class="form-control" name="passenger_first_name" id="passenger_first_name" />
                                    </div>
                                    <div class="col-6">
                                        <label for="passenger-name" class="col-form-label"> Passenger Last Name:</label>
                                        <input type="text" class="form-control" name="passenger_last_name" id="passenger_last_name" />
                                    </div>
                                </div>
                                <!-- passenger email -->
                                <div class="mb-3">
                                    <label for="dirver-email" class="col-form-label">Passenger Email:</label>
                                    <input type="email" class="form-control" name="passenger_email" id="passenger_email" />
                                </div>
                                <!-- passenger phone -->
                                <div class="mb-3">
                                    <label for="" class="col-form-label">Passenger Phone Number:</label>
                                    <input type="tel" class="form-control" name="passenger_phone" id="passenger_phone" />
                                </div>

                                <div class="mb-3">
                                    <label for="to_city" class="col-form-label">To</label>
                                    <select class="form-select" name="passenger_to" id="passenger_to">

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
            <!-- Modal of passenger update end -->


          <!-- table start -->
          <div class="row ms-2">
              <div class="col-md-12 mb-3">
                  <div class="border-1">
                      <div class="table-header">
                          <span><i class="bi bi-table me-2"></i></span> Regural Booking
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table id="myTable" class="table table-striped data-table passenger-table" style="width: 100%">
                                  <thead>
                                      <tr>
                                          <th>Passenger Name</th>
                                          <th>Passenger Email</th>
                                          <th>Phone Number</th>
                                        
                                          <th>To</th>
                                          <th>Vehicle</th>
                                          <th>Seat</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                      <?php
                                        require '../../model/dbcon.php';
                                        $query = "SELECT * FROM seat WHERE from_city='$station_city'";
                                        $query_run = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $passenger) {
                                        ?>
                                              <tr>
                                                  <td><?= $passenger['passenger_name'] ?></td>
                                                  <td><?= $passenger['email_address'] ?></td>
                                                  <td><?= $passenger['phone_number'] ?></td>
                                                
                                                  <td><?= $passenger['to_city'] ?></td>
                                                  <td><?= $passenger['vehicles_licence_plate'] ?></td>
                                                  <td><?= $passenger['selected_seat'] ?></td>
                                                  
                                              </tr>
                                      <?php
                                            }
                                        }
                                        ?>
                                  </tbody>
                                  <tfoot>
                                      <tr>
                                         <th>Passenger Name</th>
                                          <th>Passenger Email</th>
                                          <th>Phone Number</th>
                                         
                                          <th>To</th>
                                          <th>Vehicle</th>
                                          <th>Seat</th>
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
        <script src="../../js/stationAdmin.js"></script>
       <script src="../../js/branch_offcanvas_nav_bar.js"></script>

    </body>

    </html>