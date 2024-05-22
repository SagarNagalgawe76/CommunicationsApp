<?php
require_once ('../common/dbConnect.php');

$query = "SELECT time,user,message FROM groupChat";
$stmt = $db->prepare($query);
$stmt->execute();

$stmt->bind_result($time, $user, $message);

if (!$stmt) {
    die("Error: " . $db->error);
}

$chatMessages = array();
while ($stmt->fetch()) {
    $chatMessages[] = array(
        'time' => substr($time, 0, -7),
        'user' => $user,
        'message' => $message
    );
}
// Encode chat messages as JSON
$jsonChat = json_encode($chatMessages);

// Output JSON data
header('Content-Type: application/json');
echo $jsonChat;

