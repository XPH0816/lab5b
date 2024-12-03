<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once 'utils.php';
    verify_inputs($_POST);
    require_once 'User.php';
    $user = new User();
    $user = $user->login($_POST['matric'], $_POST['password']);
    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: users.php');
        exit;
    } else {
        die('Invalid username or password, try <a href="'. $_SERVER['PHP_SELF'] .'">login</a> again');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
            <label for="password">Password :</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>

</html>