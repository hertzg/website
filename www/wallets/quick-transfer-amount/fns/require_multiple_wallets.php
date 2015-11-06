<?php

function require_multiple_wallets () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    if ($user->num_wallets < 2) {
        unset($_SESSION['wallets/messages']);
        $_SESSION['wallets/errors'] = [
            'You need at least two wallets to transfer amount between.',
        ];
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return $user;

}
