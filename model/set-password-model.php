<?php
require '../model/dbcon.php';
$user_email=$_GET['user_email'];

if (isset($_POST['update_password'])) {
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

if($new_password!=$confirm_password){
    $res = [
        'status' => 422,
        'message' => 'Password does not match!',
    ];
    echo json_encode($res);
    return false;
}
$query = "UPDATE user SET password='$new_password' WHERE user_email='$user_email'";
$query_run = mysqli_query($conn, $query);

if ($query_run) {
    $query_u = "SELECT * FROM `user` WHERE user_email ='$user_email'";
    $result = mysqli_query($conn, $query_u);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_array($result);
            $_SESSION["logedin"] = true;
            $res = [
                'status' => 200,
                'message' => 'user Logedin Successfully',
                'data' => $user
            ];

            echo json_encode($res);
            return false;
    }
} else {
    $res = [
        'status' => 500,
        'message' => 'Password Not Updated'
    ];
    echo json_encode($res);
    return false;
}
}

?>
