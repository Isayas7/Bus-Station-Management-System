<script>
    // Admin saving to model with ajax

    $(document).on("submit", "#saveAdmin", function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_admin", true);
        $.ajax({
            type: "POST",
            url: "../model/admin-dashboard-model.php",
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
                    $("#adminAddModal").modal("hide");
                    $("#saveAdmin")[0].reset();

                    alertify.set("notifier", "position", "top-right");
                    alertify.success(res.message);

                    $("#myTable").load(location.href + " #myTable");
                }
            },
        });
    });
    // onclick of edit button
    $(document).on("click", ".editAdminBtn", function() {
        var user_id = $(this).val();
        // alert(user_id);
        $.ajax({
            type: "POST",
            url: "../../model/admin-dashboard-model.php?user_id=" + user_id,
            success: function(response) {
                var res = jQuery.parseJSON(response);

                if (res.status == 422) {
                    alert(res.message);
                } else if (res.status == 200) {
                    $("#user_id").val(res.data.user_id);
                    $("#user_first_name").val(res.data.user_first_name);
                    $("#user_middle_name").val(res.data.user_middle_name);
                    $("#user_last_name").val(res.data.user_last_name);
                    $("#user_email").val(res.data.user_email);
                    $("#admin_station").val(res.data.admin_station);
                    $("#user_phone_number").val(res.data.user_phone_number);
                    $("#user_status").val(res.data.user_status);
                    $("#user_role").val(res.data.user_role);

                    $("#adminEditModal").modal("show");
                }
            },
        });
    });
    // Admin saving to model with ajax
    $(document).on("submit", "#updateAdmin", function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_admin", true);
        $.ajax({
            type: "POST",
            url: "../../model/admin-dashboard-model.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    $("#errorMessageUpdate").removeClass("d-none");
                    $("#errorMessageUpdate").text(res.message);
                } else if (res.status == 200) {
                    $("#errorMessageUpdate").addClass("d-none");
                    $("#adminEditModal").modal("hide");
                    $("#updateAdmin")[0].reset();

                    alertify.set("notifier", "position", "top-right");
                    alertify.success(res.message);

                    $("#myTable").load(location.href + " #myTable");
                }
            },
        });
    });
    // Admin deleting to model with ajax
    $(document).on("click", ".deleteAdminBtn", function(e) {
        e.preventDefault();

        if (confirm("Are you sure you want to delete this data?")) {
            var user_id = $(this).val();
            $.ajax({
                type: "POST",
                url: "../../model/admin-dashboard-model.php",
                data: {
                    delete_admin: true,
                    user_id: user_id,
                },


                success: function(response) {
                    var res = jQuery.parseJSON(response);

                    if (res.status == 500) {
                        alert(res.message);
                    } else {
                        alertify.set("notifier", "position", "top-right");
                        alertify.success(res.message);

                        $("#myTable").load(location.href + " #myTable");
                    }
                },
            });
        }
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