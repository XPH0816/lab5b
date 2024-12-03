<?php
require_once 'auth.php';
require_once 'User.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once 'utils.php';
    verify_inputs($_POST);
    $data = [
        'matric' => $_POST['matric'],
        'name' => $_POST['name'],
        'role' => $_POST['role']
    ];
    if($user->update($data, $_GET['id']))
    {
        setcookie('message', 'User updated successfully', time() + 10, httponly: true);
        header('Location: '. $_SERVER['PHP_SELF'] . '?id=' . $_POST['matric']);
    }
}

$user = $user->select($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>

<body>
    <?php if (isset($_COOKIE['message'])): ?>
        <p><?= $_COOKIE['message'] ?></p>
    <?php endif; ?>
    <h1>Update User</h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>?id=<?=$_GET['id'] ?>" method="post" style="display:flex; flex-direction:column; gap: 0.3em;">
        <div>
            <label for="matric">Matric :</label>
            <input type="text" name="matric" id="matric" value="<?= $user['matric']; ?>">
        </div>
        <div>
            <label for="name">Name :</label>
            <input type="text" name="name" id="name" value="<?= $user['name']; ?>">
        </div>
        <div>
            <label for="role">Access Level :</label>
            <select name="role" id="role">
                <option value="">Please select</option>
                <option value="student" <?= $user['role'] == 'student' ? 'selected' : ''; ?>>Student</option>
                <option value="lecturer" <?= $user['role'] == 'lecturer' ? 'selected' : ''; ?>>Lecturer</option>
            </select>
        </div>
        <div>
            <button type="submit">Update</button>
            <a href="users.php">Cancel</a>
        </div>
    </form>
</body>

</html>