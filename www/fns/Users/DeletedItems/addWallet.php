<?php

namespace Users\DeletedItems;

function addWallet ($mysqli, $wallet, $apiKey) {
    include_once __DIR__.'/add.php';
    add($mysqli, $wallet->id_users, 'wallet', [
        'id' => $wallet->id,
        'name' => $wallet->name,
        'balance' => $wallet->balance,
        'num_transactions' => $wallet->num_transactions,
        'insert_api_key_id' => $wallet->insert_api_key_id,
        'insert_time' => $wallet->insert_time,
        'update_api_key_id' => $wallet->update_api_key_id,
        'update_time' => $wallet->update_time,
        'revision' => $wallet->revision,
    ], $apiKey);
}
