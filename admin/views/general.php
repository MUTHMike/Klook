<!DOCTYPE html>
<html>
    <head>
        <title>General Area</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link href="./css/backend.css" media="screen" rel="stylesheet" type="text/css">
        <script language="javascript" type="text/javascript">
            function gotolist() {
                document.location = "./setting.php";
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
                                <a href="./member.php" class="btn btn-info" title="Amdnin"><i class="fam-house"></i></a>
                            </div>
                            <div class="span1 text-right offset9">
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
                <div id="msg_status" class="sms label label-warning"><?php echo $text; ?></div>
                <div id="content">
                    <div class="row-fluid">
                        <div class="span12 bd-navbar-top" style="background-color: #D6CDC6;">
                            <div id="spin_list" class="navbar navbar-static-top">
                                <div class="navbar-inner">
                                    <div class="brand" style="color: #3E5766;">General Setting</div>
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
                                        <label class="control-label text-left" for="webtitle">Web Title: *</label>
                                        <div class="controls">
                                            <input id="webtitle" class="input-xlarge" type="text" name="webtitle" value="<?php echo $webtitle; ?>">
                                            <span class="help-inline"><?php echo $error_webtitle; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label text-left" for="meta_keywords">Meta Keywords: *</label>
                                        <div class="controls">
                                            <textarea rows="4" cols="50" id="meta_keywords" class="input-xlarge span12" name="meta_keywords"><?php echo $meta_keywords; ?></textarea>
                                            <span class="help-inline"><?php echo $error_meta_keywords; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label text-left" for="author">Meta Author: *</label>
                                        <div class="controls">
                                            <textarea rows="4" cols="50" id="author" class="input-xlarge span12" type="text" name="author"><?php echo $author; ?></textarea>
                                            <span class="help-inline"><?php echo $error_author; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label text-left" for="meta_description">Meta Description: *</label>
                                        <div class="controls">
                                            <textarea rows="4" cols="50" id="meta_description" class="input-xlarge span12" type="text" name="meta_description"><?php echo $meta_description; ?></textarea>
                                            <span class="help-inline"><?php echo $error_meta_description; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label text-left" for="styles">Styles: </label>
                                        <div class="controls">
                                            <textarea rows="4" cols="50" id="styles" class="input-xlarge span12" type="text" name="styles"><?php echo $styles; ?></textarea>
                                        </div>
                                    </div>
                                    <div id="ckeditor" class="control-group">
                                        <label class="control-label text-left" for="footer">Footer Text*</label><br/>
                                        <div class="controls">
                                            <?php
                                            $ckeditor = new CKEditor();
                                            $ckeditor->basePath = './editor/ckeditor/';
                                            $ckfinder = new CKFinder();
                                            $ckfinder->BasePath = './editor/ckfinder/';
                                            $ckfinder->SetupCKEditorObject($ckeditor);
                                            $ckeditor->editor('footer', $footer);
                                            ?>
                                            <span class="help-inline"><?php echo $error_footer; ?></span>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button class="btn btn-danger" type="button" onClick="gotolist();"><i class="fam-cancel"></i> Cancel</button>
                                        <button class="btn btn-success" type="submit" name="submit"><i class="fam-add"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div
            </div>
        </div>
    </body>
</html>