<script>
        //   onclick of edit button
        $(document).on("click", ".detailbtn", function() {
            var schedule_id = $(this).val();

            $.ajax({
                type: "POST",
                url: "../../model/traffic-page-model.php?schedule_id=" + schedule_id,
                success: function(response) {
                    var res = jQuery.parseJSON(response);

                    if (res.status == 422) {} else if (res.status == 200) {
                        $("#schedule_id").text(res.data.schedule_id);
                        $("#vehicles_model").text(res.data.vehicles_model);
                        $("#vehicles_licence_plate").text(res.data.vehicles_licence_plate);
                        $("#vehicles_licence_plates").val(res.data.vehicles_licence_plate);
                        $("#driver_name").text(res.data.driver_name);
                        $("#driver_email").text(res.data.driver_email);
                        $("#reserved_people").text(35 - res.data.available_seat);
                        $("#departure_date").text(res.data.departure_date);
                        $("#departure_time").text(res.data.departure_time);
                        $("#from_city").text(res.data.from_city);
                        $("#to_city").text(res.data.to_city);

                        $("#vehicles_detail").modal("show");
                    }
                },
            });
        });

        $(document).on("submit", "#vehicles_info", function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("sent_report", true);
            $.ajax({
                type: "POST",
                url: "../../model/traffic-page-model.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        $("#errorMessage").removeClass("d-none");
                        $("#errorMessage").text(res.message);
                    } else if (res.status == 200) {
                        $("#errorMessage").addClass("d-none");
                        $("#vehicles_detail").modal("hide");

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
        $(document).ready(function() {
            $('#search').keyup(function() {
                search_table($(this).val());
            });

            function search_table(value) {
                $('#myTable tr').each(function() {
                    let found = 'false';
                    $(this).each(function() {
                        if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                            found = 'true';
                        }
                    });
                    if (found == 'true') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        })
    </script>