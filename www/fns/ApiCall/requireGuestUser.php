<?php

namespace ApiCall;

function requireGuestUser () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/is_same_domain_referer.php";
    if (!is_same_domain_referer()) {
        include_once "$fnsDir/ErrorJson/forbidden.php";
        \ErrorJson\forbidden('"CROSS_DOMAIN_REQUEST"');
    }

    include_once "$fnsDir/signed_user.php";
    $user = signed_user();

    if ($user) {
        include_once "$fnsDir/ErrorJson/forbidden.php";
        \ErrorJson\forbidden('"ALREADY_SIGNED_IN"');
    }

}
