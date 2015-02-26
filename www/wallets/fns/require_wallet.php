<?php

function require_wallet ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Wallets/get.php";
    $wallet = Users\Wallets\get($mysqli, $user, $id);

    if (!$wallet) {
        $_SESSION['wallets/errors'] = ['The wallet no longer exists.'];
        unset($_SESSION['wallets/messages']);
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$wallet, $id, $user];

}
