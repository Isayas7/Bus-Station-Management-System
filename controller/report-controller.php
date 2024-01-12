<script>
    
        $(document).on("click", ".deactivateBtn", function(e) {
            e.preventDefault();
            if (confirm("Are you sure you want to deactivate this vehicle?")) {
                var user_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "../../model/report-page-model.php",
                    data: {
                        report_manage: true,
                        user_id: user_id,
                    },

                    success: function(response) {
                        var res = jQuery.parseJSON(response);

                        if (res.status == 500) {
                            alert(res.message);
                        } else {
                            alertify.set("notifier", "position", "top-right");
                            alertify.success(res.message);

                               $("#myCard").load(location.href + " #myCard");
                        }
                    },
                });
            }
        });
    </script>
