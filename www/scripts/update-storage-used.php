#!/usr/bin/php
<?php

include_once 'lib/require-cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'select users.idusers, sum(filesize) storage_used from users'
    .' left join files on users.idusers = files.idusers'
    .' group by users.idusers';
$users = mysqli_query_object($mysqli, $sql);

foreach ($users as $user) {
    $sql = "update users set storage_used = $user->storage_used"
        ." where idusers = $user->idusers";
    $mysqli->query($sql);
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
