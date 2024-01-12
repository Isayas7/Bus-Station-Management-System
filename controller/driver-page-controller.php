<script>
    $(document).on("click", "#request", function(e) {
      e.preventDefault();

      var formData = new FormData(this);
      formData.append("sent_request", true);
      $.ajax({
        type: "POST",
        url: "../../model/driver-page-model.php?vehicles_licence_plate=<?php echo $driver['vehicles_licence_plate'] ?>",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          var res = jQuery.parseJSON(response);
          if (res.status == 422) {
            alertify.set("notifier", "position", "top-right");
            alertify.error(res.message);
          } else if (res.status == 200) {
            alertify.set("notifier", "position", "top-right");
            alertify.success(res.message);
          }
        },
      });
    });

    // change profile
    // onclick of edit button
    $(document).on("click", ".edit_profile", function() {
      var user_email = $(this).val();
      // alert(user_id);
      $.ajax({
        type: "POST",
        url: "../../model/manage-profile.php?user_email=" + user_email,
        success: function(response) {
          var res = jQuery.parseJSON(response);
          if (res.status == 422) {
            alert(res.message);
          } else if (res.status == 200) {
            $("#profile_first_name").val(res.data.user_first_name);
            $("#profile_middle_name").val(res.data.user_middle_name);
            $("#profile_last_name").val(res.data.user_last_name);
            $("#profile_phone_number").val(res.data.user_phone_number);

            $("#_login_modal").modal("show");
          }
        },
      });
    });
    // Update Profile
    $(document).on("submit", "#manage_profile", function(e) {
      e.preventDefault();

      var formData = new FormData(this);
      formData.append("change_field", true);
      $.ajax({
        type: "POST",
        url: "../../model/manage-profile.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          var res = jQuery.parseJSON(response);
          if (res.status == 422) {
            $("#error_on_pro").removeClass("d-none");
            $("#error_on_pro").text(res.message);
          } else if (res.status == 200) {
            $("#error_on_pro").addClass("d-none");
            $("#_login_modal").modal("hide");
            $("#manage_profile")[0].reset();

            alertify.set("notifier", "position", "top-right");
            alertify.success(res.message);
          }
        },
      });
    });


    // Change password
    $(document).on("submit", "#change_pass", function(e) {
      e.preventDefault();

      var formData = new FormData(this);
      formData.append("change_password", true);
      $.ajax({
        type: "POST",
        url: "../../model/manage-profile.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          var res = jQuery.parseJSON(response);
          if (res.status == 422) {
            $("#error_on_pass").removeClass("d-none");
            $("#error_on_pass").text(res.message);
          } else if (res.status == 200) {
            $("#error_on_pass").addClass("d-none");
            $("#password_modal").modal("hide");
            $("#change_pass")[0].reset();

            alertify.set("notifier", "position", "top-right");
            alertify.success(res.message);
          }
        },
      });
    });
  </script>