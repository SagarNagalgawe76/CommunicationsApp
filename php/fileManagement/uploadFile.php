<?php
require_once ("uploadFunc.php");

if (!isset($_SESSION['user_name'])) {
    header('Location: ../auth/loginPage.php');
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["userFile"])) {
    // Check for file upload errors
    if ($_FILES['userFile']['error'] > 0) {
        switch ($_FILES['userFile']['error']) {
            case 1:
                echo "File exceeded upload_max_file_size";
                break;
            case 2:
                echo "File exceeded max_file_size";
                break;
            case 3:
                echo "File only partially uploaded";
                break;
            case 4:
                echo "No file uploaded";
                break;
        }
    } else {
        // Validate file type (example: PNG)
        if ($_FILES['userFile']['type'] != 'image/png') {
            echo "Problem: File is not a PNG file";
            exit;
        }


        // Move up by 3 folders.
        $parent_directory = dirname(__FILE__, 3);
        // Specify the folder you want to access
        $upload_directory = $parent_directory . "/staticFiles/img/";

        // Specify the folder you want to access
        $upload_directory = $parent_directory . "/staticFiles/img/" . $_FILES['userFile']['name'];
        $fileName = $_FILES['userFile']['name'];

        // Upload file
        if (move_uploaded_file($_FILES['userFile']['tmp_name'], $upload_directory)) {
            echo "<script>Console.log('File uploaded successfully');</script>";

            // Save file information to database
            savetoDatabase($upload_directory, $_POST['fileName']);
        } else {
            echo "Problem: Could not move file to destination directory";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<style>
    .image-container {
        margin-top: 50px;
        /* Adjust as needed */
    }

    .container {
        max-width: 100%;
        margin: 0 auto;
        overflow-x: auto;
    }

    .actions-col {
        white-space: nowrap;

    }

    .actions-col button {
        margin: 0 2px;
        padding: 5px 10px;
        cursor: pointer;
        display: inline-block;
    }

    .filename-col {
        max-width: 200px;
        /* Set the maximum width as needed */
        word-wrap: break-word;
        /* Ensure long text wraps within the column */
        overflow-wrap: break-word;
        /* For better compatibility */
        white-space: normal;
        /* Allow text to wrap */
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', function () {
                const filename = this.dataset.filename;
                document.getElementById('uploadedImage').src = `../../staticFiles/img/${filename}`;
            });
        });
    });
</script>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Upload form -->
                <div class="mb-6">
                    <form id="uploadForm" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
                        <h2 class="text-center mb-4">Upload</h2>
                        <div class="mb-3">
                            <label for="fileName" class="form-label">File Description</label>
                            <input type="text" class="form-control" id="fileName" name="fileName">
                        </div>
                        <div class="mb-3">
                            <label for="userFile" class="form-label">Upload a file</label>
                            <input type="file" class="form-control" id="userFile" name="userFile">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Upload</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>

                <div class="mb-6">
                    <br> <!-- Image display -->
                    <h4>Uploaded Image/ View Image</h4>
                    <div class="col-md-4 mb-4 image-container">
                        <div class="text-center">
                            <?php
                            if (empty($fileName)) {
                                $defaultImageURL = "../../staticFiles/img/default.png";
                                $src = htmlspecialchars($defaultImageURL);
                            } else {
                                // If $fileName is set, construct the path to the image dynamically
                                $imagePath = "../../staticFiles/img/" . htmlspecialchars($fileName);
                                $src = htmlspecialchars($imagePath);
                            }
                            ?>
                            <img id="uploadedImage" src="<?php echo $src; ?>" alt="Uploaded Image" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- File Database -->
            <div class="col-md-6">
                <h2 class="text-center">File Database</h2>
                <table id="fileDatabase" class="table">
                    <thead>
                        <tr>
                            <th scope="col">Label</th>
                            <th scope="col">Filename</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php fetchFilesFromDatabase(); ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

</html>