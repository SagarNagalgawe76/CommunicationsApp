<?php

require_once ('common/headerLayout.php');

$userName = $_GET['userName'];
?>

<style>
    .welcome-box {
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;
    }

    .congratulation-wrapper {
        max-width: 550px;
        margin: auto;
        box-shadow: 0 0 20px #f3f3f3;
        padding: 30px 20px;
        background-color: #fff;
        border-radius: 10px
    }

    .congratulation-contents.center-text .congratulation-contents-icon {
        margin: auto
    }

    .congratulation-contents-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100px;
        width: 100px;
        background-color: #65c18c;
        color: #fff;
        font-size: 50px;
        border-radius: 50%;
        margin-bottom: 30px
    }

    .congratulation-contents-title {
        font-size: 32px;
        line-height: 36px;
        margin: -6px 0 0
    }

    .congratulation-contents-para {
        font-size: 16px;
        line-height: 24px;
        margin-top: 15px
    }

    .btn-wrapper {
        display: block
    }

    .cmn-btn.btn-bg-1 {
        background: #6176f6;
        color: #fff;
        border: 2px solid transparent;
        border-radius: 3px;
        text-decoration: none;
        padding: 5px
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>

<body>


    <div class="congratulation-area text-center mt-5">
        <div class="container">
            <div class="congratulation-wrapper">
                <div class="congratulation-contents center-text">
                    <div class="congratulation-contents-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <h4 class="congratulation-contents-title">Welcome <?php echo $userName; ?> !</h4>
                    <p class="congratulation-contents-para">Your account has been registered, click below login to get
                        started.</p>
                    <div class="btn-wrapper mt-4">

                        <a href="loginPage.php" class="btn btn-primary">Login</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>