<?php

namespace WalletTransactions;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($amount, $description) = request_strings('amount', 'description');

    $amount = preg_replace('/\s+/', '', $amount);
    $parsed_amount = (int)round($amount * 100);

    include_once "$fnsDir/str_collapse_spaces.php";
    $description = str_collapse_spaces($description);

    return [$amount, $parsed_amount, $description];

}
