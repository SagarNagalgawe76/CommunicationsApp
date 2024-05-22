<?php

require_once ("../common/dbConnect.php");
require_once ("../common/headerLayout.php");
if (!isset($_SESSION['user_name']) || !isset($_GET['id'])) {
    header('Location: ../auth/logout.php');
    exit;
} else {

    $id = $_GET['id'];
}

function updateData($id, $label, $fileName)
{
    global $db;
    $query = "UPDATE upload SET label=?,filename=? where ID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ssi', $label, $fileName, $id); // 'i' indicates that the parameter is an integer
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        return true;
    } else {
        return false;
    }
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'] ?? '';
    $label = $_POST['label'] ?? '';
    $filename = $_POST['filename'] ?? '';

    // Call the update function
    $updated = updateData($id, $label, $filename);

    // Display result
    if ($updated) {
        header('Location:uploadFile.php');
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
                        <label for="label">Label:</label>
                        <input type="text" class="form-control" id="label" name="label"
                            value="<?php echo htmlspecialchars($_GET['label'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="filename">Filename:</label>
                        <input type="text" class="form-control" id="filename" name="filename"
                            value="<?php echo htmlspecialchars($_GET['filename'] ?? ''); ?>">
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