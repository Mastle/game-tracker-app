<?php 
    if (isset($_SESSION["loggedin"]) && $_SESSION ["loggedin"] == TRUE){
        echo "<script>" . "window.location.href='./'" . "</script>";
          
      } else {
      
        $log_in_status = "log in";
        $login_directory = "./login.php";
      
       }
       
       include './inc/header.php'
       ?>
      <div class="container  min-vh-100 text-center d-flex justify-content-center align-items-center pb-5">
      <h1><a href='./login.php'>Log in</a> to create your game list</h1>
      </div>
      <script>
            let navSelector = document.querySelector("#nav-item-two")
            navSelector.className = "nav-item active";
      </script>
<?php include './inc/footer.php' ?>
