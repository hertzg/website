<?php

include_once '../../fns/session_start_custom.php';
session_start_custom();

include_once '../../fns/request_strings.php';
list($host, $username, $password, $db, $create) = request_strings(
    'host', 'username', 'password', 'db', 'create');

$create = (bool)$create;
$error = null;

$mysqli = @new mysqli($host, $username, $password);
if ($mysqli->connect_errno) {
    $error = $mysqli->connect_error;
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
            if (!$ok) $error = $mysqli->error;
        }
    } else {
        $ok = $mysqli->select_db($db);
        if (!$ok) $error = $mysqli->error;
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

$_SESSION['install/finalize/values'] = [
    'host' => $host,
    'username' => $username,
    'password' => $password,
    'db' => $db,
];

unset($_SESSION['install/mysql-config/error']);

redirect('../finalize/');
