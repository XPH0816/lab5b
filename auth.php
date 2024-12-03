<?php
session_start();
if (!isset($_SESSION['user'])) {
    setcookie('message', 'You need to login first', time() + 5);
    header('Location: login.php');
    exit;
}