<?php

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == TRUE) {
        $welcome_username = "Welcome ".$_SESSION["username"];
        
    } else {
        $welcome_username = "";
        
    }



?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <script defer src="./scripts/script.js"></script>
    <!-- Try to recreate the nav menu with fontawesome latest version and Alpine JS after you're finished with the other parts -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css'><link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Game Tracker</title>
</head>
<body>
    <nav class="navbar navbar-expand-custom navbar-mainbg">
        <a class="navbar-brand navbar-logo" href="#">Game Tracker</a>
        <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars text-white"></i>
        </button>
        <p class="position-absolute start-50 top-0 pt-3 fs-5 fw-semibold text-light" id="welcome-message"><?= $welcome_username?></p>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
                <li class="nav-item" id="nav-item-one">
                    <a class="nav-link" href="./index.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                </li>
                <li class="nav-item " id="nav-item-two">
                    <a class="nav-link" href="./game-list.php"><i class="fa fa-gamepad"></i>Game List</a>
                </li>
                <li class="nav-item" id="nav-item-three">
                    <a class="nav-link" href=<?php echo $login_directory?>><i class="fa fa-user" aria-hidden="true"></i>
                    <?= $log_in_status ?></a>
                </li>
                <li class="nav-item" id="nav-item-four">
                    <a class="nav-link" href="./about.php"><i class="fa fa-info"></i>About</a>
                </li>
            </ul>
        </div>
    </nav>

