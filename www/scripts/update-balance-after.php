#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$wallets = mysqli_query_object($mysqli, 'select * from wallets');
foreach ($wallets as $wallet) {

    $sql = "select * from wallet_transactions where id_wallets = $wallet->id";
    $transactions = mysqli_query_object($mysqli, $sql);

    $balance = 0;

    foreach ($transactions as $transaction) {
        $balance += $transaction->amount;
        $sql = 'update wallet_transactions set'
            ." balance_after = $balance where id = $transaction->id";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }

}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
