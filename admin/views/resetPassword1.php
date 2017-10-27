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
                <h5 class="form-signin-heading">Forgot your password? Enter your E-mail below, and we'll email you a link to reset your password.</h5>
                <?php
                if ($error_alert != '') {
                    echo "<div class='alert'>" . $error_alert . "</div>";
                }
                ?>
                <input type="email" class="form-control input-xlarge" placeholder="Email" name="email" value="<?php echo $email; ?>" required="required">
                <span class="help-inline"><?php echo $error_email; ?></span>
                <p><a href="./">Sign in</a></p>
                <button class="btn btn-success" type="submit" name="submit">Submit</button><br/>
                
            </form>
        </div>
    </body>
</html>