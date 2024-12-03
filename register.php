<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once 'utils.php';
    verify_inputs($_POST);
    require_once 'User.php';
    $user = new User();
    $data = [
        'matric' => $_POST['matric'],
        'name' => $_POST['name'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'role' => $_POST['role']
    ];
    $user->insert($data);
}
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
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" style="display:flex; flex-direction:column; gap: 0.3em;">
        <div>
            <label for="matric">Matric :</label>
            <input type="text" name="matric" id="matric">
        </div>
        <div>
            <label for="name">Name :</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="password">Password :</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="role">Role :</label>
            <select name="role" id="role">
                <option value="">Please select</option>
                <option value="student">Student</option>
                <option value="lecturer">Lecturer</option>
            </select>
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>