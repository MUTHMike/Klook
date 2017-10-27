<?php

header('Content-Type: text/html; charset=utf-8');
include('./session.php');

$respond = array();
$respond['is_error'] = TRUE;
$respond['message'] = 'unknown error!';

$error_alert = "";
$error_title = "";

$title = isset($_POST['title']) ? $_POST['title'] : "";
$status = isset($_POST['status']) ? $_POST['status'] : 1;

// Set publish Unpublish
if (isset($_POST['types'])) {
    $id = isset($_POST['id']) ? abs(intval($_POST['id'])) : 0;
    $type = $_POST['types'];
    if ($type == 0) {
        $sms = "Category is set Unpublish";
    } else {
        $sms = "Category is set Publish";
    }

    if ($id != 0) {
        $mysqli->query("UPDATE `categories` SET `status` = $type WHERE `id`=$id") or die($mysqli->error);
        if (!$mysqli->error) {
            $respond['is_error'] = false;
            $respond['message'] = $sms;
        }
    } else {
        $respond['message'] = 'No id get';
    }
    echo json_encode($respond);
}
// delete
else if (isset($_GET['delete'])) {
    $id = isset($_GET['delete']) ? abs(intval($_GET['delete'])) : 0;
    if ($id != 0) {
        if ($mysqli->query("DELETE FROM `categories` WHERE `id`=$id")) {
            $result = $mysqli->query("SELECT `image` FROM `articles` WHERE `cat_id`=$id") or die($mysqli->error);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    @unlink("../uploads/articles/big/" . $row['image']);
                    @unlink("../uploads/articles/small/" . $row['image']);
                }
            }
            $mysqli->query("DELETE FROM `articles` WHERE `cat_id`=$id");
        }
        header("location: category.php?sms=DELETE_SUCCESS&id=$id");
    } else {
        header("location: category.php?sms=DELETE_NOT_SUCCESS&id=0");
    }
}
// edit
else if (isset($_GET['edit'])) {
    $id = isset($_GET['edit']) ? abs(intval($_GET['edit'])) : 0;
    if ($id != 0) {
        if (isset($_POST['submit'])) {
            if ($title == "") {
                $error_title = 'Required!';
                include('views/saveCategory.php');
            } else {
                $stmt = $mysqli->prepare("UPDATE `categories` SET `title` = ?, `status` = ? WHERE `id` = ?");
                if ($stmt) {
                    $stmt->bind_param('sii', $title, $status, $id);
                    $stmt->execute();
                    $stmt->close();

                    $error_alert = 'Category updated successfully!';
                    $title = "";
                    header("location: category.php?sms=$error_alert&id=$id");
                } else {
                    echo "ERROR: Could not prepare MySQLi statement.";
                }
            }
        } else {
            $query = "SELECT * FROM `categories` WHERE `id`=$id";
            $result = $mysqli->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $title = $row['title'];
                $status = $row['status'];

                include('views/saveCategory.php');
            }
        }
    } else {
        header("location: category.php?sms=NO_ID&id=0");
    }
}

//add
else {
    if (isset($_POST['submit'])) {
        if ($title == "") {
            $error_title = 'Required!';
            include('views/saveCategory.php');
        } else {
            $stmt = $mysqli->prepare("INSERT INTO `categories` (title,created_date,status) VALUES (?,?,?)");
            if ($stmt) {
                $date = date('Y-m-d H:i:s');
                $stmt->bind_param("ssi", $title, $date, $status);
                $stmt->execute();
                $stmt->close();

                $id = $mysqli->insert_id;
                $error_alert = 'Category added successfully!';
                $title = "";
                header("location: category.php?sms=$error_alert&id=$id");
            } else {
                echo "ERROR: Could not prepare MySQLi statement.";
            }
        }
    } else {
        include('views/saveCategory.php');
    }
}
$mysqli->close();
?>