<?php
require_once ("../common/dbConnect.php");
require_once ("../common/headerLayout.php");
function uploadFile($uploaded_file_path)
{
    if (is_uploaded_file($_FILES['userFile']['tmp_name'])) {
        if (!move_uploaded_file($_FILES['userFile']['tmp_name'], $uploaded_file_path)) { // ?
            echo "Problem: Could not move file to destination directory";
            exit;
        }
    } else {
        echo "Problem: Possible file upload attack. Filename:";
        echo $_FILES['userFile']['name'];
        exit;
    }

    echo "<script>console.log('File uploaded successfully');</script>";

}

function displayUploadedImage($filename)
{

    echo '<img src="../../staticFiles/img/' . $filename . '"/>';
}

function savetoDatabase($filePath, $fileName)
{
    global $db;
    $query = "INSERT INTO Upload(label,filename) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ss', $fileName, $filePath);
    $stmt->execute();
    if (!$stmt) {
        die("Error: " . $db->error);
    }
    if ($stmt->affected_rows > 0) {
        echo "<script>console.log('Image added to database successfully.');</script>";

    } else {
        echo "alert('insert failed')";
    }
}

function fetchFilesFromDatabase()
{
    global $db;
    $query = "SELECT ID,label,filename FROM upload";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->bind_result($id, $label, $fileName);
    $rows = '';
    while ($stmt->fetch()) {
        // Add a new row to the table with fetched data
        $fileBaseName = basename($fileName);
        $rows .= "<tr>
        <td>$label</td>
        <td class='filename-col'>$fileBaseName</td>
        <td class='actions-col'>
            <button class='btn btn-primary view-btn' data-filename='$fileBaseName'>View</button>
            <a href='editUpload.php?id=$id&label=$label&filename=$fileBaseName' class='btn btn-primary'>Edit</a>
            <a href='deleteUpload.php?id=$id' class='btn btn-danger'>Delete</button>
        </td>
    </tr>";

    }

    // Output the populated table rows
    echo $rows;
}