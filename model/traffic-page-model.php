<?php
require '../model/dbcon.php';
// Schedule id generation

if (isset($_GET['schedule_id'])) {
    $schedule_id = mysqli_real_escape_string($conn, $_GET['schedule_id']);
    $query = "SELECT * FROM schedule WHERE schedule_id ='$schedule_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $schedule = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Schedule Fetch Successfully by id',
            'data' => $schedule
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Schedule Id not found'
        ];
        echo json_encode($res);
        return false;
    }
}


$ad_status = 'not_seen';
$dr_status = 'not_seen';
// TO save passenger information
if (isset($_POST['sent_report'])) {
    $vehicles_licence_plate = mysqli_real_escape_string($conn, $_POST['vehicles_licence_plates']);
    $report_type = mysqli_real_escape_string($conn, $_POST['report_type']);
    $a_status = mysqli_real_escape_string($conn, $ad_status);
    $d_status = mysqli_real_escape_string($conn, $dr_status);
   
    $query = "INSERT INTO report(vehicles_licence_plate, report_type, a_status, d_status)
VALUES ('$vehicles_licence_plate','$report_type','$a_status','$d_status')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Report Sent Successfully',
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Report not Sent'
        ];
        echo json_encode($res);
        return false;
    }
};
