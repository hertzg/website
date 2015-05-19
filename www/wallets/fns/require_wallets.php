<?php

function require_wallets () {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    if (!$user->num_wallets) {
        unset(
            $_SESSION['wallets/errors'],
            $_SESSION['wallets/messages']
        );
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return $user;

}
