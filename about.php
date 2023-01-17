<?php
// if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
//     echo "<script>" . "window.location.href='./login.php';" . "</script>";
//     exit;}
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
<div class="container min-vh-100 text-center mt-5 pt-5">
<h1>About us</h1>
<p class="pt-3">Lorem ipsum dolor sit, 
    amet consectetur adipisicing elit.
     Sunt necessitatibus est quidem hic 
     quas maiores unde expedita autem arch
     itecto blanditiis temporibus dolorem, 
     distinctio quos, nesciunt iure deserunt 
     at molestiae, cumque magnam aperiam quis.
      Ut est exercitationem sit minima repellat
       ducimus suscipit eius. Incidunt quas exerc
       itationem pariatur earum rem illo laboru
       m!</p>
</div>
<script>
        let navSelector = document.querySelector("#nav-item-four")
        navSelector.className = "nav-item active";
    </script>
<?php include './inc/footer.php' ?>
