<?php

header('Content-Type: text/html; charset=utf-8');
include('./session.php');
include('./editor/ckeditor/ckeditor.php');
include('./editor/ckfinder/ckfinder.php');

$error_alert = "";
$error_webtitle = "";
$error_meta_keywords = "";
$error_author = "";
$error_meta_description = "";
$error_footer = "";
$text = isset($_GET['sms']) ? $_GET['sms'] : "";

$webtitle = "";
$meta_keywords = "";
$author = "";
$meta_description = "";
$styles = "";
$footer = "";

// edit General
if (isset($_GET['edit'])) {
    $id = isset($_GET['edit']) ? abs(intval($_GET['edit'])) : 0;
    if ($id != 0) {

        if (isset($_POST['submit'])) {

            $webtitle = isset($_POST['webtitle']) ? $_POST['webtitle'] : "";
            $meta_keywords = isset($_POST['meta_keywords']) ? $_POST['meta_keywords'] : "";
            $author = isset($_POST['author']) ? $_POST['author'] : "";
            $meta_description = isset($_POST['meta_description']) ? $_POST['meta_description'] : "";
            $styles = isset($_POST['styles']) ? $_POST['styles'] : "";
            $footer = isset($_POST['footer']) ? $_POST['footer'] : "";
			// process form
            if ($webtitle == "" || $meta_keywords == "" || $author == "" || $meta_description == "" || $footer == "") {
                // fields need to be filled in
            if ($webtitle == "") {
                $error_webtitle = 'required!';
            }
            if ($meta_keywords == "") {
                $error_meta_keywords = 'required!';
            }
            if ($author == "") {
                $error_author = 'required!';
            }
            if ($meta_description == "") {
                $error_meta_description = 'required!';
            }
            if ($footer == "") {
                $error_footer = 'required!';
            }
                // show form
                include('views/general.php');
            }
			else {
            $query = "UPDATE `general_setting` SET `web_title`='$webtitle',`meta_keywords`='$meta_keywords',`meta_author`='$author',`meta_description`='$meta_description',`styles`='$styles',`footer`='$footer' WHERE `id`=$id";
            $result = $mysqli->query($query);
            // show form
            header("location: general.php?edit=1&sms=UPDATE GENERAL SUCCESS");
			}
        } else {
            $query = "SELECT * FROM `general_setting` WHERE `id`=$id";
            $result = $mysqli->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $webtitle = $row['web_title'];
                $meta_keywords = $row['meta_keywords'];
                $author = $row['meta_author'];
                $meta_description = $row['meta_description'];
                $styles = $row['styles'];
                $footer = $row['footer'];

                include('views/general.php');
            }
        }
    } else {
        header("location: general.php?sms=NO_ID&id=0");
    }
}

$mysqli->close();
?>