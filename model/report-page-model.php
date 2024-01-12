<?php
require '../model/dbcon.php';

// To delete Admin from the list
if (isset($_POST['report_manage'])) {
    $vehicles_licence_plate = mysqli_real_escape_string($conn, $_POST['user_id']);
$vehicles_status=mysqli_real_escape_string($conn,'Deactive');
$a_status=mysqli_real_escape_string($conn, 'seen');

    
    $queryv = "UPDATE vehicles SET  status ='$vehicles_status' WHERE vehicles_licence_plate='$vehicles_licence_plate'";
    $query_runv = mysqli_query($conn, $queryv);

   $queryr = "UPDATE report SET  a_status='$a_status' WHERE vehicles_licence_plate='$vehicles_licence_plate'";
    $query_runr = mysqli_query($conn, $queryr);


    if ($query_runv && $query_runr) {
        $res = [
            'status' => 200,
            'message' => 'Vehicles Deactivated Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Vehicles Not Deactivated'
        ];
        echo json_encode($res);
        return false;
    }
}
