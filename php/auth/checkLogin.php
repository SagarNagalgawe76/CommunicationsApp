<?php
require_once ('../common/dbConnect.php');
session_start();
print_r($_POST);
$userName = $_POST["username"];
$password = $_POST["password"];

$query = "SELECT name,email,password FROM users WHERE (name=? OR email=?) AND password=?";

// Prepare and execute the statement
echo $query;

$stmt = $db->prepare($query);
$stmt->bind_param('sss', $userName, $userName, $password);
echo "<pre>";
echo $query;

$stmt->execute();
print_r($stmt);
$stmt->bind_result($user_name, $email, $pass);

// Fetch each row and display data
while ($stmt->fetch()) {
    // Output row data
    echo "User Name: " . $user_name . ", Email: " . $email . "<br>";
}

if (!$stmt) {
    die("Error: " . $db->error);
}
if (($userName == $user_name || $userName = $email) && $password == $pass) {
    $_SESSION['user_name'] = $user_name;
    $_SESSION['userPass'] = $password;
    header('Location:../chat/groupChat.php');
} else {
    header('Location:loginPage.php?loginFailed=false');
}