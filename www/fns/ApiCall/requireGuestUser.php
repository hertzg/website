<?php

namespace ApiCall;

function requireGuestUser () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/is_same_domain_referer.php";
    if (!is_same_domain_referer()) {
        include_once __DIR__.'/Error/forbidden.php';
        Error\forbidden('"CROSS_DOMAIN_REQUEST"');
    }

    include_once "$fnsDir/signed_user.php";
    $user = signed_user();

    if ($user) {
        include_once __DIR__.'/Error/badRequest.php';
        Error\badRequest('"ALREADY_SIGNED_IN"');
    }

}
