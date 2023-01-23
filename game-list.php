<?php

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == TRUE) {
    $log_in_status = "log out" ;
    $login_directory = "./logout.php";
    
} else {
    $log_in_status = "log in";
    $login_directory = "./login.php";
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
            <tr>
                <td><img  src="./assets/mock-game-image-1.jpg" alt=""></td>
                <td>1</td>
                <td>Metro: Exodus</td>
                <td>12/12/2012</td>
                <td ><i class="fa-solid fa-star"></i>100%</td>
            </tr>
            <tr>
                <td><img  src="./assets/mock-game-image-1.jpg" alt=""></td>
                <td>1</td>
                <td>Metro: Exodus</td>
                <td>12/12/2012</td>
                <td ><i class="fa-solid fa-star"></i>100%</td>
            </tr>
            <tr>
                <td><img  src="./assets/mock-game-image-1.jpg" alt=""></td>
                <td>1</td>
                <td>Metro: Exodus</td>
                <td>12/12/2012</td>
                <td ><i class="fa-solid fa-star"></i>100%</td>
            </tr>
            <tr>
                <td><img  src="./assets/mock-game-image-1.jpg" alt=""></td>
                <td>1</td>
                <td>Metro: Exodus</td>
                <td>12/12/2012</td>
                <td ><i class="fa-solid fa-star"></i>100%</td>
            </tr>
            <tr>
                <td><img  src="./assets/mock-game-image-1.jpg" alt=""></td>
                <td>1</td>
                <td>Metro: Exodus</td>
                <td>12/12/2012</td>
                <td ><i class="fa-solid fa-star"></i>100%</td>
            </tr>
         </tbody>
     </table>
    </div>
    <script>
        let navSelector = document.querySelector("#nav-item-two")
        navSelector.className = "nav-item active";
    </script>
<?php include './inc/footer.php' ?>
