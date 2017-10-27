<?php
include ('./session.php');
$error_alert = '';
$error_user = '';
$error_email = '';
$error_type = '';
$error_pass = '';
$error_pass2 = '';

$username = '';
$email = '';
$type = '';
$pass = '';
$pass2 = '';

if (isset($_POST['submit'])) {
    $username = htmlentities($_POST['username'], ENT_QUOTES);
    $email = htmlentities($_POST['email'], ENT_QUOTES);
    $type = htmlentities($_POST['type'], ENT_QUOTES);
    $pass = htmlentities($_POST['password'], ENT_QUOTES);
    $pass2 = htmlentities($_POST['password2'], ENT_QUOTES);

    $select = '<option value="">Select an option</option>';
    $stmt = $mysqli->prepare("SELECT * FROM `permissions`");
    $stmt->execute();
    $stmt->bind_result($id, $name);
    while ($stmt->fetch()) {
        $select .= "<option value='" . $id . "'>";
        if ($type == $id) {
            $select .= "selected='selected'";
        }
        $select .= " " . $name . "</option>";
    }
    $stmt->close();

    if ($_POST['username'] == '' || $_POST['password'] == '' || $_POST['password2'] == '' || $_POST['email'] == '' || $_POST['type'] == '') {
        if ($_POST['username'] == '') {
            $error_user = 'required!';
        }
        if ($_POST['email'] == '') {
            $error_email = 'required!';
        }
        if ($_POST['type'] == '') {
            $error_type = 'required!';
        }
        if ($_POST['password'] == '') {
            $error_pass = 'required!';
        }
        if ($_POST['password2'] == '') {
            $error_pass2 = 'required!';
        }
        $error_alert = 'Please fill in required fields!';
        include('views/register.php');
    } else if ($_POST['password'] != $_POST['password2']) {
        $error_alert = 'Password fields must match!';
        include('views/register.php');
    } else if (!preg_match('/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/', $email)) {
               $error_email = "Please enter a valid email!";
        include('views/register.php');
    } else {
        // check if the email is taken
        $check = $mysqli->prepare("SELECT `email` FROM `users` WHERE `email` = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();
        if ($check->num_rows != 0) {
            // email is already in use
            $error_alert = "This email is already in use. Please choose a different email address.";
            $error_email = "Please choose a different email address.";

            // show form
            include('views/register.php');
            exit;
        }

        // check if the username is taken
        $check = $mysqli->prepare("SELECT `username` FROM `users` WHERE `username` = ?");
        $check->bind_param("s", $username);
        $check->execute();
        $check->store_result();
        if ($check->num_rows != 0) {
            // username is already in use
            $error_alert = "This username is already in use. Please choose a different username.";
            $error_user = "Please choose a different username.";

            // show form
            include('views/register.php');
            exit;
        }

        // insert into database
        if ($stmt = $mysqli->prepare("INSERT `users` (username, email, type, password) VALUES (?,?,?,?)")) {
            $pwd =  md5($pass . $config['salt']);
            $stmt->bind_param("ssss", $username, $email, $type,$pwd);
            $stmt->execute();
            $stmt->close();

            // add alert and clear form values
            $error_alert = 'Member added successfully!';
            $username = '';
            $email = '';
            $type = '';
            $pass = '';
            $pass2 = '';

            // show form
            include('views/register.php');
        } else {
            echo "ERROR: Could not prepare MySQLi statement.";
        }
    }
} else {
    // create select options
    $select = '<option value="">Select an option</option>';
    $stmt = $mysqli->prepare("SELECT * FROM `permissions`");
    $stmt->execute();
    $stmt->bind_result($id, $name);
    while ($stmt->fetch()) {
        $select .= "<option value='" . $id . "'>" . $name . "</option>";
    }
    $stmt->close();

    // show form
    include('views/register.php');
}

// close db connection
$mysqli->close();
?>