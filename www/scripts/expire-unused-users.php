#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$insert_time = time() - 7 * 24 * 60 * 60;

$sql = 'select * from users where num_signins = 0'
    ." and insert_time < $insert_time limit 10";
$users = mysqli_query_object($mysqli, $sql);

if ($users) {
    include_once '../fns/Users/Account/Close/close.php';
    foreach ($users as $user) {
        Users\Account\Close\close($mysqli, $user);
    }
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
