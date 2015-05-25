<?php

function check_mysql_config ($host, $username,
    $password, $db, $create, &$mysqli, &$focus) {

    if ($host === '') {
        $focus = 'host';
        return 'Enter host.';
    }

    if ($db === '') {
        $focus = 'db';
        return 'Enter database.';
    }

    if ($username === '') {
        $focus = 'username';
        return 'Enter username.';
    }

    $mysqli = @new mysqli($host, $username, $password);
    if ($mysqli->connect_errno) {
        $focus = 'host';
        return htmlspecialchars($mysqli->connect_error);
    }

    $mysqli->set_charset('utf8');

    if ($create) {
        $escapedDb = $mysqli->real_escape_string($db);
        $sql = 'select count(*) total from information_schema.schemata'
            ." where schema_name like '$escapedDb'";
        include_once __DIR__.'/../../fns/mysqli_single_object.php';
        $row = mysqli_single_object($mysqli, $sql);
        if (!$row->total) {
            $ok = $mysqli->query("create database `$escapedDb`");
            if (!$ok) {
                $focus = 'host';
                return htmlspecialchars($mysqli->error);
            }
        }
    }

    $ok = $mysqli->select_db($db);
    if (!$ok) {
        $focus = 'host';
        return htmlspecialchars($mysqli->error);
    }

}
