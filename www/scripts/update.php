#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

include_once '../fns/Table/ensureAll.php';
echo Table\ensureAll($mysqli);

$users = mysqli_query_object($mysqli, 'select * from users');
foreach ($users as $user) {
    $lowercase_username = $mysqli->real_escape_string($user->username);
    $sql = "update users set lowercase_username = '$lowercase_username'"
        ." where id_users = $user->id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

echo "Done\n";
