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
    
    global  $pdo_connection, $game_name, $game_director, $game_publisher, $game_designer, $game_writer, $game_developer, $game_picture_path;
  
    $game_id = rand(1,4);
    $sql_query_by_id = "SELECT * FROM games WHERE id = :id";
    $stmt = $pdo_connection->prepare($sql_query_by_id);
    $stmt->execute(['id' => $game_id]);
   
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $game_name = $row['name'];
    $game_director = $row['director'];
    $game_publisher = $row['publisher'];
    $game_designer = $row['designer'];
    $game_writer = $row['writer'];
    $game_developer = $row['developer'];
    $game_picture_path = $row['picture_path'];

    }


    //Get game  
    $game_query = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $game_query = $_POST['search_query'];
       $sql_query_by_name = "SELECT * FROM games WHERE name = :name";
       $stmt = $pdo_connection->prepare($sql_query_by_name);
       $stmt->execute(['name' => $game_query]);
        if($stmt->rowcount() > 0){
        
               $row = $stmt->fetch(PDO::FETCH_ASSOC);

               $game_name = $row['name'];
               $game_director = $row['director'];
               $game_publisher = $row['publisher'];
               $game_designer = $row['designer'];
               $game_writer = $row['writer'];
               $game_developer = $row['developer'];
               $game_picture_path = $row['picture_path'];

          } else {

                echo "<script>" . "alert('Game not found');" . "</script>";

                return_random_game();
         }
     
    }  else {

        return_random_game();

    }
    
  ?>

<?php include './inc/header.php' ?>
    <section class="game-details pb-3">
    <div class="container d-flex justify-content-center">
        <form class="search-input-wrapper ms-5 pt-5" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
            <input class="search-input form-control" type="text" name="search_query" placeholder="Look up a game..." value="" />
            <input class="btn btn-primary" type="submit" value="Search"/>
        </form>
    </div>
    <div class="container d-flex justify-content-center mt-5 pt-5">
    <img class="framed" src=<?= $game_picture_path?> alt="random image">
    </div>
    <div class="text-center pt-5 fs-1 mt-5 fw-semibold"><p><?= $game_name ?></p></div>
    <div class="container mt-5 pt-5">
        <ul class="pe-3 pt-2">  
            <li>
                <span class="title">Director</span>
                <span class="name"><?= $game_director?></span>
            </li>
            <li>
                <span class="title">Designer</span>
                <span class="name"><?= $game_designer?></span>
            </li>
            <li>
                <span class="title">Writer</span>
                <span class="name"><?= $game_writer?></span>
            </li>
            <li>
                <span class="title">Publisher</span>
                <span class="name"><?= $game_publisher?></span>
            </li>
            <li>
                <span class="title">Developer</span>
                <span class="name"><?= $game_developer?></span>
            </li>
        </ul>
    </div>
    <?php  
     // On submission, insert user's ID into the userid column, the game ID into the gameid column of the game list table. Also, "title", "release date" and "metascore" should also be added to the game list table from the games table
     // But first, how can I grab data from another table and add it to a new table?
     // use "gameid" foreign key to add data to 3 columns in the game_lists table
    ?>
    <div class="btn-wrapper container d-flex justify-content-center mt-5">
    <button class="btn btn-primary" type="submit">Add game to your list</button>
    </div>
</section>
<section class="comments">
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
    </section>
    <script>
        let navSelector = document.querySelector("#nav-item-one")
        navSelector.className = "nav-item active";
    </script>
<?php include './inc/footer.php' ?>


<!-- Current step:
      1- Create "add game to your list" functionality
         D- Allow users to add games to their list
     2- Create the commenting functionality
     3- Can you connect this webapp to an API?


      - (optional): Allow users to rank their games on their game list
      - (optional): Allow users to rank their games on their game list
      - (optional): Clean up the "Get game" code by looping through two arrays at once
      - (optional): Recreate the pop ups and notifications with AlpineJS
      - (optional): Add approximate string matching to your search function  
      - (optional): Try to recreate the nav menu with fontawesome latest version and Alpine JS after you're finished with the other parts 
      - (optional): Re-center the "Welcome" message
      - (optinoal): Use confirmationation for logging out
-->


