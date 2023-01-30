<?php

session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == TRUE) {
    $log_in_status = "log out" ;
    $login_directory = "./logout.php";
    
} else {
    $log_in_status = "log in";
    $login_directory = "./login.php";
    echo "<script>" . "window.location.href='./game-list-message.php'" . "</script>";

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
   


      if($stmt->rowCount() > 0){
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

    } else {


    }

   

    include './inc/header.php';
  ?>


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
        <tbody id="my-table">
        </tbody>
     </table>
    </div>
    <script>
        let navSelector = document.querySelector("#nav-item-two")
        navSelector.className = "nav-item active";

    let gameData = ''
    gameData = JSON.parse('<?= json_encode($games_arr); ?>')
    for ( i = 0 ; i < gameData.length ; i++){
    let table = document.getElementById('my-table')
    let row = table.insertRow(i)
    let cellOne = row.insertCell(0)
     let imgElement = document.createElement('img')
     imgElement.setAttribute('src',gameData[i].picture_path)
       cellOne.appendChild(imgElement)
    let cellTwo = row.insertCell(1)
    cellTwo.innerHTML = gameData[i].rank
    let cellThree = row.insertCell(2)
    cellThree.innerHTML = gameData[i].title
    let cellFour = row.insertCell(3)
    cellFour.innerHTML = gameData[i].release_date
    let cellFive = row.insertCell(4)
     let starIcon = document.createElement('i')
     starIcon.className = "fa-solid fa-star"  //comparison operator is needed here to choose between the different types of star
    cellFive.innerHTML = gameData[i].metascore + '  '
    cellFive.appendChild(starIcon)


  }

</script>
<?php include './inc/footer.php' ?>

