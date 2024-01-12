<script>
         // Admin saving to model with ajax

         $(document).on("submit", "#saveVehicles", function(e) {
             e.preventDefault();

             var formData = new FormData(this);
             formData.append("save_vehicles", true);
             $.ajax({
                 type: "POST",
                 url: "../../model/vehicles-management-model.php",
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
                         $("#vehiclesAddModal").modal("hide");
                         $("#saveVehicles")[0].reset();

                         alertify.set("notifier", "position", "top-right");
                         alertify.success(res.message);

                         $("#myTable").load(location.href + " #myTable");
                     }
                 },
             });
         });

         //   onclick of edit button
         $(document).on("click", ".editVehiclesBtn", function() {
             var vehicles_id = $(this).val();
             // alert(vehicles_id);
             $.ajax({
                 type: "POST",
                 url: "../../model/vehicles-management-model.php?vehicles_id=" + vehicles_id,
                 success: function(response) {
                     var res = jQuery.parseJSON(response);

                     if (res.status == 422) {
                         alert(res.message);
                     } else if (res.status == 200) {
                         $("#vehicles_id").val(res.data.vehicles_id);
                         $("#driver_first_name").val(res.data.driver_first_name);
                         $("#driver_middle_name").val(res.data.driver_middle_name);
                         $("#driver_last_name").val(res.data.driver_last_name);
                         $("#driver_email").val(res.data.driver_email);
                         $("#driver_phone").val(res.data.driver_phone);
                         $("#vehicles_model").val(res.data.vehicles_model);
                         $("#vehicles_licence_plate").val(res.data.vehicles_licence_plate);
                         $("#vehicles_status").val(res.data.status);
                         console.log("this");
                         $("#vehiclesEditModal").modal("show");
                     }
                 },
             });
         });
         // Vehicle saving to model with ajax
         $(document).on("submit", "#updateVehicles", function(e) {
             e.preventDefault();

             var formData = new FormData(this);
             formData.append("update_vehicles", true);
             $.ajax({
                 type: "POST",
                 url: "../../model/vehicles-management-model.php",
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
                         $("#vehiclesEditModal").modal("hide");
                         $("#updateVehicles")[0].reset();

                         alertify.set("notifier", "position", "top-right");
                         alertify.success(res.message);

                         $("#myTable").load(location.href + " #myTable");
                     }
                 },
             });
         });

         // Vehicles deleting to model with ajax
         $(document).on("click", ".deleteVehiclesBtn", function(e) {
             e.preventDefault();

             if (confirm("Are you sure you want to delete this data?")) {
                 var vehicles_id = $(this).val();
                 $.ajax({
                     type: "POST",
                     url: "../../model/vehicles-management-model.php",
                     data: {
                         delete_vehicles: true,
                         vehicles_id: vehicles_id,
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
