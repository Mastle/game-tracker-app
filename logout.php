<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    echo "<script>" . "alert('You have successfully logged out!')" . "</script>";
    echo "<script>" . "window.location.href='./index.php'" . "</script>";

    ?>


