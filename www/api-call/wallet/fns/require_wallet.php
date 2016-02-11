<?php

function require_wallet ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Wallets/get.php";
    $wallet = Users\Wallets\get($mysqli, $user, $id);

    if (!$wallet) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"WALLET_NOT_FOUND"');
    }

    return $wallet;

}
