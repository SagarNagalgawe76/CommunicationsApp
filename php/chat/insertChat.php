<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header('Location: ../auth/logout.php');
    exit;

} else {
    $user = $_SESSION['user_name'];
}

require_once ("../common/headerLayout.php");
require_once ("../common/dbConnect.php");

$message = $_POST['message']; // As we are sending the message via Ajax call

$currentDateTimeStamp = date("Y-m-d H:i:s");

$query = "INSERT INTO groupChat(time,user,message) VALUES (?, ?, ?)";
$stmt = $db->prepare($query);
$stmt->bind_param('sss', $currentDateTimeStamp, $user, $message);
$stmt->execute();

if (!$stmt) {
    die("Error: " . $db->error);
}
if ($stmt->affected_rows > 0) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = "Insert Chat Failed!";
}

echo json_encode($response);