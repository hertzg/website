<?php

namespace WalletTransactions;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($amount, $description) = request_strings('amount', 'description');

    include_once "$fnsDir/str_collapse_spaces.php";
    $amount = preg_replace('/\s+/', '', $amount);
    $description = str_collapse_spaces($description);

    $parsed_amount = (int)round($amount * 100);

    return [$amount, $parsed_amount, $description];

}
