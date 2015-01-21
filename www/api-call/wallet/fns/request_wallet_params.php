<?php

function request_wallet_params () {

    include_once __DIR__.'/../../../fns/Wallets/request.php';
    $name = Wallets\request();

    if ($name === '') {
        include_once __DIR__.'/../../fns/bad_request.php';
        bad_request('ENTER_NAME');
    }

    return $name;

}
