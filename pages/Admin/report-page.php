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
    <div class="row">
      <div class="col-md-12 fw-bold fs-3 ms-3">Report</div>
    </div>
    <div class="col-lg-12">
      <?php
      require '../../model/dbcon.php';
      $query = "SELECT * FROM report WHERE a_status='not_seen'";
      $query_run = mysqli_query($conn, $query);
      if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $report) {

      ?>
          <div class="card" id='myCard'>
            <div class="card-header">

              <h5 class="card-title m-0">Licence Plate: <?php echo $report['vehicles_licence_plate'] ?></h5>
              <?php if ($report['report_type'] == 'pass_T') {
                $report_type = 'Traffic offense';
              } else if ($report['report_type'] == 'take_extra') {
                $report_type = 'Overloading';
              } else {
                $report_type = 'Accident';
              } ?>
              <h5 class="card-title m-0">Report Type: <?php echo $report_type ?></h5>
            </div>
            <div class="card-body">
              <h6 class="card-title"></h6>

              <p class="card-text">Reporting a traffic violation that witnessed. A Vehicle license plate number above voilate the traffic rule. </p>
              <p class="card-text"> The driver of the vehicle was driving recklessly and appeared to be in a hurry. The incident may occurred</p>
              <button type="button" value="<?= $report['vehicles_licence_plate']; ?>" class="btn deactivateBtn btn-primary">Deactivate</button>
            </div>
        <?php
        }
      }

        ?>
          </div>

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
  require '../../controller/report-controller.php';
  ?>

</body>

</html>