<?php 
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: PUT');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

 include_once '../../config/Database.php';
 $pdo_obj = new Database();
 $pdo_connection = $pdo_obj->connect();


 $data = json_decode(file_get_contents("php://input"));

 $received_game_id = $data->gameid;
 $received_user_id = $data->userid;


 $sql_query = "INSERT INTO `game_lists` SET userid = :userid, gameid = :gameid;";
 $stmt = $pdo_connection->prepare($sql_query);

 if($stmt->execute(['userid' => $received_user_id, 'gameid' => $received_game_id])){
    echo json_encode(
        array('message' => 'Game successfully added to list')
      );
 } else {
    echo json_encode(
        array('message' => 'Failed to add game to the list')
      );
 }

 