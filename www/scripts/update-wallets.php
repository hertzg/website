#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$wallets = mysqli_query_object($mysqli, 'select * from wallets');
foreach ($wallets as $wallet) {

    $id = $wallet->id;

    $sql = 'select sum(amount) balance'
        ." from wallet_transactions where id_wallets = $id";
    $balance = mysqli_single_object($mysqli, $sql)->balance;

    if ($balance === null) $balance = 0;

    $sql = "update wallets set balance = $balance where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
