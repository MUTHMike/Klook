<?php

header('Content-Type: text/html; charset=utf-8');
include('./session.php');
include('./editor/ckeditor/ckeditor.php');
include('./editor/ckfinder/ckfinder.php');
include('../includes/resize_image.php');

$respond = array();
$respond['is_error'] = TRUE;
$respond['message'] = 'unknown error!';

$error_alert = "";
$error_title = "";
$error_cat = "";

$title = isset($_POST['title']) ? $_POST['title'] : "";
$cat_id = isset($_POST['category']) ? $_POST['category'] : 0;
$desc = isset($_POST['desc']) ? $_POST['desc'] : "";
$status = isset($_POST['status']) ? $_POST['status'] : 1;
$img = isset($_FILES['image']['type']) ? $_FILES['image']['type'] : "";
$time = time();

// Set publish Unpublish
if (isset($_POST['types'])) {
    $id = isset($_POST['id']) ? abs(intval($_POST['id'])) : 0;
    $type = $_POST['types'];
    if ($type == 0) {
        $sms = "Article is set Unpublish";
    } else {
        $sms = "Article is set Publish";
    }

    if ($id != 0) {
        $mysqli->query("UPDATE `articles` SET `status` = $type WHERE `id`=$id") or die($mysqli->error);
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
        $mysqli->query("DELETE FROM `articles` WHERE `id`=$id");
        header("location: article.php?sms=DELETE_SUCCESS&id=$id");
    } else {
        header("location: article.php?sms=DELETE_NOT_SUCCESS&id=0");
    }
}
// edit
else if (isset($_GET['edit'])) {
    $id = isset($_GET['edit']) ? abs(intval($_GET['edit'])) : 0;
    if ($id != 0) {
        if (isset($_POST['submit'])) {
            if ($title == "" || $cat_id == 0) {
                if ($title == "") {
                    $error_title = 'Required!';
                } if ($cat_id == 0) {
                    $error_cat = 'Required!';
                }
                include('views/saveArticle.php');
            } else {
                $stmt = $mysqli->prepare("UPDATE `articles` SET `cat_id`=?, `title` = ?,`description` = ?, `status` = ? WHERE `id` = ?");
                if ($stmt) {
                    $stmt->bind_param('issii', $cat_id, $title, $desc, $status, $id);
                    $stmt->execute();
                    $stmt->close();

                    if ($img != "") {
                        $result = $mysqli->query("SELECT `image` FROM `articles` WHERE `id` = $id") or die($mysqli->error);
                        if ($result->num_row == 1) {
                            $row = $result->fetch_assoc();
                            @unlink("../uploads/articles/big/" . $row['image']);
                            @unlink("../uploads/articles/small/" . $row['image']);
                        }

                        if ($img == "image/gif") {
                            $extension = "gif";
                        } elseif ($img == "image/jpeg" || $img == "image/pjpeg") {
                            $extension = "jpg";
                        } else {
                            $extension = "png";
                        }
                        // put name for upload this file
                        $uploadedfile = $_FILES["image"]['tmp_name'];

                        $filename_big = "../uploads/articles/big/article-" . $time . "." . $extension;
                        $filename_small = "../uploads/articles/small/article-" . $time . "." . $extension;
                        $in_db_name = "article-" . $time . "." . $extension;

                        $image = new SimpleImage();
                        $image->load($uploadedfile);
                        $image->resizeToWidth(1600);
                        $image->save($filename_big);
                        $image->resizeToWidth(520);
                        $image->save($filename_small);

                        $mysqli->query("UPDATE `articles` SET `image`='$in_db_name' WHERE `id` = $id");
                    }

                    $error_alert = 'Article updated successfully!';
                    $title = "";
                    header("location: article.php?sms=$error_alert&id=$id");
                } else {
                    echo "ERROR: Could not prepare MySQLi statement.";
                }
            }
        } else {
            $query = "SELECT * FROM `articles` WHERE `id`=$id";
            $result = $mysqli->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $title = $row['title'];
                $desc = $row['description'];
                $status = $row['status'];
                $cat_id = $row['cat_id'];

                include('views/saveArticle.php');
            }
        }
    } else {
        header("location: article.php?sms=NO_ID&id=0");
    }
}

//add
else {
    if (isset($_POST['submit'])) {
        if ($title == "" || $cat_id == 0) {
            if ($title == "") {
                $error_title = 'Required!';
            } if ($cat_id == 0) {
                $error_cat = 'Required!';
            }
            include('views/saveArticle.php');
        } else {
            $stmt = $mysqli->prepare("INSERT INTO `articles` (cat_id,title,description,created_date,status) VALUES (?,?,?,?,?)");
            if ($stmt) {
                $date = date('Y-m-d H:i:s');
                $stmt->bind_param("isssi", $cat_id, $title, $desc, $date, $status);
                $stmt->execute();
                $stmt->close();

                $id = $mysqli->insert_id;
                $error_alert = 'Article added successfully!';
                $title = "";
                $cat_id = 0;

                if ($img != "") {
                    if ($img == "image/gif") {
                        $extension = "gif";
                    } elseif ($img == "image/jpeg" || $img == "image/pjpeg") {
                        $extension = "jpg";
                    } else {
                        $extension = "png";
                    }
                    // put name for upload this file
                    $uploadedfile = $_FILES["image"]['tmp_name'];

                    $filename_big = "../uploads/articles/big/article-" . $time . "." . $extension;
                    $filename_small = "../uploads/articles/small/article-" . $time . "." . $extension;
                    $in_db_name = "article-" . $time . "." . $extension;

                    $image = new SimpleImage();
                    $image->load($uploadedfile);
                    $image->resizeToWidth(1600);
                    $image->save($filename_big);
                    $image->resizeToWidth(520);
                    $image->save($filename_small);

                    $mysqli->query("UPDATE `articles` SET `image`='$in_db_name' WHERE `id` = $id");
                }

                header("location: article.php?sms=$error_alert&id=$id");
            } else {
                echo "ERROR: Could not prepare MySQLi statement.";
            }
        }
    } else {
        include('views/saveArticle.php');
    }
}
$mysqli->close();
?>