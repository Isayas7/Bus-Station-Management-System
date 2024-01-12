<?php
require '../model/dbcon.php';

if (isset($_GET['user_email'])) {
    $user_email = mysqli_real_escape_string($conn, $_GET['user_email']);

    $query = "SELECT * FROM user WHERE user_email ='$user_email'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $user = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'User Fetch Successfully by id',
            'data' => $user
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 404,
            'message' => 'User Id not found'
        ];
        echo json_encode($res);
        return false;
    }
}



if (isset($_POST['change_field'])) {
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $user_first_name = mysqli_real_escape_string($conn, $_POST['profile_first_name']);
    $user_middle_name = mysqli_real_escape_string($conn, $_POST['profile_middle_name']);
    $user_last_name = mysqli_real_escape_string($conn, $_POST['profile_last_name']);
    $user_phone_number = mysqli_real_escape_string($conn, $_POST['profile_phone_number']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (
        $user_first_name == NULL ||  $user_middle_name == NULL
        || $user_last_name == NULL || $user_phone_number == NULL|| $password==NULL
    ) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }

    $query = "SELECT * FROM `user` WHERE user_email ='$user_email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_array($result);

        if ($user['password'] == ($password)) {

            $query = "UPDATE user SET user_first_name='$user_first_name',user_middle_name='$user_middle_name',user_last_name='$user_last_name',user_phone_number='$user_phone_number' WHERE user_email='$user_email'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                $res = [
                    'status' => 200,
                    'message' => 'Your Info Updated Successfully'
                ];
                echo json_encode($res);
                return false;
            } else {
                $res = [
                    'status' => 500,
                    'message' => 'Not Updated'
                ];
                echo json_encode($res);
                return false;
            }
        }else{
            $res = [
                'status' => 422,
                'message' => 'Incorrect password'
            ];
            echo json_encode($res);
            return false;
        }
    }
}


if (isset($_POST['change_password'])) {
    $c_password = mysqli_real_escape_string($conn, $_POST['c_password']);
    $n_password = mysqli_real_escape_string($conn, $_POST['n_password']);
    $co_password = mysqli_real_escape_string($conn, $_POST['co_password']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
  
    if($n_password!=$co_password){
        $res = [
            'status' => 422,
            'message' => 'Password Does not Match'
        ];
        echo json_encode($res);
        return false;
    }

    if ($c_password == NULL ||  $n_password == NULL|| $co_password == NULL ) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }

    $query = "SELECT * FROM `user` WHERE user_email ='$user_email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_array($result);
        if ($user['password'] == ($c_password)) {

            $query = "UPDATE user SET password='$n_password' WHERE user_email='$user_email'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                $res = [
                    'status' => 200,
                    'message' => 'Password Updated Successfully'
                ];
                echo json_encode($res);
                return false;
            } else {
                $res = [
                    'status' => 500,
                    'message' => 'Not Updated'
                ];
                echo json_encode($res);
                return false;
            }
        }else{
            $res = [
                'status' => 422,
                'message' => 'Incorrect password'
            ];
            echo json_encode($res);
            return false;
        }
    }
}
