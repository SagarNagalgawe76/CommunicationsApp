<?php
$userName = $_POST["userName"];
$userEmail = $_POST["userEmail"];
$userPass = $_POST["userPass"];

$db = new mysqli('localhost', 'root', '', 'dashboard', 3307);
if ($db->connect_error) {
    echo "connection failed";
} else {
    echo "connection established";
}

$query = "INSERT INTO users(name,email,password) VALUES (?, ?, ?)";

$stmt = $db->prepare($query);
$stmt->bind_param('sss', $userName, $userEmail, $userPass);

$stmt->execute();
if (!$stmt) {
    die("Error: " . $db->error);
}
if ($stmt->affected_rows > 0) {
    header("Location: registerSuccess.php?userName=$userName");

} else {
    echo "alert('insert failed')";
}