#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

include_once '../fns/Users/index.php';
$users = Users\index($mysqli);

foreach ($users as $user) {

    $id_users = $user->id_users;

    $sql = 'select sum(balance) balance_total'
        ." from wallets where id_users = $id_users";
    $balance_total = mysqli_single_object($mysqli, $sql)->balance_total;
    if ($balance_total === null) $balance_total = 0;

    $sql = "update users set balance_total = $balance_total"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
