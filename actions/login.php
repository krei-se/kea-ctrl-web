<?php

csrf_check();

$user = $_POST['user'] ?? '';
$pass = $_POST['pass'] ?? '';

// Store temporarily in cookies to test auth against Kea
setcookie('kea_user', $user, time() + 3600, '/');
$_COOKIE['kea_user'] = $user;
$_SESSION['kea_pass'] = $pass;

// Test credentials with list-commands
$res = send_kea_command('list-commands', ['dhcp4']);
if ($res['result'] !== 0) {

    // Bad login -> clear cookies
    setcookie('kea_user', '', time() - 3600, '/');
    unset($_COOKIE['kea_user'], $_SESSION['kea_pass']);
    $login_error = "Authentication failed: " . ($res['text'] ?? 'Unknown error');
} else {
    session_regenerate_id(true); // Session-Fixation-Protection
    header('Location: index.php');
    exit;
}
