<?php


setcookie('kea_user', '', time() - 3600, '/');
unset($_COOKIE['kea_user'], $_SESSION['kea_pass']);
session_destroy();

header('Location: index.php');
exit;
