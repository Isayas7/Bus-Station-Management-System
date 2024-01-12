<?php
require './dbcon.php';
$approving = 'Approved';
// To delete schedule from the list
if (isset($_POST['delete_schedule'])) {
    $schedule_id = mysqli_real_escape_string($conn, $_POST['schedule_id']);

    $confirm_query = "SELECT * FROM schedule WHERE schedule_id='$schedule_id'";
    $confirm_query_run = mysqli_query($conn, $confirm_query);
    $stat = mysqli_fetch_array($confirm_query_run);

    if ($stat['schedule_status'] == 'Normal') {
        $res = [
            'status' => 422,
            'message' => 'The vehicle is not full!'
        ];
        echo json_encode($res);
        return false;
    } else if ($stat['schedule_status'] == 'Approved') {
        $res = [
            'status' => 422,
            'message' => 'You have already approved!'
        ];
        echo json_encode($res);
        return false;
    }


    $query = "UPDATE schedule SET schedule_status='$approving' WHERE schedule_id='$schedule_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Schedule Approved Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Schedule Not Approved'
        ];
        echo json_encode($res);
        return false;
    }
}
$status = 'Normal';

// TO save schedule information
if (isset($_POST['save_schedule'])) {
    $station_city = $_GET['station_city'];
    $vehicles_licence_plate = $_POST['vehicles_licence_plate'];
    // Prepare the SELECT statement
    $sql = "SELECT * FROM vehicles WHERE vehicles_licence_plate = '$vehicles_licence_plate'";
    // Execute the query
    $result = mysqli_query($conn, $sql);
    // Fetch the result as an associative array
    $vehicles = mysqli_fetch_assoc($result);

    $driver_name = mysqli_real_escape_string($conn, $vehicles['driver_first_name']);
    $driver_email = mysqli_real_escape_string($conn, $vehicles['driver_email']);
    $vehicles_licence_plate = mysqli_real_escape_string($conn, $_POST['vehicles_licence_plate']);
    $vehicles_model = mysqli_real_escape_string($conn, $vehicles['vehicles_model']);
    $seat = mysqli_real_escape_string($conn, 35);
    $departure_date = mysqli_real_escape_string($conn, $_POST['departure_date']);
    $departure_time = mysqli_real_escape_string($conn, $_POST['departure_time']);
    $from_city = mysqli_real_escape_string($conn, $station_city);
    $to_city = mysqli_real_escape_string($conn, $_POST['to_city']);
    $transport_cost = mysqli_real_escape_string($conn, $_POST['transport_cost']);


    if (
        $vehicles_licence_plate == NULL || $departure_date == NULL || $departure_time == NULL
        || $to_city == NULL
    ) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    $confirm_query = "DELETE FROM schedule WHERE vehicles_licence_plate='$vehicles_licence_plate'";
    $confirm_query_run = mysqli_query($conn, $confirm_query);
    $confirm_query_seat = "DELETE FROM seat WHERE vehicles_licence_plate='$vehicles_licence_plate'";
    $confirm_query_run_seat = mysqli_query($conn, $confirm_query_seat);
    if ($confirm_query_run) {
        $query = "INSERT INTO schedule(driver_name, driver_email, vehicles_licence_plate, vehicles_model,available_seat,departure_date,departure_time,from_city,to_city,transport_cost,schedule_status)
VALUES ('$driver_name','$driver_email','$vehicles_licence_plate','$vehicles_model','$seat','$departure_date','$departure_time','$from_city','$to_city','$transport_cost','$status')";
        $query_run = mysqli_query($conn, $query);
        if ($query_run) {

            $res = [
                'status' => 200,
                'message' => 'Scheduele Created Successfully',
            ];
            echo json_encode($res);
            return false;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Scheduele Not Created' . mysqli_error($conn)
            ];
            echo json_encode($res);
            return false;
        }
    }
};
