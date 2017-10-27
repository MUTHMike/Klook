<!DOCTYPE HTML>
<html>
    <head>
        <title>Change Password</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link href="./css/backend.css" media="screen" rel="stylesheet" type="text/css">
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
                <div id="content">
                    <div class="row-fluid">
                        <div class="span12 bd-navbar-top" style="background-color: #D6CDC6;">
                            <div id="spin_list" class="navbar navbar-static-top">
                                <div class="navbar-inner">
                                    <div class="brand" style="color: #3E5766;">Change Password</div>
                                </div>
                            </div>
                            <div class="bd-content">
                                <form action="" method="post" class="form-horizontal">
                                    <?php
                                    if ($error_alert != '') {
                                        echo "<div class='alert'>" . $error_alert . "</div>";
                                    }
                                    ?>

                                    <div class="control-group">
                                        <label for="username" class="control-label text-left">Current Password: *</label>
                                        <div class="controls">
                                            <input class="input-xlarge" type="password" name="current" value="">
                                            <span class="help-inline"><?php echo $error_pwd; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="password" class="control-label text-left">New Password: *</label>
                                        <div class="controls">
                                            <input class="input-xlarge" type="password" name="password" value="">
                                            <span class="help-inline"><?php echo $error_pwd1; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label text-left" for="password2">New Password (again): *</label>
                                        <div class="controls">
                                            <input class="input-xlarge" type="password" name="re_password" value="">
                                            <span class="help-inline"><?php $error_pwd2; ?></span>
                                        </div>
                                    </div>
                                    <p class="required">* required fields</p>
                                    <button class="btn btn-success" name="submit" type="submit">
                                        <i class="fam-accept"></i>
                                        Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>