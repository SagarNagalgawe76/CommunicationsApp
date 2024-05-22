<?php

require_once ("../common/dbConnect.php");
require_once ("../common/headerLayout.php");
if (!isset($_SESSION['user_name']) || !isset($_GET['id'])) {
    header('Location: ../auth/logout.php');
    exit;
} else {

    $id = $_GET['id'];
}
global $db;
$query = "DELETE FROM users WHERE id=?";
$stmt = $db->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
if ($stmt->affected_rows > 0) {
    header('Location:userList.php');
} else {
    echo "Failed to remove data.";
}