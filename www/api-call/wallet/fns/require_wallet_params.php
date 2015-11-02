<?php

function require_wallet_params (&$name) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Wallets/request.php";
    $name = Wallets\request();

    if ($name === '') {
        include_once "$fnsDir/ErrorJson/badRequest.php";
        ErrorJson\badRequest('"ENTER_NAME"');
    }

}
