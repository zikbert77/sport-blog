<!doctype html>
<html lang="en">
<head>
    <!-- All the files that are required -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/template/css/bootstrap.css">
    <link rel="stylesheet" href="/template/css/login.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <?= (isset($success))? $success : '' ?>

            <?php

            if (isset($errors) && $errors){
                echo '<ul style="list-style: none;">';
                foreach ($errors as $error){
                    echo "<li>$error</li>";
                }
                echo '</ul>';
            }


            ?>
        </div>
    </div>
</div>

<!-- Where all the magic happens -->
<!-- LOGIN FORM -->
<div class="text-center" style="padding:50px 0">
    <div class="logo">registration</div>
    <!-- Main Form -->

    <div class="login-form-1">
        <form id="registration-form" class="text-left" method="post" action="">
            <div class="form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="rg_username" class="sr-only">Username</label>
                        <input type="text" class="form-control" value="<?= isset($user['user_name'])? $user['user_name'] : '' ?>" id="rg_username" name="rg_username" placeholder="Login">
                    </div>
                    <div class="form-group">
                        <label for="rg_password" class="sr-only">Password</label>
                        <input type="password" class="form-control" value="<?= isset($u_pass1)? $u_pass1 : '' ?>" id="rg_password" name="rg_password1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="rg_password" class="sr-only">Password</label>
                        <input type="password" class="form-control" value="<?= isset($u_pass2)? $u_pass2 : '' ?>" id="rg_password" name="rg_password2" placeholder="Repeat password">
                    </div>
                </div>
                <button type="submit" name="registration-submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
            </div>
        </form>
        <br>
        <p>You have an account? <a href="/login/">Log in now!</a></p>
    </div>
    <!-- end:Main Form -->
</div>

</body>
</html>
