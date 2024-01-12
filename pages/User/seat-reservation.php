<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../../css/seat-reservation.css" />
  <link rel="stylesheet" href="../../css/main.css" />
  <!-- Custom Alertfy -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <title>Ethio Travel</title>
</head>

<body id="myTable">
  <!--***************************************** HEADER *********************************************-->
  <header>
    <!--***************************************** NAV BAR *********************************************-->
    <nav class="navbar navbar-expand-lg fixed-top  navcolor navbar-dark">
      <div class="container">
        <a class="navbar-brand fs-4 ethio" href="../../index.php"><img src="../../assets/bus.ico" alt="" style="width: 55px; height: 52px">
          Ethio Travel</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <div class="d-flex">
              <li class="nav-item">
                <a class="nav-link fw-bolder colorNav" href="../../index.php">Home</a>
              </li>
            </div>
          </ul>
        </div>
      </div>
    </nav>
  </header>




  <div class="container-driver row">
    <h4><span class="heading"> Seat Status</span></h4>
    <div class="col-md-6 row mb-5">
      <!-- 60 seats -->
      <?php
      require '../../model/dbcon.php';
      $vehicles_licence_plate = $_GET['vehicles_licence_plate'];
      $driver_name = $_GET['driver_name'];
      $transport_cost = $_GET['transport_cost'];
      $passenger_name = $_GET['passenger_name'];
      $email_address = $_GET['email_address'];
      $phone_number = $_GET['phone_number'];
      $selected_seat = $_GET['selected_seat'];
      $from_city = $_GET['from_city'];
      $to_city = $_GET['to_city'];
      $Status = $_GET['Status'];


      ?>
      <input type="hidden" id="vehicles_licence_plate" value="<?php echo $vehicles_licence_plate ?>">
      <input type="hidden" id="driver_name" value="<?php echo $driver_name ?>">
      <?php
      $check_seat_query = "SELECT * FROM seat WHERE vehicles_licence_plate = '$vehicles_licence_plate'";
      $result = mysqli_query($conn, $check_seat_query);
      $selected_seats = array();
      $reserved_seat = 0;
      while ($row = mysqli_fetch_assoc($result)) {
        array_push($selected_seats, $row["selected_seat"]);
        $reserved_seat++;
      }
      $available_seat = 35 - $reserved_seat;

      ?>
      <div class="col-md-12 div-btn">
        <button class="seat">1</button>
        <button class="seat">2</button>
        <button class="seat seat-mergin">3</button>
        <button class="seat">4</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">5</button>
        <button class="seat">6</button>
        <button class="seat seat-mergin">7</button>
        <button class="seat">8</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">9</button>
        <button class="seat">10</button>
        <button class="seat seat-mergin">11</button>
        <button class="seat">12</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">13</button>
        <button class="seat">14</button>
        <button class="seat seat-mergin">15</button>
        <button class="seat">16</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">17</button>
        <button class="seat">18</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">19</button>
        <button class="seat">20</button>
        <button class="seat seat-mergin">21</button>
        <button class="seat">22</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">23</button>
        <button class="seat">24</button>
        <button class="seat seat-mergin">25</button>
        <button class="seat">26</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">27</button>
        <button class="seat">28</button>
        <button class="seat seat-mergin">29</button>
        <button class="seat">30</button>
      </div>
      <div class="col-md-12 div-btn">
        <button class="seat">31</button>
        <button class="seat">32</button>
        <button class="seat">33</button>
        <button class="seat">34</button>
        <button class="seat">35</button>
      </div>
    </div>

    <div class="col-md-6">
      <div class="mb-4">
        <button class="p-clicked d-none">100</button>
      </div>
      <div class="mb-4">
        <button type="button" class="btn btn-success"></button>
        <p>Not Booked</p>
      </div>
      <div class="mb-4">
        <button type="button" class="btn btn-danger"></button>
        <p>Already Booked</p>
      </div>

      <form id="reserveSeat">
        <div id="errorMessage" class="alert alert-warning d-none"></div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">You Can Edit Your Information </label>
          <label for="exampleFormControlInput1" class="form-label">Total Cost:
          </label>
          <label for="transport_cost" name="transport_cost"><?php echo $transport_cost ?></label>
          <label for="exampleFormControlInput1" class="form-label">&nbsp;From:
          </label>
          <label for="transport_cost" name="transport_cost"><?php echo $from_city ?>&nbsp;</label>
          <label for="exampleFormControlInput1" class="form-label">&nbsp; To:
          </label>
          <label for="transport_cost" name="transport_cost"><?php echo $to_city ?></label>
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Passenger Name
          </label>
          <input type="text" class="form-control" pattern="[A-Za-z ]+" required name="passenger_name" value="<?php echo $passenger_name ?>" placeholder="" />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Email address</label>
          <input type="email" class="form-control" required name="email_address" value="<?php echo $email_address ?>" placeholder="" />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
          <input type="number" class="form-control" pattern="09[0-9]{8}" autocomplete="off" required name="phone_number" value="<?php echo $phone_number ?>" placeholder="" />
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Selected Seats</label>
          <input type="number" class="form-control selected_seat" max=35 min=1 value="<?php echo $selected_seat ?>" name="selected_seat" placeholder="" />
        </div>

        <div class="col-auto">
          <a href="./registration-page.php?vehicles_licence_plate=<?php echo $vehicles_licence_plate ?>&driver_name = <?php echo $driver_name ?> & transport_cost = <?php echo $transport_cost ?>& from_city = <?php echo $from_city ?> & to_city = <?php echo $to_city ?> ">
            <button type="submit" class="btn reserveSeat btn-primary mb-3">
              Finish
            </button>
          </a>
        </div>
      </form>
    </div>


  </div>
  <script>
    let selectedSeats = <?php echo json_encode($selected_seats); ?>;
    let seat = document.querySelectorAll(".seat");
    let p_clicked = document.querySelector(".p-clicked");

    for (let i = 0; i < seat.length; i++) {
      if (selectedSeats.includes(seat[i].textContent)) {
        seat[i].style.backgroundColor = "#ff0000";
        seat[i].disabled = true;
      }
    }
  </script>

  <!--***************************************** FOOTER *********************************************-->
  <?php include('../common/footer.php'); ?>
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  <!-- Alertify JS -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script>
    // Admin saving to model with ajax
    let lastClicked = p_clicked;

    for (let i = 0; i < seat.length; i++) {
      let originalColor = seat[i].style.backgroundColor;
      let originalSeat = "";
      seat[i].addEventListener("click", function() {
        if (seat[i] === lastClicked) {
          seat[i].style.backgroundColor = originalSeat;
          lastClicked = p_clicked;
          document.querySelector(".selected_seat").value = "";
        } else {
          lastClicked.style.backgroundColor = originalSeat;
          seat[i].style.backgroundColor = "rgb(255, 0, 0)";
          lastClicked = seat[i];
          document.querySelector(".selected_seat").value = this.innerHTML;
        }
      });
    }
  </script>
  <script>
    // Admin saving to model with ajax
    $(document).on("submit", "#reserveSeat", function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      formData.append("reserve_seat", true);

      $.ajax({
        type: "POST",
        url: "../../model/seat-reservation-model.php?vehicles_licence_plate=<?php echo $vehicles_licence_plate ?>&driver_name=<?php echo $driver_name ?>&Status=<?php echo $Status ?>&available_seat=<?php echo $available_seat ?>&from_city=<?php echo $from_city ?>&to_city=<?php echo $to_city ?>",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          var res = jQuery.parseJSON(response);
          if (res.status == 422) {
            alertify.set("notifier", "position", "top-right");
            alertify.success(res.message);
          } else if (res.status == 200) {
            $("#errorMessage").addClass("d-none");
            window.location.href = "./registration-page.php?vehicles_licence_plate=" + encodeURIComponent("<?php echo $vehicles_licence_plate ?>") + "&driver_name=" + encodeURIComponent("<?php echo $driver_name ?>") + "&transport_cost=" + encodeURIComponent("<?php echo $transport_cost ?>") + "&from_city=" + encodeURIComponent("<?php echo $from_city ?>") + "&to_city=" + encodeURIComponent("<?php echo $to_city ?>")

            alertify.set("notifier", "position", "top-right");
            alertify.success(res.message);
          }
        },
      });
    });
  </script>

</body>

</html>