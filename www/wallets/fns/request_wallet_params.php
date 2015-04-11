<?php

function request_wallet_params (&$errors) {

    include_once __DIR__.'/../../fns/Wallets/request.php';
    $name = Wallets\request();

    if ($name === '') $errors[] = 'Enter name.';

    return $name;

}
