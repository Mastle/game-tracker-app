<?php

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION ["loggedin"] == TRUE){
  echo "<script>" . "window.location.href='./'" . "</script>";
    
} else {

  $log_in_status = "log in";
  $login_directory = "./login.php";


}

include_once "./config/Database.php";
$pdo_obj = new Database();
$pdo_connection = $pdo_obj->connect();


$user_login_err = $user_password_err = $login_err = "";
$user_login = $user_password = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty(trim($_POST["user_login"]))) {
    $user_login_err = "Please enter your username or an email id.";
  } else {
    $user_login = trim($_POST["user_login"]);
  }
 
  if (empty(trim($_POST["user_password"]))) {
    $user_password_err = "please enter your password.";
  } else {
    $user_password = trim($_POST["user_password"]);
  }



if (empty($user_login_err) && empty($user_password_err)) {
    $sql_query = "SELECT id, username, password FROM users WHERE username = :username OR email = :email";
    $stmt = $pdo_connection->prepare($sql_query);

    if($stmt->execute(['username' => $user_login, 'email' => $user_login])){
                
        if($stmt->rowCount() == 1){
            $stmt->bindColumn('id', $id);
            $stmt->bindColumn('username', $username);
            $stmt->bindColumn('password', $hashed_password);
            if($stmt->fetch(PDO::FETCH_BOUND)){
                if (password_verify($user_password, $hashed_password)){
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;
                    $_SESSION["loggedin"] = TRUE;

                    echo "<script>" . "alert('You have Logged in successfully');" . "</script>";

                    echo "<script>" . "window.location.href='./'" . "</script>";
                    exit;
                } else {
                    $login_err = "The email or password you entere is incorrect.";
                }

            }

        } else {
            $login_err = "Invalid uername or password.";
        }
    }


}else {
    echo "<script>" . "alert('Oops! Something went wrong. Please try again later.');" . "</script>";
    echo "<script>" . "window.location.href='./login.php'" . "</script>";
    exit;
  }


}

include './inc/header.php'
?>

<div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-lg-5">
                <div class="form-wrap border rounded p-4">
                <?php
                   if (!empty($login_err)) {
                         echo "<div class='alert alert-danger'>" . $login_err . "</div>";
                       }
                       ?>
                    <h1>Log In</h1>
                    <p>Please login to continue</p>
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                        <div class="mb-3">
                            <label for="user_login" class="form-label">Email or Username</label>
                            <input type="text" class="form-control" name="user_login" id="user_login" value="<?= $user_login; ?>" >
                            <small class="text-danger"><?= $user_login_err; ?></small>
                        </div>
                        <div class="mb-2">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="user_password" id="password">
                            <small class="text-danger"><?= $user_password_err; ?></small>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="togglePassword">
                            <label for="togglePassword" class="form-check-label">Show Password</label>
                          </div>
                          <div class="mb-3">
                            <input type="submit" class="btn btn-primary form-control" name="submit" value="Log In">
                          </div>
                          <p class="mb-0">Don't have an account ? <a href="./register.php">Sign Up</a></p>
                        </form>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let navSelector = document.querySelector("#nav-item-three")
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

