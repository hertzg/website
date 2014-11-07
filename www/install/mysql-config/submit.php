<?php

include_once '../fns/require_general_info.php';
require_general_info();

include_once '../../fns/request_strings.php';
list($host, $username, $password, $db, $create) = request_strings(
    'host', 'username', 'password', 'db', 'create');

include_once '../../fns/str_collapse_spaces.php';
$host = str_collapse_spaces($host);
$db = str_collapse_spaces($db);
$username = str_collapse_spaces($username);

$create = (bool)$create;
$error = null;

include_once '../fns/check_mysql_config.php';
$error = check_mysql_config($host, $username, $password, $db, $create, $mysqli);

$_SESSION['install/mysql-config/values'] = [
    'host' => $host,
    'username' => $username,
    'password' => $password,
    'db' => $db,
    'create' => $create,
];

include_once '../../fns/redirect.php';

if ($error) {
    $_SESSION['install/mysql-config/error'] = $error;
    redirect();
}

unset($_SESSION['install/mysql-config/error']);

redirect('../admin/');
