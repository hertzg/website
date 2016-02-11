<?php

function require_wallet_params (&$name) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Wallets/request.php";
    $name = Wallets\request();

    if ($name === '') {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"ENTER_NAME"');
    }

}
