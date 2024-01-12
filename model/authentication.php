<?php
session_start();
require '../model/dbcon.php';
// user id generation
// TO save user information
if (isset($_POST['authenticate_user'])) {
    $_user_name = mysqli_real_escape_string($conn, $_POST['_user_name']);
    $_password = mysqli_real_escape_string($conn, $_POST['_password']);
    if (
        $_user_name == NULL || $_password == NULL
    ) {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }
    $query = "SELECT * FROM `user` WHERE user_email ='$_user_name'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_array($result);

        if ($user['password'] == ($_password)) {
            $_SESSION["logedin"] = true;
            $res = [
                'status' => 200,
                'message' => 'user Logedin Successfully',
                'data' => $user
            ];

            echo json_encode($res);
            return false;
        } else {
            $res = [
                'status' => 422,
                'message' => 'Incorrect Password'
            ];
            echo json_encode($res);
            return false;
        }
    } else {
        $res = [
            'status' => 500,
            'message' => 'This Email does not exist'
        ];
        echo json_encode($res);
        return false;
    }
};
if (isset($_POST['logout_button'])) {
    session_destroy();
};
