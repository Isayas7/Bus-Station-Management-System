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
          <h2 class="card-title">Reset Your Password</h2>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="receive_confirmation">
          <div class="card-body">
            <div id="errorMessage" class="alert alert-danger d-none">
            </div>
            <div class="form-group mt-3">
              <label for="exampleInputEmail1">Enter Your Email address Confirmation code sent for you.</label>
              <input type="email" autocomplete="off" required class="form-control mt-3" id="user_email" name="user_email" placeholder="Enter email">
            </div>
            <div class="card-footer mt-3 ">
              <button type="submit" class="btn btn-primary ">Continue</button>
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
    $(document).on("submit", "#receive_confirmation",
      function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("send_confirm",
          true);
        $.ajax({
          type: "POST",
          url: "../../model/reset-password-model.php",
          data: formData,
          processData: false,
          contentType: false,
          success: function(
            response) {
            var res = jQuery.parseJSON(response);

            if (res.status == 422) {
              $("#errorMessage").removeClass("d-none");
              $("#errorMessage").text(res.message);
            } else if (res.status == 200) {
              $("#errorMessage").addClass("d-none");
              $("#receive_confirmation")[0].reset();
              window.location.href = "confirmation.php?user_email=" + encodeURIComponent(res.data) + "&confirmation=" + encodeURIComponent(res.message);
            }
          },
        });
      });
  </script>


</body>

</html>