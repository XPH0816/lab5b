<?php
require_once 'auth.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require_once 'User.php';
    $user = new User();
    if ($user->delete($_POST['id'])) {
        echo json_encode(['status' => 'success', 'message' => $_POST['id'] . ' deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete ' . $_POST['id']]);
    };
    exit;
}
?>

<script>
    if (confirm('Are you sure you want to delete this user?')) {
        let form = new FormData();
        form.append('id', "<?= $_GET['id'] ?>");
        fetch('delete.php', {
            method: 'POST',
            body: form
        }).then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                } else {
                    alert(data.message);
                }
                window.location.href = 'users.php';
            });
    } else {
        window.location.href = 'users.php';
    }
</script>