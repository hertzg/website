<?php

namespace ApiCall;

function requireGuestUser () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/signed_user.php";
    $user = signed_user();

    if ($user) {
        include_once "$fnsDir/ErrorJson/forbidden.php";
        \ErrorJson\forbidden('"CROSS_DOMAIN_REQUEST"');
    }

}
