<?php

require_once ("../common/dbConnect.php");
require_once ("../common/headerLayout.php");
if (!isset($_SESSION['user_name']) || !isset($_GET['id'])) {
    header('Location: ../auth/logout.php');
    exit;
}


function updateUserData($id, $name, $email, $existingName, $existingEmail)
{
    global $db;
    $query = "UPDATE users SET name=?,email=? WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ssi', $name, $email, $id);
    $stmt->execute();

    if ($existingName === $name && $existingEmail === $email) {
        return true; //no_changes
    }
    if ($stmt->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    //from url
    $id = $_GET['id'];
    $existingName = $_GET['user'];
    $existingEmail = $_GET['email'];

    //from form POST
    $name = $_POST['name'];
    $email = $_POST['email'];
    echo $name . " " . $email . " " . $id;

    // Update the password in the database
    $updated = updateUserData($id, $name, $email, $existingName, $existingEmail);
    // Display result
    if ($updated) {
        header('Location:userList.php');
    } else {
        echo "Failed to update data.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Documents</title>

    <style>
        /* Set height of container to viewport height */
        .container {
            height: 80vh;
        }

        /* Center content horizontally and vertically */
        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70%;
        }

        .form-group label {
            padding: 20px;
        }

        .form-group button {
            margin: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row center-content">
            <div class="col-md-6">
                <h2>Edit Upload</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?php echo htmlspecialchars($_GET['user'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id'] ?? ''); ?>">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>








</body>

</html>