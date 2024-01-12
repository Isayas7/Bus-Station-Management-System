<?php
require '../model/dbcon.php';


// passenger id generation

if (isset($_GET['passenger_id'])) {
    $passenger_id = mysqli_real_escape_string($conn, $_GET['passenger_id']);

    $query = "SELECT * FROM passenger WHERE passenger_id ='$passenger_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $passenger = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Passenger Fetch Successfully by id',
            'data' => $passenger
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Passenger Id not found'
        ];
        echo json_encode($res);
        return false;
    }
}



// TO save passenger information
if (isset($_POST['save_passenger'])) {
    $station_city = $_GET['station_city'];

    $passenger_first_name = mysqli_real_escape_string($conn, $_POST['passenger_first_name']);
    $passenger_last_name = mysqli_real_escape_string($conn, $_POST['passenger_last_name']);
    $passenger_email = mysqli_real_escape_string($conn, $_POST['passenger_email']);
    $passenger_phone = mysqli_real_escape_string($conn, $_POST['passenger_phone']);
    $passenger_from = mysqli_real_escape_string($conn, $station_city);
    $passenger_to = mysqli_real_escape_string($conn, $_POST['to_city']);


    if (
        $passenger_first_name == NULL || $passenger_last_name == NULL || $passenger_email == NULL || $passenger_phone == NULL || $passenger_from == NULL || $passenger_to == NULL
    ) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    $query = "INSERT INTO passenger(passenger_first_name, passenger_last_name, passenger_email, passenger_phone,passenger_from,passenger_to)
VALUES ('$passenger_first_name','$passenger_last_name','$passenger_email','$passenger_phone','$passenger_from','$passenger_to')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Passenger Created Successfully',
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Passenger Not Created'
        ];
        echo json_encode($res);
        return false;
    }
};

// To update passenger information
if (isset($_POST['update_passenger'])) {
    $station_city = $_GET['station_city'];
    $passenger_id = mysqli_real_escape_string($conn, $_POST['passenger_id']);
    $passenger_first_name = mysqli_real_escape_string($conn, $_POST['passenger_first_name']);
    $passenger_last_name = mysqli_real_escape_string($conn, $_POST['passenger_last_name']);
    $passenger_email = mysqli_real_escape_string($conn, $_POST['passenger_email']);
    $passenger_phone = mysqli_real_escape_string($conn, $_POST['passenger_phone']);
    $passenger_from = mysqli_real_escape_string($conn, $station_city);
    $passenger_to = mysqli_real_escape_string($conn, $_POST['passenger_to']);



    if (
        $passenger_first_name == NULL || $passenger_first_name == NULL || $passenger_last_name == NULL
        || $passenger_email == NULL || $passenger_phone == NULL || $passenger_from == NULL || $passenger_to == NULL
    ) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    $query = "UPDATE passenger SET passenger_first_name='$passenger_first_name',passenger_last_name='$passenger_last_name',passenger_email='$passenger_email', passenger_phone='$passenger_phone', passenger_from='$passenger_from',passenger_to='$passenger_to' WHERE passenger_id='$passenger_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Passenger Updated Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Passenger Not Updated'
        ];
        echo json_encode($res);
        return false;
    }
}


// To delete Passenger from the list
if (isset($_POST['delete_passenger'])) {
    $passenger_id = mysqli_real_escape_string($conn, $_POST['passenger_id']);

    $query = "DELETE FROM passenger WHERE passenger_id='$passenger_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Passenger Deletd Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Passenger Not Deleted'
        ];
        echo json_encode($res);
        return false;
    }
}
