<?php
require_once 'auth.php';
require_once 'User.php';

$users = User::selectAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Level</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['matric'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td>
                        <a href="update.php?id=<?= $user['matric'] ?>">Update</a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?= $user['matric'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>