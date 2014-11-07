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

if ($host === '') $error = 'Enter host.';
elseif ($db === '') $error = 'Enter database.';
elseif ($username === '') $error = 'Enter username.';
else {
    $mysqli = @new mysqli($host, $username, $password);
    if ($mysqli->connect_errno) {
        $error = htmlspecialchars($mysqli->connect_error);
    } else {

        $mysqli->set_charset('utf8');

        if ($create) {
            $escapedDb = $mysqli->real_escape_string($db);
            $sql = 'select count(*) total from information_schema.schemata'
                ." where schema_name like '$escapedDb'";
            include_once '../../fns/mysqli_single_object.php';
            $row = mysqli_single_object($mysqli, $sql);
            if (!$row->total) {
                $ok = $mysqli->query("create database `$escapedDb`");
                if (!$ok) $error = htmlspecialchars($mysqli->error);
            }
        } else {
            $ok = $mysqli->select_db($db);
            if (!$ok) $error = htmlspecialchars($mysqli->error);
        }

    }
}

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
