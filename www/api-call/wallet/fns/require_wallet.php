<?php

function require_wallet ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Wallets/getOnUser.php";
    $wallet = Wallets\getOnUser($mysqli, $id_users, $id);

    if (!$wallet) {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('WALLET_NOT_FOUND');
    }

    return $wallet;

}
