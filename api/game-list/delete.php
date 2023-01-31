<?php 
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: DELETE');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

 include_once '../../config/Database.php';
 $pdo_obj = new Database();
 $pdo_connection = $pdo_obj->connect();


 $data = json_decode(file_get_contents("php://input"));

 $received_game_id = $data->gameid;


 $sql_query = "DELETE FROM game_lists WHERE game_lists.id = :gameid;";
 $stmt = $pdo_connection->prepare($sql_query);

 if($stmt->execute(['gameid' => $received_game_id])){
    echo json_encode(
        array('message' => 'Game successfully deleted')
      );
 } else {
    echo json_encode(
        array('message' => 'Failed to delete game from list')
      );
 }




 