<?php


setcookie('kea_user', '', time() - 3600, '/');
setcookie('kea_pass', '', time() - 3600, '/');
header('Location: index.php');
exit;
