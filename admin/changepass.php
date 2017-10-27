<?php
include('./session.php');

$error_alert = '';
$error_pwd = '';
$error_pwd1 = '';
$error_pwd2 = '';
$id = $_SESSION['id'];

if (isset($_POST['submit'])) {
    $current_pass = isset($_POST['current']) ? $_POST['current'] : "";
    $pwd = isset($_POST['password']) ? $_POST['password'] : "";
    $pwd2 = isset($_POST['re_password']) ? $_POST['re_password'] : "";

    if ($current_pass == '' || $pwd == '' || $pwd2 == '') {
        if ($current_pass == '') {
            $error_pwd = 'Required!';
        }
        if ($pwd == '') {
            $error_pwd1 = 'Required!';
        }
        if ($pwd2 == '') {
            $error_pwd2 = 'Required!';
        }
        $error_alert = 'Please fill in required fields!';
        include('views/changepass.php');
    } else if ($pwd != $pwd2) {
        $error_alert = 'Password fields must match!';
        include('views/changepass.php');
    } else {
        $old_pwd = 0;
        $result = $mysqli->query("SELECT `password` FROM `users` WHERE id = $id") or die($mysqli->error);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $old_pwd = $row['password'];
        }

        if (md5($current_pass . $config['salt']) != $old_pwd) {
            $error_alert = "Your current password is incorrect!";
            $error_pwd = "Incorrect";
            include('views/changepass.php');
        } else {
            $pwd = md5($pwd . $config['salt']);
            if ($mysqli->query("UPDATE `users` SET `password` = '$pwd' WHERE id = $id")) {
                $_SESSION['password'] = $pwd;
                if (isset($_COOKIE['cookname'])) {
                    setcookie("cookpass", $_SESSION['password'], time() + 60 * 60 * 24 * 100, "/");
                }
                $error_alert = 'Password updated successful!';
                include('views/changepass.php');
            } else {
                echo "ERROR: Could not prepare MySQLi statement.";
            }
        }
    }
} else {
    include('views/changepass.php');
}
?>