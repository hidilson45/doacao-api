<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../../config/database.php';
    include_once '../../class/user.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new User($db);
    $data = json_decode(file_get_contents("php://input"));

if(!empty($data->email)){
    $item->email = $data->email;
    $user = $item->getSingleEmployee();

    if($user){
        $user_arr = array(
            "id" => $user['id'],
            "name" => $user['name'],
            "email" => $user['email'],
            "designation" => $user['designation']
        );

        http_response_code(200);
        echo json_encode($user_arr);
    } else {
        http_response_code(404);
        echo json_encode("User not found .");
    }
} else {
    http_response_code(400);
    echo json_encode("Invalid request. Please provide an email.");
}
?>