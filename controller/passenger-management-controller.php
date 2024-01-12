<script>
          // passenger saving to model with ajax

          $(document).on("submit", "#savePassenger", function(e) {
              e.preventDefault();

              var formData = new FormData(this);
              formData.append("save_passenger", true);
              $.ajax({
                  type: "POST",
                  url: "../../model/passenger-management-model.php",
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
                          $("#passengerAddModal").modal("hide");
                          $("#savePassenger")[0].reset();

                          alertify.set("notifier", "position", "top-right");
                          alertify.success(res.message);

                          $("#myTable").load(location.href + " #myTable");
                      }
                  },
              });
          });

          //   onclick of edit button
          $(document).on("click", ".editPassengerBtn", function() {
              var passenger_id = $(this).val();
              // alert(passenger_id);
              $.ajax({
                  type: "POST",
                  url: "../../model/passenger-management-model.php?passenger_id=" + passenger_id,
                  success: function(response) {
                      var res = jQuery.parseJSON(response);

                      if (res.status == 422) {
                          alert(res.message);
                      } else if (res.status == 200) {
                          $("#passenger_id").val(res.data.passenger_id);
                          $("#passenger_first_name").val(res.data.passenger_first_name);
                          $("#passenger_last_name").val(res.data.passenger_last_name);
                          $("#passenger_email").val(res.data.passenger_email);
                          $("#passenger_phone").val(res.data.passenger_phone);
                          $("#passenger_from").val(res.data.passenger_from);
                          $("#passenger_to").val(res.data.passenger_to);
                          console.log("this");
                          $("#passengerEditModal").modal("show");
                      }
                  },
              });
          });
          // Vehicle saving to model with ajax
          $(document).on("submit", "#updatePassenger", function(e) {
              e.preventDefault();

              var formData = new FormData(this);
              formData.append("update_passenger", true);
              $.ajax({
                  type: "POST",
                  url: "../../model/passenger-management-model.php",
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
                          $("#passengerEditModal").modal("hide");
                          $("#updatePassenger")[0].reset();

                          alertify.set("notifier", "position", "top-right");
                          alertify.success(res.message);

                          $("#myTable").load(location.href + " #myTable");
                      }
                  },
              });
          });

          // Passenger deleting to model with ajax
          $(document).on("click", ".deletePassengerBtn", function(e) {
              e.preventDefault();

              if (confirm("Are you sure you want to delete this data?")) {
                  var passenger_id = $(this).val();
                  $.ajax({
                      type: "POST",
                      url: "../../model/passenger-management-model.php",
                      data: {
                          delete_passenger: true,
                          passenger_id: passenger_id,
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