<?php

namespace WalletTransactions;

function maxLengths () {

    include_once __DIR__.'/../ApiKeyName/maxLength.php';
    $apiKeyNameMaxLength = \ApiKeyName\maxLength();

    return [
        'description' => 256,
        'insert_api_key_name' => $apiKeyNameMaxLength,
        'update_api_key_name' => $apiKeyNameMaxLength,
    ];
}
