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
        $games_arr = '';


    }

   

    include './inc/header.php';
  ?>
  <script defer src="./scripts/updateGameList.js"></script>
   <section class="min-vh-100">
   <h1 class="ms-5 mt-3" style="color: var(--han-blue)" onclick=runReload()>Your Game List</h1>
    <div class="container mt-5 d-flex justify-content-center position-relative">
     <table class="content-table">
        <thead id="my-table-head">
        </thead>
        <tbody id="my-table-body">
        </tbody>
     </table>
    </div>
    </section>
    <script>
        let navSelector = document.querySelector("#nav-item-two")
        navSelector.className = "nav-item active";

    let gameData = ''
    gameData = JSON.parse('<?= json_encode($games_arr); ?>')
    if(gameData.length > 0){
      
           
  
           let table = document.getElementById('my-table-head')
           let row = table.insertRow(0)
           let cellOne = row.insertCell(0)
           cellOne.outerHTML = '<th></th>';
           let cellTwo = row.insertCell(1)
           cellTwo.outerHTML = '<th>Rank</th>'
           let cellThree = row.insertCell(2)
           cellThree.outerHTML = '<th>Title</th>'
           let cellFour = row.insertCell(3)
           cellFour.outerHTML = '<th>Release date</th>'
           let cellFive = row.insertCell(4)
           cellFive.outerHTML = '<th>Metascore</th>'
         

      for ( i = 0 ; i < gameData.length ; i++){
           let table = document.getElementById('my-table-body')
           let row = table.insertRow(i)
               row.setAttribute('value',gameData[i].id)
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
            starIcon.className = "fa-solid fa-percent" 
           cellFive.innerHTML = gameData[i].metascore + '  '
           cellFive.appendChild(starIcon)
           let cellSix = row.insertCell(5)
            let crossIcon = document.createElement('i')
            crossIcon.className = "fa-solid fa-times" 
            crossIcon.setAttribute('onclick','deleteGame(this)')
            crossIcon.style = 'cursor: pointer'
           cellSix.innerHTML = '  '
           cellSix.appendChild(crossIcon)
     } 
       } else {

            let newPara = document.createElement('p')
            newPara.className = 'position-absolute fs-3'
            newPara.innerHTML = 'No games found. Try adding some to your list!'
            let tableSelector = document.querySelector('table')
            let divSelector = document.querySelector('.container')
            divSelector.insertBefore(newPara, tableSelector)
     }


</script>
<?php include './inc/footer.php' ?>

