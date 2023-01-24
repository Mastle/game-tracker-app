<?php

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == TRUE) {
    $log_in_status = "log out" ;
    $login_directory = "./logout.php";
    
} else {
    $log_in_status = "log in";
    $login_directory = "./login.php";
}

   include_once './config/Database.php';
   $get_sesion_id = $_SESSION['id'];
   $pdo_obj = new Database();
   $pdo_connection = $pdo_obj->connect();
   
   $sql_query = "SELECT game_lists.id, game_lists.rank, games.name, games.release_date, games.metascore, games.picture_path 
   FROM game_lists 
   INNER JOIN games ON game_lists.gameid = games.id
   WHERE game_lists.userid = :session_id;";
   $stmt = $pdo_connection->prepare($sql_query);
   $stmt->execute(['session_id' => $get_sesion_id]);
   

   
     $games_arr = array();

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $game_item = array(
        'id' => $id,
        'title' => $name,
        'rank' => $rank,
        'release_date' => $release_date,
        'metascore' => $metascore,
        'picture_path' => $picture_path,
      );

   
      array_push($games_arr, $game_item);
     
    }

   


  ?>
<?php include './inc/header.php' ?>
   <h1 class="ms-5 mt-3" style="color: var(--han-blue)">Your Game List</h1>
    <div class="container mt-5 d-flex justify-content-center">
     <table class="content-table">
        <thead>
            <tr>
                <th></th>
                <th>Rank</th>
                <th>Title</th>
                <th>Release date</th>
                <th>Metascore</th>
            </tr>
        </thead>
        <tbody>
            <!-- The length of the game_arr determines the number of table rows -->
            <tr>
                <td><img  src=<?= $games_arr[0]['picture_path'] ?> alt=""></td>
                <td><?= $games_arr[0]['rank'] ?></td>
                <td><?= $games_arr[0]['title'] ?></td>
                <td><?= $games_arr[0]['release_date'] ?></td>
                <td ><i class="fa-solid fa-star"></i><?= $games_arr[0]['metascore'].'%' ?></td>
            </tr>
            <tr>
                <td><img  src=<?= $games_arr[1]['picture_path'] ?> alt=""></td>
                <td><?= $games_arr[1]['rank'] ?></td>
                <td><?= $games_arr[1]['title'] ?></td>
                <td><?= $games_arr[1]['release_date'] ?></td>
                <td ><i class="fa-solid fa-star"></i><?= $games_arr[1]['metascore'].'%' ?></td>
            </tr>
            <tr>
            <td><img  src=<?= $games_arr[2]['picture_path'] ?> alt=""></td>
                <td><?= $games_arr[2]['rank'] ?></td>
                <td><?= $games_arr[2]['title'] ?></td>
                <td><?= $games_arr[2]['release_date'] ?></td>
                <td ><i class="fa-solid fa-star"></i><?= $games_arr[2]['metascore'].'%' ?></td>
            </tr>
            <tr>
            <td><img  src=<?= $games_arr[3]['picture_path'] ?> alt=""></td>
                <td><?= $games_arr[3]['rank'] ?></td>
                <td><?= $games_arr[3]['title'] ?></td>
                <td><?= $games_arr[3]['release_date'] ?></td>
                <td ><i class="fa-solid fa-star"></i><?= $games_arr[3]['metascore'].'%' ?></td>
            </tr>
            <tr>
            <td><img  src=<?= $games_arr[4]['picture_path'] ?> alt=""></td>
                <td><?= $games_arr[4]['rank'] ?></td>
                <td><?= $games_arr[4]['title'] ?></td>
                <td><?= $games_arr[4]['release_date'] ?></td>
                <td ><i class="fa-solid fa-star"></i><?= $games_arr[4]['metascore'].'%' ?></td>
            </tr>
         </tbody>
     </table>
    </div>
    <script>
        let navSelector = document.querySelector("#nav-item-two")
        navSelector.className = "nav-item active";
    </script>
<?php include './inc/footer.php' ?>
