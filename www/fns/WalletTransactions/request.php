<?php

namespace WalletTransactions;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($amount, $description) = request_strings('amount', 'description');

    $amount = preg_replace('/\s+/', '', $amount);
    $parsed_amount = (int)round($amount * 100);

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once "$fnsDir/str_collapse_spaces.php";
    $description = str_collapse_spaces($description);
    $description = mb_substr($description, 0,
        $maxLengths['description'], 'UTF-8');

    return [$amount, $parsed_amount, $description];

}
