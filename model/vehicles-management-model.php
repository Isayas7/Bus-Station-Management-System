<?php

require '../model/dbcon.php';


// vehicles id generation

if (isset($_GET['vehicles_id'])) {
    $vehicles_id = mysqli_real_escape_string($conn, $_GET['vehicles_id']);

    $query = "SELECT * FROM vehicles WHERE vehicles_id ='$vehicles_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $vehicles = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Vehicles Fetch Successfully by id',
            'data' => $vehicles
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Vehicles Id not found'
        ];
        echo json_encode($res);
        return false;
    }
}


// Password generation
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < 8; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
}


// TO save vehicles information
if (isset($_POST['save_vehicles'])) {
    $user_first_name = mysqli_real_escape_string($conn, $_POST['user_first_name']);
    $user_middle_name = mysqli_real_escape_string($conn, $_POST['user_middle_name']);
    $user_last_name = mysqli_real_escape_string($conn, $_POST['user_last_name']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $user_phone_number = mysqli_real_escape_string($conn, $_POST['user_phone_number']);
    $vehicles_model = mysqli_real_escape_string($conn, $_POST['vehicles_model']);
    $vehicles_licence_plate = mysqli_real_escape_string($conn, $_POST['vehicles_licence_plate']);
    $vehicles_status = mysqli_real_escape_string($conn, $_POST['vehicles_status']);
    $user_station = 'polymorfer';
    $user_role = 'driver';
    $user_status = 'Activated';
    $password = mysqli_real_escape_string($conn, $randomString);

    if (
        $user_first_name == NULL || $user_middle_name == NULL || $user_last_name == NULL
        || $user_email == NULL || $user_phone_number == NULL || $vehicles_model == NULL || $vehicles_licence_plate == NULL
    ) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }

    $query_e = "SELECT * FROM `user` WHERE user_email ='$user_email'";
    $result = mysqli_query($conn, $query_e);
    if (mysqli_num_rows($result) > 0) { {
            $res = [
                'status' => 422,
                'message' => 'User already Exist with this email'
            ];
            echo json_encode($res);
            return false;
        }
    }

    $query = "INSERT INTO vehicles(driver_first_name,driver_middle_name, driver_last_name, driver_email, driver_phone,vehicles_model,vehicles_licence_plate,status,seat)
VALUES ('$user_first_name','$user_middle_name','$user_last_name','$user_email','$user_phone_number','$vehicles_model','$vehicles_licence_plate','$vehicles_status',35)";
    $query_run = mysqli_query($conn, $query);

    $sql = "INSERT INTO user(user_first_name, user_middle_name, user_last_name, user_email,admin_station,user_phone_number,user_status,user_role,password)
 VALUES ('$user_first_name','$user_middle_name','$user_last_name','$user_email','$user_station','$user_phone_number','$user_status','$user_role','$password')";
    $sql_run = mysqli_query($conn, $sql);


    if ($query_run && $sql) {


        $to = $user_email;
        $subject = "Ethio Tavel";
        $message = "Here is your Password: " . $password;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers = "Content-type:text/text/html;charset=UTF-8" . "\r\n";
        $headers = 'From: ebisagirma41@gmail.com' . "\r\n";

        mail($to, $subject, $message, $headers);


        $res = [
            'status' => 200,
            'message' => 'Vehicle Created Successfully',
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Vehicle Not Created'
        ];
        echo json_encode($res);
        return false;
    }
};


// To update vehicles information
if (isset($_POST['update_vehicles'])) {
    $vehicles_id = mysqli_real_escape_string($conn, $_POST['vehicles_id']);
    $driver_first_name = mysqli_real_escape_string($conn, $_POST['driver_first_name']);
    $driver_middle_name = mysqli_real_escape_string($conn, $_POST['driver_middle_name']);
    $driver_last_name = mysqli_real_escape_string($conn, $_POST['driver_last_name']);
    $driver_email = mysqli_real_escape_string($conn, $_POST['driver_email']);
    $driver_phone = mysqli_real_escape_string($conn, $_POST['driver_phone']);
    $vehicles_model = mysqli_real_escape_string($conn, $_POST['vehicles_model']);
    $vehicles_licence_plate = mysqli_real_escape_string($conn, $_POST['vehicles_licence_plate']);
    $vehicles_status = mysqli_real_escape_string($conn, $_POST['vehicles_status']);


    if (
        $driver_first_name == NULL || $driver_first_name == NULL || $driver_last_name == NULL|| $driver_middle_name == NULL
        || $driver_email == NULL || $driver_phone == NULL || $vehicles_model == NULL || $vehicles_licence_plate == NULL
    ) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
        $query_of_u = "UPDATE user SET user_first_name='$driver_first_name',user_middle_name='$driver_middle_name',user_last_name='$driver_last_name',user_phone_number='$driver_phone' WHERE user_email='$driver_email'";
    $query_of_urun = mysqli_query($conn, $query_of_u);

        $query = "UPDATE vehicles SET driver_first_name='$driver_first_name',driver_middle_name='$driver_middle_name',driver_last_name='$driver_last_name',driver_email='$driver_email', driver_phone='$driver_phone', vehicles_model='$vehicles_model',vehicles_licence_plate='$vehicles_licence_plate', status='$vehicles_status' WHERE vehicles_id='$vehicles_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Vehicles Updated Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Vehicles Not Updated'
        ];
        echo json_encode($res);
        return false;
    }
}


// To delete Vehicles from the list
if (isset($_POST['delete_vehicles'])) {
    $vehicles_id = mysqli_real_escape_string($conn, $_POST['vehicles_id']);

    $driver_uname = "SELECT * FROM vehicles WHERE vehicles_id = '$vehicles_id'";
    $driver_uname_query = mysqli_query($conn, $driver_uname);
    $driver = mysqli_fetch_array($driver_uname_query);


    $user_name = $driver['driver_email'];
    $query_del = "DELETE FROM user WHERE user_email='$user_name'";
    $query_run = mysqli_query($conn, $query_del);

    $query = "DELETE FROM vehicles WHERE vehicles_id='$vehicles_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Vehicle Deletd Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Vehicle Not Deleted'
        ];
        echo json_encode($res);
        return false;
    }
}
