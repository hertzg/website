<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_general_info.php';
require_general_info();

include_once "$fnsDir/request_strings.php";
list($host, $username, $password, $db, $create) = request_strings(
    'host', 'username', 'password', 'db', 'create');

include_once "$fnsDir/str_collapse_spaces.php";
$host = str_collapse_spaces($host);
$db = str_collapse_spaces($db);
$username = str_collapse_spaces($username);

$create = (bool)$create;

include_once '../fns/check_mysql_config.php';
$error = check_mysql_config($host, $username,
    $password, $db, $create, $mysqli, $focus);

$_SESSION['install/mysql-config/values'] = [
    'host' => $host,
    'username' => $username,
    'password' => $password,
    'db' => $db,
    'create' => $create,
    'check' => true,
];

include_once "$fnsDir/redirect.php";

if ($error) redirect();

redirect('../admin/');
