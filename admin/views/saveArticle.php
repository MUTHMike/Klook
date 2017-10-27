<?php
$text = isset($_GET['edit']) ? $_GET['edit'] : "";
if ($text == "") {
    $text = "Create";
} else {
    $text = "Edit";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Article</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="./css/backend.css" media="screen" rel="stylesheet" type="text/css">

        <script language="javascript" type="text/javascript">
            function gotolist() {
                document.location = "./article.php";
            }
        </script>
    </head>
    <body>
        <div id="wraper">
            <header id="header">
                <nav class="navbar navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="row-fluid">
                            <div class="span1 text-right">
                                <a href="member.php" class="btn btn-info" title="Admin"><i class="fam-house"></i></a>
                            </div>
                            <div class="span1 text-left">
                                <a href="article.php" class="btn btn-warning" title="Article"><i class="fam-arrow-left"></i></a>
                            </div>
                            <div class="span1 text-right offset8">
                                <a class="btn btn-success" href="./../" target="_blank"><i class="fam-house"></i></a>
                            </div>
                            <div class="span1 text-left">
                                <a class="btn btn-danger" href="logout.php"><i class="icon-off icon-white"></i></a>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="container">
                <div id="content">
                    <div class="row-fluid">
                        <div class="span12 bd-navbar-top" style="background-color: #D6CDC6;">
                            <div id="spin_list" class="navbar navbar-static-top">
                                <div class="navbar-inner">
                                    <div class="brand" style="color: #3E5766;"><?php echo $text; ?> Article</div>
                                </div>
                            </div>
                            <div class="bd-content">
                                <form class="form-horizontal" action="" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                                    <?php
                                    if ($error_alert != "") {
                                        echo "<div class='alert'>" . $error_alert . "</div>";
                                    }
                                    ?>
                                    <div class="control-group">
                                        <label class="control-label text-left" for="title">Title: *</label>
                                        <div class="controls">
                                            <input id="title" type="text" name="title" value="<?php echo $title; ?>">
                                            <span class="help-inline"><?php echo $error_title; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label text-left" for="title">Category: *</label>
                                        <div class="controls">
                                            <select id="category" name="category">
                                                <option value="0" selected="selected">Select Category</option>
                                                <?php
                                                $result = $mysqli->query("SELECT * FROM `categories` WHERE `status` = 1 ORDER BY `title` ASC") or die($mysqli->error);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $cat = $row['id'];
                                                        if ($cat_id == $cat) {
                                                            echo '<option value="' . $cat . '" selected="selected">' . $row['title'] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $cat . '">' . $row['title'] . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <span class="help-inline"><?php echo $error_cat; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label text-left" for="image">Image: </label>
                                        <div class="controls">
                                            <input id="image" type="file" name="image" value="">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label text-left">Status</label>
                                        <div class="controls">
                                            <select name="status">
                                                <?php
                                                if ($status == 1) {
                                                    ?>
                                                    <option value="1" selected="select">Publish</option>
                                                    <option value="0">Unpublish</option>
                                                <?php } else { ?>
                                                    <option value="0" selected="select">Unpublish</option>
                                                    <option value="1">Publish</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label text-left">Description: </label><br/>
                                        <div class="controls">
                                            <?php
                                            $ckeditor = new CKEditor();
                                            $ckeditor->basePath = './editor/ckeditor/';
                                            $ckfinder = new CKFinder();
                                            $ckfinder->BasePath = './editor/ckfinder/';
                                            $ckfinder->SetupCKEditorObject($ckeditor);
                                            $ckeditor->editor('desc', $desc);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-danger" type="button" onClick="gotolist();"><i class="fam-cancel"></i> Cancel</button>
                                        <button class="btn btn-success" type="submit" name="submit"><i class="fam-add"></i> <?php echo $text; ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>