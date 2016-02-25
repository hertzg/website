#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../fns/Wallets/editAmounts.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$wallets = mysqli_query_object($mysqli, 'select * from wallets');
foreach ($wallets as $wallet) {

    $id = $wallet->id;

    $sql = 'select sum(amount) balance'
        ." from wallet_transactions where id_wallets = $id";
    $balance = mysqli_single_object($mysqli, $sql)->balance;
    if ($balance === null) $balance = 0;

    $sql = 'select sum(amount) income from wallet_transactions'
        ." where id_wallets = $id and amount > 0";
    $income = mysqli_single_object($mysqli, $sql)->income;
    if ($income === null) $income = 0;

    $sql = 'select sum(amount) expense from wallet_transactions'
        ." where id_wallets = $id and amount < 0";
    $expense = mysqli_single_object($mysqli, $sql)->expense;
    if ($expense === null) $expense = 0;
    $expense = -$expense;

    \Wallets\editAmounts($mysqli, $id, $income, $expense, $balance);

}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
