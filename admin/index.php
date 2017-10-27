<?php
session_start();
include('../includes/config.php');
include('../includes/db.php');
?>
<html>
    <body>
        <?php
        $error_alert = '';
        $error_username = '';
        $error_pwd = '';

        if (isset($_COOKIE['cookname']) || isset($_SESSION['username'])) {
            if (isset($_COOKIE['cookname'])) {
                $_SESSION['username'] = $_COOKIE['cookname'];
                $_SESSION['password'] = $_COOKIE['cookpass'];
                $_SESSION['id'] = $_COOKIE['cookid'];
                $_SESSION['type'] = $_COOKIE['cooktype'];
            }

            $username = $_SESSION['username'];
            $password = $_SESSION['password'];

            $result = $mysqli->query("SELECT * FROM `users` WHERE `username` = '$username'") or die($mysqli->error);
            $rows = $result->fetch_array();

            if (($rows["username"] == $username) && ($rows["password"] == $password)) {
                if (is_admin()) {
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=member.php">';
                    exit;
                } else {
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=checklogin.php">';
                    exit;
                }
            } else {
                echo "Wrong username or password. <a href='checklogin.php'>click here</a> to login again";
            }
        } else {
            if (isset($_GET['unauthorized'])) {
                $error_alert = 'Please login to view that page!';
            }
            if (isset($_GET['timeout'])) {
                $error_alert = 'Your session has expired. Please log in again.';
            }
            include('./views/login.php');
        }
        ?>
    </body>
</html>