<?php
require_once ("../common/headerLayout.php");
require_once ("../common/dbConnect.php");
if (!isset($_SESSION['user_name'])) {
    header('Location: ../auth/logout.php');
    exit;
}
$query = "SELECT * FROM users";
$stmt = $db->prepare($query);
$stmt->execute();
$stmt->bind_result($id, $name, $email, $password);

if (!$stmt) {
    die("Error: " . $db->error);
}

$userData = array();
while ($stmt->fetch()) {
    $userData[] = array(
        'id' => $id,
        'name' => $name,
        'email' => $email,
        'password' => $password
    );
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserList</title>
</head>
<style>
    .btn-group {
        display: flex;
    }

    .btn-group .btn {
        margin-right: 5px;
    }
</style>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center">User Management</h2>
                <table class="table center-table">
                    <thead>
                        <tr>
                            <th scope="col">Sr No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        <?php foreach ($userData as $user): ?>
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td><?php echo htmlspecialchars($user['name']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="editUser.php?id=<?php echo $user['id']; ?>&user=<?php echo $user['name']; ?>&email=<?php echo $user['email']; ?>"
                                            class="btn btn-primary">Edit</a>
                                        <a href="deleteUser.php?id=<?php echo $user['id']; ?>"
                                            class="btn btn-danger">Delete</a>
                                    </div>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>