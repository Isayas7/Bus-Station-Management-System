<?php

require '../model/dbcon.php';


// Traffic id generation

if (isset($_GET['user_id'])) {
    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);

    $query = "SELECT * FROM user WHERE user_id ='$user_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $user = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Traffic Fetch Successfully by id',
            'data' => $user
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Traffic Id not found'
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


// TO save admin information
if (isset($_POST['save_traffic'])) {
    $user_first_name = mysqli_real_escape_string($conn, $_POST['user_first_name']);
    $user_middle_name = mysqli_real_escape_string($conn, $_POST['user_middle_name']);
    $user_last_name = mysqli_real_escape_string($conn, $_POST['user_last_name']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $user_station = mysqli_real_escape_string($conn, $_POST['admin_station']);
    $user_phone_number = mysqli_real_escape_string($conn, $_POST['user_phone_number']);
    $user_status = mysqli_real_escape_string($conn, $_POST['user_status']);
    $user_role = 'traffic_p';
    $password = mysqli_real_escape_string($conn, $randomString);

    if (
        $user_first_name == NULL || $user_first_name == NULL || $user_middle_name == NULL
        || $user_last_name == NULL || $user_email == NULL || $user_station == NULL || $user_phone_number == NULL
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

    $query = "INSERT INTO user(user_first_name, user_middle_name, user_last_name, user_email,admin_station,user_phone_number,user_status,user_role,password)
 VALUES ('$user_first_name','$user_middle_name','$user_last_name','$user_email','$user_station','$user_phone_number','$user_status','$user_role','$password')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {

        $to = $user_email;
        $subject = "Ethio Tavel";
        $message = "Here is your Password: " . $password;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers = "Content-type:text/text/html;charset=UTF-8" . "\r\n";
        $headers = 'From: ebisagirma41@gmail.com' . "\r\n";

        mail($to, $subject, $message, $headers);

        $res = [
            'status' => 200,
            'message' => 'Traffic Created Successfully',
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Traffic Not Created'
        ];
        echo json_encode($res);
        return false;
    }
};


// To update traffic information
if (isset($_POST['update_traffic'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $user_first_name = mysqli_real_escape_string($conn, $_POST['user_first_name']);
    $user_middle_name = mysqli_real_escape_string($conn, $_POST['user_middle_name']);
    $user_last_name = mysqli_real_escape_string($conn, $_POST['user_last_name']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $user_station = mysqli_real_escape_string($conn, $_POST['admin_station']);
    $user_phone_number = mysqli_real_escape_string($conn, $_POST['user_phone_number']);
    $user_status = mysqli_real_escape_string($conn, $_POST['user_status']);


    if (
        $user_first_name == NULL || $user_first_name == NULL || $user_middle_name == NULL
        || $user_last_name == NULL || $user_email == NULL || $user_station == NULL || $user_phone_number == NULL
    ) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    $query = "UPDATE user SET user_first_name='$user_first_name',user_middle_name='$user_middle_name',user_last_name='$user_last_name', user_email='$user_email', admin_station='$user_station',user_phone_number='$user_phone_number',user_status='$user_status' WHERE user_id='$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Traffic Updated Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Traffic Not Updated'
        ];
        echo json_encode($res);
        return false;
    }
}

// To delete Traffic from the list
if (isset($_POST['delete_traffic'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "DELETE FROM user WHERE user_id='$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Traffic Deletd Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Traffic Not Deleted'
        ];
        echo json_encode($res);
        return false;
    }
}
