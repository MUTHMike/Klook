<?php



session_start();

include('../includes/config.php');

include('../includes/db.php');



$error_alert = '';

$error_username = '';

$error_pwd = '';

$username = '';

$pwd = '';



if (isset($_POST['submit'])) {

    $username = isset($_POST['username']) ? $_POST['username'] : "";

    $pwd = isset($_POST['password']) ? $_POST['password'] : "";

    if ($username == '' || $pwd == '') {

        if ($username == '') {

            $error_username = 'Required!';
        }
        if ($pwd == '') {

            $error_pwd = 'Required!';

        }
        $error_alert = 'Please fill in required fields!';

        include('./views/login.php');

    } else {

        $pw = md5($pwd .$config['salt']);

        $result = $mysqli->query("SELECT * FROM `users` WHERE `username`='$username' AND `password`='$pw'");
        

        if (!$mysqli->error) {

            if ($result->num_rows == 1) {

                $row = $result->fetch_assoc();

                $_SESSION['id'] = $row['id'];

                $_SESSION['type'] = $row['type'];

                $_SESSION['username'] = $username;

                $_SESSION['password'] = $pw;

                $_SESSION['last_active'] = time();

                if (isset($_POST['remember'])) {

                    setcookie("cookname", $_SESSION['username'], time() + 60 * 60 * 24 * 100, "/");

                    setcookie("cookpass", $_SESSION['password'], time() + 60 * 60 * 24 * 100, "/");

                    setcookie("cookid", $_SESSION['id'], time() + 60 * 60 * 24 * 100, "/");

                    setcookie("cooktype", $_SESSION['type'], time() + 60 * 60 * 24 * 100, "/");

                }

                header("Location: ./");

            } else {

                $error_alert = "Username or password incorrect!";

                include('./views/login.php');

            }

        } else {

            $error_alert = "ERROR: Could not prepare MySQLi statement.";

        }

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

$mysqli->close();

?>