<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link href="./css/backend.css" rel="stylesheet">
    </head>
    <body style="background: url('img/img4.webp');height: 100%; ">
        <div class="container-fluid" >
            <form action="./checklogin.php" method="post" class="form-signin" role="form">
                <h2 class="form-signin-heading">Please sign in</h2>
                <?php
                if ($error_alert != '') {
                    echo "<div class='alert'>" . $error_alert . "</div>";
                }
                ?>
                <input type="text" name="username" class="form-control input-xlarge" placeholder="Userame" required autofocus>
                <span class="help-inline"><?php echo $error_username; ?></span>
                <input type="password" name="password" class="form-control input-xlarge" placeholder="Password" required>
                <span class="help-inline"><?php echo $error_pwd; ?></span>
                <label class="checkbox col-sm-offset-1"><input type="checkbox" name="remember" value="remember-me"> Remember me</label>
                <label class="checkbox"><a href="resetPassword.php">Forget Password</a></label>
                <button class="btn btn-success" type="submit" name="submit">Sign in</button><br/>
            </form>
        </div>
    </body>
</html>