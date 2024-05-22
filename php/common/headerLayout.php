<?php
session_start();

$loggedIn = isset($_SESSION['user_name']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>


<style>
    .nav-item:hover {

        text-shadow: 2px 0px 4px rgba(0, 0, 0, 0.5);
    }

    .navbar-nav .nav-link.active {
        text-shadow: 2px 4px 3px rgba(0, 0, 0, 0.3);
    }
</style>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> <i class="fab fa-rocketchat mr-2"></i>
                Communication Application</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php if ($loggedIn): ?>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../chat/groupChat.php">Group Chat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../userManagement/userList.php">Manage Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../fileManagement/uploadFile.php">Manage Documents</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link nav-link-logout">Logout</a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </nav>
    <script>
        var currentUrl = window.location.pathname;
        var currentPage = currentUrl.substring(currentUrl.lastIndexOf("/") + 1);

        $(".nav-link").removeClass("active");
        $(".nav-link[href='" + currentPage + "']").addClass("active");

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1e2aee451d.js" crossorigin="anonymous">


    </script>
</body>

</html>