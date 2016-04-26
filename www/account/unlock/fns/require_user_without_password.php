<?php

function require_user_without_password () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../');

    include_once "$fnsDir/Session/EncryptionKey/get.php";
    $key = Session\EncryptionKey\get();

    if ($key !== null) {

        include_once "$fnsDir/request_strings.php";
        list($return) = request_strings('return');

        include_once "$fnsDir/format_return.php";
        list($return) = format_return($return);

        if ($return === null) $return = '../';

        include_once "$fnsDir/redirect.php";
        redirect($return);
    }

    return $user;

}
