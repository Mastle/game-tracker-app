<?php

     session_start();
    // Check and see if user is logged in
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == TRUE) {
        $log_in_status = "log out" ;
        $login_directory = "./logout.php";
        
    } else {
        $log_in_status = "log in";
        $login_directory = "./login.php";
    }



    //Get game  
    $game_query = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $game_query = $_POST['search_query'];
       echo $game_query;
    }






   include_once "./config/Database.php";
   $pdo_obj = new Database();
   $pdo_connection = $pdo_obj->connect();
   $sql_query = "SELECT * FROM games WHERE name = 'World of Warcraft'";
   $stmt = $pdo_connection->prepare($sql_query);
   $stmt->execute();

   $row = $stmt->fetch(PDO::FETCH_ASSOC);


    $game_id = $row['id'];
    $game_name = $row['name'];
    $game_director = $row['director'];
    $game_publisher = $row['publisher'];
    $game_designer = $row['designer'];
    $game_writer = $row['writer'];
    $game_developer = $row['developer'];
    $game_picture_path = $row['picture_path'];
    
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
    <div class="text-center pt-5 fs-1 mt-5 fw-semibold"><p><?= $game_name?></p></div>
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
        -> B- Create the search function
         C- Create the "game list" table
         D- Allow users to add games to their list
     2- Create the commenting functionality



      - (optional): Try to recreate the nav menu with fontawesome latest version and Alpine JS after you're finished with the other parts 
      - (optional): Create a function that displays a random game when a user visits the website for the first time(random number generator)
      - (optional): Re-center the "Welcome" message
      - (optinoal): Use a confirmation box before logging out
-->


