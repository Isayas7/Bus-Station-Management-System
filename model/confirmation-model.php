<?php
$confirmation =  $_GET['confirmation'];
if (isset($_POST['confirm_user'])) {

   $confirmation_code =  $_POST['confirmation_code'];
    if ($confirmation_code == NULL) {
        $res = [
            'status' => 422,
            'message' => 'The fields is empity'
        ];
        echo json_encode($res);
        return false;
    }
  $get_confirmed=true;
  if ($confirmation_code ==$confirmation) {
            $res = [
                'status' => 200,
                'message' => 'user Logedin Successfully',
                'data' => $get_confirmed
            ];
            echo json_encode($res);
            return false;
        } else {
            $res = [
                'status' => 422,
                'message' => 'Wrong Code'
            ];
            echo json_encode($res);
            return false;
        }
    } 
