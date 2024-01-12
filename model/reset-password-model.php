<?php
require '../model/dbcon.php';
$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$confirmation = '';
for ($i = 0; $i < 6; $i++) {
    $confirmation .= $characters[rand(0, $charactersLength - 1)];
}
if (isset($_POST['send_confirm'])) {
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);

    $query = "SELECT * FROM user WHERE user_email ='$user_email'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) == 0) {
        $res = [
            'status' => 422,
            'message' => 'No user with this email',
        ];
        echo json_encode($res);
        return false;
    } else {

        $to = $user_email;
        $subject = "Ethio Tavel";
        $message = "Here is Confirmation Code: " . $confirmation;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers = "Content-type:text/text/html;charset=UTF-8" . "\r\n";
        $headers = 'From: ebisagirma41@gmail.com' . "\r\n";

        mail($to, $subject, $message, $headers);

        $res = [
            'status' => 200,
            'message' => $confirmation,
            'data' => $user_email,
        ];
        echo json_encode($res);
        return false;
    }
}
