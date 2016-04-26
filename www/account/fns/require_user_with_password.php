<?php

function require_user_with_password ($base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../");

    include_once "$fnsDir/Session/EncryptionKey/get.php";
    $key = Session\EncryptionKey\get();

    if ($key === null) {
        $return = rawurlencode($_SERVER['REQUEST_URI']);
        include_once "$fnsDir/redirect.php";
        unset(
            $_SESSION['account/unlock/errors'],
            $_SESSION['account/unlock/values']
        );
        redirect("{$base}unlock/?return=$return");
    }

    return $user;

}
