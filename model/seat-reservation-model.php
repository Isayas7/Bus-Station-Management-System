<?php
require './dbcon.php';
$vehicles_licence_plate = $_GET['vehicles_licence_plate'];
$driver_name = $_GET['driver_name'];
$Status = $_GET['Status'];
$available_seat = $_GET['available_seat'];
$from_city = $_GET['from_city'];
$to_city = $_GET['to_city'];
//$Status = $_GET['Status'];
if (isset($_POST['reserve_seat'])) {
    $passenger_name = mysqli_real_escape_string($conn, $_POST['passenger_name']);
    $email_address = mysqli_real_escape_string($conn, $_POST['email_address']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $selected_seat = mysqli_real_escape_string($conn, $_POST['selected_seat']);
    $from_city = mysqli_real_escape_string($conn, $from_city);
    $to_city = mysqli_real_escape_string($conn, $to_city);
    if (
        $passenger_name == NULL || $email_address == NULL || $phone_number ==
        NULL || $selected_seat == NULL
    ) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    if ($Status != 'Paid') {
        $res = [
            'status' => 422,
            'message' => 'You Shoud Have To Pay First'
        ];
        echo json_encode($res);
        return false;
    }




    $check_seat_query = "SELECT * FROM seat WHERE selected_seat = '$selected_seat' AND vehicles_licence_plate = '$vehicles_licence_plate'";
    $check_seat_result = mysqli_query($conn, $check_seat_query);

    if (mysqli_num_rows($check_seat_result) == 0) {
        $insert_query = "INSERT INTO seat (passenger_name, vehicles_licence_plate, driver_name, email_address, phone_number, selected_seat,passenger_status,from_city,to_city)
                    VALUES ('$passenger_name', '$vehicles_licence_plate', '$driver_name', '$email_address', '$phone_number', '$selected_seat','$Status','$from_city','$to_city')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            $queryv = "UPDATE vehicles SET seat='$available_seat' WHERE vehicles_licence_plate='$vehicles_licence_plate'";
            $querys = "UPDATE schedule SET available_seat='$available_seat' WHERE vehicles_licence_plate='$vehicles_licence_plate'";
            $query_runv = mysqli_query($conn, $queryv);
            $query_runs = mysqli_query($conn, $querys);

            $to = $email_address;
            $subject = "Ethio Tavel";
            $message = "Here is your Seat Number: " . $selected_seat;
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers = "Content-type:text/text/html;charset=UTF-8" . "\r\n";
            $headers = 'From: ebisagirma41@gmail.com' . "\r\n";

            mail($to, $subject, $message, $headers);

            $res = [
                'status' => 200,
                'message' => 'Reserved Successfully',
            ];
            echo json_encode($res);
            return false;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Not Reserved'
            ];
            echo json_encode($res);
            return false;
        }
    }
};
