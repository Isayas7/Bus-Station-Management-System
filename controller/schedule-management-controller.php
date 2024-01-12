<script>
           // Schedule saving to model with ajax
           $(document).on("submit", "#saveSchedule", function(e) {
               e.preventDefault();
               var formData = new FormData(this);
               formData.append("save_schedule", true);

               $.ajax({
                   type: "POST",
                   url: "../../model/schedule-management-model.php?vehicles_licence_plate=<?php echo $vehicles['vehicles_licence_plate'] ?>&station_city=<?php echo $station_city ?>",
                   data: formData,
                   processData: false,
                   contentType: false,
                   success: function(response) {
                       var res = jQuery.parseJSON(response);
                       if (res.status == 422) {
                           alert("422");
                           $("#errorMessage").removeClass("d-none");
                           $("#errorMessage").text(res.message);
                       } else if (res.status == 200) {
                           $("#errorMessage").addClass("d-none");
                           $("#scheduleAddModal").modal("hide");
                           $("#saveSchedule")[0].reset();

                           alertify.set("notifier", "position", "top-right");
                           alertify.success(res.message);

                           $("#myTable").load(location.href + " #myTable");
                       } else {
                           alert(res.message);
                       }
                   },
               });
           });

           // Schedule deleting to model with ajax
           $(document).on("click", ".deleteScheduleBtn", function(e) {
               e.preventDefault();

               if (confirm("Do you Want Approve it?")) {
                   var schedule_id = $(this).val();
                   $.ajax({
                       type: "POST",
                       url: "../../model/schedule-management-model.php?vehicles_licence_plate=<?php echo $vehicles['vehicles_licence_plate'] ?>&station_city=<?php echo $station_city ?>",
                       data: {
                           delete_schedule: true,
                           schedule_id: schedule_id,
                       },
                       success: function(response) {
                           var res = jQuery.parseJSON(response);
                           if (res.status == 500) {
                               alert(res.message);
                           } else if (res.status == 422) {
                               alertify.set("notifier", "position", "top-right");
                               alertify.error(res.message);
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
