<?php

function require_one_wallet () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    if (!$user->num_wallets) {
        unset($_SESSION['wallets/messages']);
        $_SESSION['wallets/errors'] = [
            'You need to create a wallet to add a transaction in.',
        ];
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return $user;

}
