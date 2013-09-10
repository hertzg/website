#!/usr/bin/php
<?php

include_once 'lib/require-cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$users = mysqli_query_object(
    $mysqli,
    "select users.idusers, sum(filesize) storageused from users"
    ." left join files on users.idusers = files.idusers"
    ." group by users.idusers"
);

foreach ($users as $user) {
    mysqli_query(
        $mysqli,
        "update users set storageused = $user->storageused"
        ." where idusers = $user->idusers"
    );
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
