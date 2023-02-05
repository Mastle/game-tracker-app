<?php

 session_start();
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == TRUE) {
        $log_in_status = "log out" ;
        $login_directory = "./logout.php";
        
    } else {
        $log_in_status = "log in";
        $login_directory = "./login.php";
    }

    include_once "./config/Database.php";
    $pdo_obj = new Database();
    $pdo_connection = $pdo_obj->connect();
     

    function return_random_game(){
    
    global  $pdo_connection, $game_id;
  
    $game_id = rand(1,4);
    $sql_query_by_id = "SELECT * FROM games WHERE id = :id";
    $stmt = $pdo_connection->prepare($sql_query_by_id);
    $stmt->execute(['id' => $game_id]);


        global $game_item;
    

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $game_item = array(
        'id' => $id,
        'title' => $name,
        'release_date' => $release_date,
        'metascore' => $metascore,
        'director' => $director,
        'designer' => $designer,
        'publisher' => $publisher,
         'writer' => $writer,
        'developer' => $developer,
        'picture_path' => $picture_path,
      );

        
    }



    }


    //Get game  
    $game_query = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_query'])) {
       $game_query = $_POST['search_query'];
       $sql_query_by_name = "SELECT * FROM games WHERE name = :name";
       $stmt = $pdo_connection->prepare($sql_query_by_name);
       $stmt->execute(['name' => $game_query]);
       if($stmt->rowcount() > 0){
        
              
         while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
           extract($row);
  
           $game_item = array(
             'id' => $id,
             'title' => $name,
             'release_date' => $release_date,
             'metascore' => $metascore,
              'designer' => $designer,
              'director' => $director,
             'publisher' => $publisher,
              'writer' => $writer,
             'developer' => $developer,
             'picture_path' => $picture_path,
           );
  
          
            }

            global $game_id;
            $game_id = $game_item['id'];



          } else {

                echo "<script>" . "alert('Game not found');" . "</script>";

                return_random_game();
           }
     
      }  else {
  
          return_random_game();
  
      }

    include './inc/header.php'
  ?>
    <section class="game-details pb-3">
    <div class="container d-flex justify-content-center">
        <form class="search-input-wrapper ms-5 pt-5" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
            <input class="search-input form-control" type="text" name="search_query" placeholder="Look up a game..." value="" />
            <input class="btn btn-primary" type="submit" value="Search"/>
        </form>
    </div>
    <div class="container d-flex justify-content-center mt-5 pt-5">
    <img class="framed" src=<?= $game_item['picture_path']?> alt="random image">
    </div>
    <div class="text-center pt-5 fs-1 mt-5 fw-semibold"><p><?= $game_item['title'] ?></p></div>
    <div class="container mt-5 pt-5">
        <ul class="pe-3 pt-2 text-center">  
            <li>
                <span class="title">Director</span>
                <span class="name"><?= $game_item['director']?></span>
            </li>
            <li>
                <span class="title">Designer</span>
                <span class="name"><?= $game_item['designer']?></span>
            </li>
            <li>
                <span class="title">Writer</span>
                <span class="name"><?= $game_item['writer']?></span>
            </li>
            <li>
                <span class="title">Publisher</span>
                <span class="name"><?= $game_item['publisher']?></span>
            </li>
            <li>
                <span class="title">Developer</span>
                <span class="name"><?= $game_item['developer']?></span>
            </li>
        </ul>
    </div>
    <div class="btn-wrapper container d-flex justify-content-center my-5">
    <input type="hidden" id="game-id-holder" value="<?= (isset($game_id)) ? $game_id : $game_item['id'] ?>" />
    <input type="hidden" id="user-id-holder" value="<?= (isset($_SESSION['id'])) ? $_SESSION['id'] : 0 ?>" />
    <input class="btn btn-primary" type="submit" value='Add game to your list' onclick=addGameToList()></input>
    </div>
    </form>
</section>
<?php 
 $sql_query_by_id = "SELECT * FROM comments WHERE gameid = :id";
 $stmt = $pdo_connection->prepare($sql_query_by_id);
 $stmt->execute(['id' => $game_id]);

 
 $comments_arr = array();
   while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   extract($row);
   $comment_item = array(
     'id' => $id,
     'gameid' => $gameid,
     'userid' => $userid,
     'commentbody' => $commentbody,
   );

   array_push($comments_arr, $comment_item);

 }
  



 $sql_query_by_id = "SELECT * FROM users WHERE id = :id";
 $stmt = $pdo_connection->prepare($sql_query_by_id);
 $users_arr = array();

  for($i=0;$i < count($comments_arr) ; $i++){


 $stmt->execute(['id' => $comments_arr[$i]['userid']]);
 while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
 
    $user_item = array(
      'id' => $id,
      'username' => $username,
    );
    array_push($users_arr, $user_item);
    
}
}

