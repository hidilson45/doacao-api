<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../class/coments.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new Comments($db);
    $stmt = $items->getComments();
    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);
    if($itemCount > 0){
        
        $eventArr = array();
        $eventArr["body"] = array();
        $eventArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "event_id" => $event_id,
                "user_id" => $user_id,
                "content" => $content
            );
            array_push($eventArr["body"], $e);
        }
        echo json_encode($eventArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
