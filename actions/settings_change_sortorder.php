<?php

csrf_check();

$sortorder = $_POST['sortorder'] ?? 'ip-address';
setcookie('sortorder', $sortorder, time() + (86400 * 365), '/'); // 1 year cookie
$_COOKIE['sortorder'] = $sortorder;
