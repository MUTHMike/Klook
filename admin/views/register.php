<?php include('header.php') ?>

<div class="content-wrapper">
    <section class="content">
         <div class="span12 bd-navbar-top" style="background-color: #D6CDC6;">
                            <div id="spin_list" class="navbar navbar-static-top">
                                <div class="navbar-inner">
                                    <div class="brand" style="color: #3E5766;">Register Member</div>
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
                                        <label for="username" class="control-label text-left">Username: *</label>
                                        <div class="controls">
                                            <input class="input-xlarge" type="text" name="username" value="<?php echo $username; ?>">
                                            <span class="help-inline"><?php echo $error_user; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="email" class="control-label text-left">Email: *</label>
                                        <div class="controls">
                                            <input class="input-xlarge" type="email" name="email" value="<?php echo $email; ?>">
                                            <span class="help-inline"><?php echo $error_email; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="type" class="control-label text-left">Member Type: *</label>
                                        <div class="controls">
                                            <select name="type">
                                                <?php echo $select; ?>
                                            </select>
                                            <span class="help-inline"><?php echo $error_type; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="password" class="control-label text-left">Password: *</label>
                                        <div class="controls">
                                            <input class="input-xlarge" type="password" name="password" value="<?php echo $pass; ?>">
                                            <span class="help-inline"><?php echo $error_pass; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="password2" class="control-label text-left">Password (again): *</label>
                                        <div class="controls">
                                            <input class="input-xlarge" type="password" name="password2" value="<?php echo $pass2; ?>">
                                            <span class="help-inline"><?php echo $error_pass2; ?></span>
                                        </div>
                                    </div>
                                    <p class="required">* required fields</p>
                                    <button class="btn btn-success" name="submit" type="submit"><i class="fam-accept"></i>Submit</button>
                                </form>
                            </div>
                        </div>
    </section>
</div>

        <!-- <div id="wraper">
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
                    
        </div> -->
        <?php include('footer.php') ?>