<?php
     session_start();

     if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == TRUE) {
        $log_in_status = "log out" ;
        $login_directory = "./logout.php";
        
    } else {
        $log_in_status = "log in";
        $login_directory = "./login.php";
    }
    include './inc/header.php'
  ?>
<div class="container min-vh-100 text-center mt-4 pt-5">
<h1>About us</h1>
<p class="pt-3">Best app ever created</p>
</div>
<script>
        let navSelector = document.querySelector("#nav-item-four")
        navSelector.className = "nav-item active";

        const userPasswordEl = document.querySelector("#password")
        const togglePasswordEl = document.querySelector("#togglePassword")

        togglePasswordEl.addEventListener("click", function () {
         if (this.checked === true) {
           userPasswordEl.setAttribute("type", "text")
         } else {
           userPasswordEl.setAttribute("type", "password")
          }
         });


    </script>
<?php include './inc/footer.php' ?>
