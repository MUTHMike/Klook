<?php

session_start();
include ('../includes/config.php');
include ('../includes/db.php');

if (!isset($_COOKIE['cookname'])) {

    if (!isset($_SESSION['username'])) {
        header("Location: checklogin.php?unauthorized");
    }
    if (time() > $_SESSION['last_active'] + $config['session_timeout']) { // log out user
        session_destroy();
        header("Location: checklogin.php?timeout");
    } else {
        $_SESSION['last_active'] = time();
    }
} 
?>