#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

include_once '../fns/DeletedItems/expireDays.php';
$expire_time = time() - DeletedItems\expireDays() * 24 * 60 * 60;

$sql = "select * from deleted_items where insert_time < $expire_time";
$deletedItems = mysqli_query_object($mysqli, $sql);

if ($deletedItems) {
    include_once '../fns/Users/DeletedItems/purge.php';
    foreach ($deletedItems as $deletedItem) {
        Users\DeletedItems\purge($mysqli, $deletedItem);
    }
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
