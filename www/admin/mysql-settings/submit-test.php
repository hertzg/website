<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_admin.php';
require_admin();

include_once "$fnsDir/MysqlConfig/get.php";
MysqlConfig\get($host, $username, $password, $db);

$mysqli = @new mysqli($host, $username, $password, $db);

if ($mysqli->connect_errno) {
    unset($_SESSION['admin/mysql-settings/messages']);
    $_SESSION['admin/mysql-settings/errors'] = [
        "The setting doesn't work.",
        htmlspecialchars($mysqli->connect_error),
    ];
} else {
    unset($_SESSION['admin/mysql-settings/errors']);
    $_SESSION['admin/mysql-settings/messages'] = ['The settings work.'];
}

include_once "$fnsDir/redirect.php";
redirect();
