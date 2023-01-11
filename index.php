<?php include './inc/header.php' ?>
    <section class="game-details pb-3">
    <div class="container d-flex justify-content-center">
        <form class="search-input-wrapper ms-5 pt-5"action="search.php" method="GET">
            <input class="search-input form-control" type="text" name="search_query" placeholder="Look up a game..." />
            <input class="btn btn-primary" type="submit" value="Search" />
        </form>
    </div>
    <div class="container d-flex justify-content-center mt-5 pt-5">
    <img class="framed" src="./assets/mock-game-image-1.jpg" alt="random image">
    </div>
    <div class="container mt-5 pt-5">
        <ul class="pe-3 pt-2">  
            <li>
                <span class="title">Director</span>
                <span class="name">James</span>
            </li>
            <li>
                <span class="title">Publisher</span>
                <span class="name">Lauren</span>
            </li>
            <li>
                <span class="title">Designer</span>
                <span class="name">Marcus</span>
            </li>
            <li>
                <span class="title">Writer</span>
                <span class="name">Bryan</span>
            </li>
            <li>
                <span class="title">Developer</span>
                <span class="name">James</span>
            </li>
        </ul>
    </div>
    <div class="btn-wrapper container d-flex justify-content-center mt-5">
    <button class="btn btn-primary" type="submit">Add game to your list</button>
    </div>
    <!-- Looking ahead: Create a function that displays a random game when a user visits the website for the first time -->
</section>
  <!-- will edit the comment section once there is an actual comment system-->
<section class="comments">
    <div class="ms-2 mt-3">
    <i class="fa-regular fa-comments fa-2xl"></i>
    <h3 class="d-inline">Comments</h2>
    </div>
    <div class="container  my-3">
    <div class="comment mx-2 py-2">
        <img src="assets/stock-user-pic-1.jpg" alt="">
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
        <img src="assets/stock-user-pic-1.jpg" alt="">
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
        <img src="assets/stock-user-pic-1.jpg" alt="">
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
      1- Design your database
          A- Forget about comments, make sure every user can add the games to their list of favorite games 
          B- then add the comments table to your database
      2- Watch a brad video on SQL
      3- review your database
      4- implement the  first version of the database
      5- Create the log in system <--
      6- Create "add game to your list" functionality
      7- Upgrade the database
-->


