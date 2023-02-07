<?php
session_start();

include_once "./config/Database.php";


$pdo_obj = new Database();
$pdo_connection = $pdo_obj->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $comment_body = $_POST['comment'];
    $user_id = $_SESSION["id"];
    $game_id = $_COOKIE["gameid"];

    $sql_query = "INSERT INTO comments (gameid, userid, commentbody) VALUES (:gameid, :userid, :commentbody)"; 
    $stmt = $pdo_connection->prepare($sql_query);
    if($stmt->execute(['gameid' => $game_id, 'userid' => $user_id, 'commentbody' => $comment_body])){
        echo "<script>" . "window.location.href='./'" . "</script>";
    } else {
        echo "<script>" . "alert('error')" . "</script>";

    }


}   

    ?>


