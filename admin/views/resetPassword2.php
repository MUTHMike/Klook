<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reset Password</title>
        <link href="./css/backend.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <form method="post" class="form-signin" role="form">
                <h5 class="form-signin-heading">Please reset your password using the form below.</h5>
                <?php
                if ($error_alert != '') {
                    echo "<div class='alert'>" . $error_alert . "</div>";
                }
                ?>
                <input type="email" class="form-control input-xlarge" placeholder="Email" name="email" value="<?php echo $email; ?>" required="required">
                <span class="help-inline"><?php echo $error_email; ?></span>
                <input type="password" name="password" value="<?php echo $pass; ?>"><div class="error"><?php echo $error_pass; ?></div>
                <span class="help-inline"><?php echo $error_pass; ?></span>
                <input type="password" name="password2" value="<?php echo $pass2; ?>">
                <span class="help-inline"><?php echo $error_pass2; ?></span>
                <p><a href="./">Sign in</a></p>
                <button class="btn btn-success" type="submit" name="submit">Submit</button><br/>
            </form>
        </div>
    </body>
</html>