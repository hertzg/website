<?php

function check_mysql_config ($host,
    $username, $password, $db, $create, &$mysqli) {

    if ($host === '') return 'Enter host.';
    if ($db === '') return 'Enter database.';
    if ($username === '') return 'Enter username.';

    $mysqli = @new mysqli($host, $username, $password);
    if ($mysqli->connect_errno) {
        return htmlspecialchars($mysqli->connect_error);
    }

    $mysqli->set_charset('utf8');

    if ($create) {
        $escapedDb = $mysqli->real_escape_string($db);
        $sql = 'select count(*) total from information_schema.schemata'
            ." where schema_name like '$escapedDb'";
        include_once '../../fns/mysqli_single_object.php';
        $row = mysqli_single_object($mysqli, $sql);
        if (!$row->total) {
            $ok = $mysqli->query("create database `$escapedDb`");
            if (!$ok) return htmlspecialchars($mysqli->error);
        }
    } else {
        $ok = $mysqli->select_db($db);
        if (!$ok) return htmlspecialchars($mysqli->error);
    }

}
