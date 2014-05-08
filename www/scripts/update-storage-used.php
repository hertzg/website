#!/usr/bin/php
<?php

chdir(__DIR__);
include_once 'lib/require-cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'select users.id_users, sum(file_size) storage_used from users'
    .' left join files on users.id_users = files.id_users'
    .' group by users.id_users';
$users = mysqli_query_object($mysqli, $sql);

foreach ($users as $user) {
    $sql = "update users set storage_used = $user->storage_used"
        ." where id_users = $user->id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
