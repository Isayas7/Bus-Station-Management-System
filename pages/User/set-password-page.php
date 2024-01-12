<?php
session_start();
$user_email=$_GET['user_email'];
?>
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

<body>
        <header>
    <!-- *************************************************************************** -->
    <!-- Nav bar -->
    <nav class="navbar navbar-expand-lg navcolor navbar-dark">
      <div class="container">
        <a class="navbar-brand fs-4 ethio" href="../../index.php"><img src="../../assets/bus.ico" alt="" style="width: 55px; height: 52px" />
          Ethio Travel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

      </div>
    </nav>
  </header>
  <!-- general form elements -->
  <div class="row justify-content-center">
    <div class="col-4">
            <div class="card card-primary">
              <div class="card-header">
                <h2 class="card-title">Set Your New Password</h2>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="set_password">
                <div class="card-body">
                <div id="errorMessage"
                            class="alert alert-danger d-none">
                        </div>
                   <div class="form-group mt-3">
                    <label for="exampleInputPassword1">New Password</label>
                    <input type="password" required class="form-control mt-3" name="new_password" id="new_password" placeholder="Password">
                  </div>
                   <div class="form-group mt-3">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="password" required class="form-control mt-3" name="confirm_password" id="confirm_password" placeholder="Password">
                  </div>
                <div class="card-footer mt-3">
                  <button  type="submit" class="btn btn-primary align-right">Continue</button>
                </div>
              </form>
            </div>
            </div>
            </div>
            <!-- /.card -->
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  <!-- Alertify JS -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script>
    $(document).on("submit", "#set_password",
        function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("update_password",
                true);
            $.ajax({
                type: "POST",
                url: "../../model/set-password-model.php?user_email=<?php echo $user_email ?>",
                data: formData,
                processData: false,
                contentType: false,
                success: function(
                    response) {var res=jQuery.parseJSON(response);
                      
                    if (res.status ==422) {
                        $("#errorMessage").removeClass("d-none" );
                        $("#errorMessage").text(res.message);
                    } else if (res.status ==200) {
                        $("#errorMessage").addClass("d-none");
                        $("#set_password")[0].reset();

                        $role = res.data.user_role;
            $station = res.data.admin_station;
            $user_name = res.data.user_email;
            if ($role == "super_admin" && $station == "all") {

              window.location.href = "../Admin/admin-dashboard.php";

            } else if ($role == "station_admin") {

              window.location.href =
                "../station-admin/station-admin-dashboard.php?station_city=" +
                $station;
            } else if ($role == "traffic_p") {
              window.location.href = "./pages/user/traffic-page.php";
            } else if ($role == "driver") {
              window.location.href = "../user/driver-page.php?user_email=" + $user_name;
            }
                    }
                },
            });
        });
</script>
</body>

</html>