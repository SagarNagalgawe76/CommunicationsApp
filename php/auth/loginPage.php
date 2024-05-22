<?php
// Include header
require_once ("../common/headerLayout.php");

if (isset($_GET['loginFailed'])) {
    $isValidUser = $_GET['loginFailed'];
} else {
    $isValidUser = "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WelcomePage</title>
</head>
<style>
    body {
        background-color: #f8f9fa;
    }

    .login-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    .container {
        margin-top: 12%;
    }

    .login-form {
        background-color: #ffffff;
        border-radius: 5px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .form-group {
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>



<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="login-container">
                    <h2>Welcome to User Module</h2>

                </div>
            </div>
            <div class="col-md-6">
                <div class="login-form">
                    <h2 class="text-center mb-4">Login</h2>
                    <form action="checkLogin.php" method="post">
                        <?php if (isset($_GET['loginFailed'])): ?>
                            <div class="form-group alert alert-danger login-failed-message" role="alert">
                                Login failed! Please check your credentials.
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="username">Username/Email</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <div class="form-group">
                            <p>If you are not registered, <a href="register.php">click here</a> to register.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>