?>

<p><?= $users_arr[0]['username'] ?></p>
<br>
<p><?= $comments_arr[0]['id']?></p>
<br>
<p><?= $comments_arr[0]['gameid']?></p>
<br>
<p><?= $comments_arr[0]['commentbody']?></p>
<p><?= $users_arr[1]['username'] ?></p>
<br>
<p><?= $comments_arr[1]['id']?></p>
<br>
<p><?= $comments_arr[1]['gameid']?></p>
<br>
<p><?= $comments_arr[1]['commentbody']?></p>
<p><?= $users_arr[2]['username'] ?></p>
<br>
<p><?= $comments_arr[2]['id']?></p>
<br>
<p><?= $comments_arr[2]['gameid']?></p>
<br>
<p><?= $comments_arr[2]['commentbody']?></p>



<!-- If the comment object is empty, hide comments section -->
<!-- <section class="comments">
    <div class="ms-2 mt-3">
    <i class="fa-regular fa-comments fa-2xl"></i>
    <h3 class="d-inline">Comments</h2>
    </div>
    <div class="container  my-3">
    <div class="comment mx-2 py-2">
        <img src="assets/user-profile-pics/stock-user-pic-1.jpg" alt="">
        <span class="mx-2 fw-normal" style="color:var(--han-blue)">James serevino</span>
        <i class="fa-solid fa-star" style="color:var(--han-blue)"></i>
        <i class="fa-solid fa-star" style="color:var(--han-blue)"></i>
        <i class="fa-solid fa-star" style="color:var(--han-blue)"></i>
        <i class="fa-solid fa-star" style="color:var(--han-blue)"></i>
        <i class="fa-regular fa-star" style="color:var(--han-blue)"></i>
        <p class="fs-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus minima voluptates libero nostrum, 
            deserunt consequuntur numquam assumenda facilis ut dolores suscipit recusandae et neque, perferendis 
            repellendus magnam consectetur nemo error.
        </p>
    </div>
   </div>
   <div class="even-comment-bg-color">
   <div class="container my-3">
    <div class="comment  py-2">
        <img src="assets/user-profile-pics/stock-user-pic-1.jpg" alt="">
        <span class="mx-2">James serevino</span>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-solid fa-star"></i>
        <i class="fa-regular fa-star"></i>
        <p class="fs-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus minima voluptates libero nostrum, 
            deserunt consequuntur numquam assumenda facilis ut dolores suscipit recusandae et neque, perferendis 
            repellendus magnam consectetur nemo error.
        </p>
    </div>
    </div>
</div>
    <div class="container my-3">
    <div class="comment py-2">
        <img src="assets/user-profile-pics/stock-user-pic-1.jpg" alt="">
        <span class="mx-2" style="color:var(--han-blue)">James serevino</span>
        <i class="fa-solid fa-star" style="color:var(--han-blue)"></i>
        <i class="fa-solid fa-star" style="color:var(--han-blue)"></i>
        <i class="fa-solid fa-star" style="color:var(--han-blue)"></i>
        <i class="fa-solid fa-star" style="color:var(--han-blue)"></i>
        <i class="fa-regular fa-star" style="color:var(--han-blue)"></i>
        <p class="fs-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus minima voluptates libero nostrum, 
            deserunt consequuntur numquam assumenda facilis ut dolores suscipit recusandae et neque, perferendis 
            repellendus magnam consectetur nemo error.
        </p>
    </div>
    </div>
    </section> -->
    <script>
        let navSelector = document.querySelector("#nav-item-one")
        navSelector.className = "nav-item active";
    </script>
    <script src='./scripts/updateGameList.js'></script>
<?php include './inc/footer.php' ?>


<!-- Current step:
     

     2- Create the commenting functionality
     3- Can you connect this webapp to an API?

      - (optional): Prevent user from adding the same game twice
      - (optional): Restrict api access to your website (might be a good idea to do this after deployment)
      - (optional): Use bootstrap tables for the game details section
      - (optional): Allow users to rank their games on their game list
      - (optional): Recreate the pop ups and notifications with AlpineJS
      - (optional): Add approximate string matching to your search function  
      - (optinoal): Use confirmationation(a more sophisticated system) for logging out

    -->