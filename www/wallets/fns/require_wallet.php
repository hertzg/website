<?php

function require_wallet ($mysqli) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Wallets/getOnUser.php";
    $wallet = Wallets\getOnUser($mysqli, $user->id_users, $id);

    if (!$wallet) {
        $_SESSION['wallets/errors'] = ['The wallet no longer exists.'];
        unset($_SESSION['wallets/messages']);
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$wallet, $id, $user];

}
