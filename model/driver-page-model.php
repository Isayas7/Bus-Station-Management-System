<?php
require '../model/dbcon.php';
// TO save passenger information
$status = 'Pending';
$vehicles_licence_plates = $_GET['vehicles_licence_plate'];

if (isset($_POST['sent_request'])) {
    $vehicles_licence_plate = mysqli_real_escape_string($conn, $vehicles_licence_plates);
    $schedule_status = mysqli_real_escape_string($conn, $status);

    // To chech if the vehicles full or not
    $seat_no = "SELECT seat FROM vehicles WHERE vehicles_licence_plate = '$vehicles_licence_plate'";
    $seat_no_query = mysqli_query($conn, $seat_no);
    $driver = mysqli_fetch_array($seat_no_query);

    if ($driver['seat'] != 0) {
        $res = [
            'status' => 422,
            'message' => 'Vehicles Must be Full!'
        ];
        echo json_encode($res);
        return false;
    }

    // To che if the driver sent the request or not
    $schedule_stat = "SELECT schedule_status FROM schedule WHERE vehicles_licence_plate = '$vehicles_licence_plate'";
    $schedule_stat_query = mysqli_query($conn, $schedule_stat);
    $stat_of_vehicles = mysqli_fetch_array($schedule_stat_query);

    if ($stat_of_vehicles['schedule_status'] == 'Pending') {
        $res = [
            'status' => 422,
            'message' => 'You have already sent request!'
        ];
        echo json_encode($res);
        return false;
    } else if ($stat_of_vehicles['schedule_status'] == 'Approved') {
        $res = [
            'status' => 422,
            'message' => 'You have already get ticket!'
        ];
        echo json_encode($res);
        return false;
    }


    $query = "UPDATE schedule SET schedule_status='$schedule_status' WHERE vehicles_licence_plate='$vehicles_licence_plate'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Request sent Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Request not Updated'
        ];
        echo json_encode($res);
        return false;
    }
};
