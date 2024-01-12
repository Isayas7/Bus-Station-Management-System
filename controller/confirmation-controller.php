<script>
    $(document).on("submit", "#_confirm_",
        function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("confirm_user",
                true);
            $.ajax({
                type: "POST",
                url: "../../model/confirmation-model.php?confirmation=<?php echo $confirmation ?>",
                data: formData,
                processData: false,
                contentType: false,
                success: function(
                    response) {
                    var res =
                        jQuery
                        .parseJSON(response);

                    if (res
                        .status ==
                        422) {
                        $("#errorMessage")
                            .removeClass(
                                "d-none"
                            );
                        $("#errorMessage")
                            .text(
                                res
                                .message
                            );
                    } else if (res
                        .status ==
                        200) {
                        $("#errorMessage")
                            .addClass(
                                "d-none"
                            );
                        $("#_confirm_")[0]
                            .reset();
                        window.location.href = "set-password-page.php?user_email=" + encodeURIComponent('<?php echo $user_email ?>');

                    }
                },
            });
        });
</script>