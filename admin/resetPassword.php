<?php
session_start();
include('../includes/config.php');
include('../includes/db.php');

$error_alert = '';
$error_email = '';
$error_pass = '';
$error_pass2 = '';

$email = '';
$pass = '';
$pass2 = '';

if (isset($_GET['key'])) {
    if (isset($_POST['submit'])) {
        $email = htmlentities($_POST['email'], ENT_QUOTES);
        $pass = htmlentities($_POST['password'], ENT_QUOTES);
        $pass2 = htmlentities($_POST['password2'], ENT_QUOTES);
        $key = htmlentities($_GET['key'], ENT_QUOTES);
        
        if ($email == '' || $pass == '' || $pass2 == '') {
            if ($email == '') {
                $error_email = 'Required!';
            } if ($pass == '') {
                $error_pass = 'Required!';
            } if ($pass2 == '') {
                $error_pass2 = 'Required!';
            }
            
            $error_alert = 'Please fill in required fields!';
            include('views/resetPassword2.php');
            
        } else if (!preg_match('/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/', $email)) {
            $error_email = 'Please enter a valid email!';
            include('views/resetPassword2.php');
        } else {
            $check = $mysqli->prepare("SELECT email FROM `users` WHERE email = ? AND pw_reset = ?");
            $check->bind_param("ss", $email, $key);
            $check->execute();
            $check->store_result();
            if ($check->num_rows == 0) {
                $error_alert = "Unfortunately the reset key and the email you have entered do not match, or the password reset key is invalid. Please double check your email address, or try <a href='reset_password.php'>resetting your password again</a>.";
                include('views/resetPassword2.php.php');
            } else {
                $check = $mysqli->prepare("UPDATE `users` SET password = ?, pw_reset = '' WHERE email = ?");
                $check->bind_param("ss", md5($pass . $config['salt']), $email);
                $check->execute();
                $check->close();
                
                $error_alert = 'Password updated successfully. Please <a href="login.php">login</a>.';
                $email = '';
                $pass = '';
                $pass2 = '';

                include('views/resetPassword2.php');
            }
        }
    } else {
        include('views/resetPassword2.php');
    }
} else {
    if (isset($_POST['submit'])) {
        $email = htmlentities($_POST['email'], ENT_QUOTES);
        if ($_POST['email'] == '') {
            $error_email = 'Required!';
            $error_alert = 'Please fill in required fields!';

            include('views/resetPassword1.php');
            
        } else if (!preg_match('/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/', $email)) {
            $error_email = 'Please enter a valid email!';
            include('views/resetPassword1.php');
        } else {
            $check = $mysqli->prepare("SELECT `email` FROM `users` WHERE email = ?");
            $check->bind_param("s", $email);
            $check->execute();
            $check->store_result();
            
            if ($check->num_rows == 0) {
                $check->close();
                $error_alert = "That email doesn't exist in the database.";
                include('views/resetPassword1.php');
            } else {
                $check->close();
                $key = randomString(16);
                $subject = "Password reset request from " . $config['site_name'];

                $message = "<html><body>";
                $message .= "<p>Hello,</p>";
                $message .= "<p>You (or someone claiming to be you) recently asked that your " . $config['site_name'] . " password be reset. If so, please click the link below to reset your password. If you do not want to reset your password, or if the request was in error, please ignore this message.</p>";
                $message .= "<a href='" . $config['site_url'] . "/resetPassword.php?key=" . $key . "'>" . $config['site_url'] . "/resetPassword.php?key=" . $key . "</a></p>";
                $message .= "<p>Thanks, <br/>The Administrator, " . $config['site_name'] . "</p>";
                $message .= "</body></html>";

                $headers = "MIME-Version: 1.0 \r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
                $headers .= "From: " . $config['site_name'] . " <noreply@" . $config['site_domain'] . ">\r\n";
                $headers .= "X-Sender: <noreply@" . $config['site_domain'] . ">\r\n";
                $headers .= "Reply-To: <noreply@" . $config['site_domain'] . ">\r\n";

                mail($email, $subject, $message, $headers);

                $stmt = $mysqli->prepare("UPDATE `users` SET pw_reset = ? WHERE email = ?");
                $stmt->bind_param("ss", $key, $email);
                $stmt->execute();
                $stmt->close();

                $error_alert = "Password reset sent successfully. Please check your email.";
                $email = '';
                include("views/resetPassword1.php");
            }
        }
    } else {
        include("views/resetPassword1.php");
    }
}

$mysqli->close();

function randomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }
    return $string;
}

?>