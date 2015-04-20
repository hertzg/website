<?php

namespace Users\DeletedItems;

function purgeWallet ($mysqli, $deletedItem) {

    $data = json_decode($deletedItem->data_json);

    include_once __DIR__.'/../../WalletTransactions/deleteOnWallet.php';
    \WalletTransactions\deleteOnWallet($mysqli, $data->id);

}
