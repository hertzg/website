<?php

namespace ApiCall;

function requireUser () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/is_same_domain_referer.php";
    if (!is_same_domain_referer()) {
        include_once __DIR__.'/Error/forbidden.php';
        Error\forbidden('"CROSS_DOMAIN_REQUEST"');
    }

    include_once "$fnsDir/signed_user.php";
    $user = signed_user();

    if (!$user) {
        include_once __DIR__.'/Error/forbidden.php';
        Error\forbidden('"NOT_SIGNED_IN"');
    }

    if ($user->disabled) {
        include_once __DIR__.'/Error/forbidden.php';
        Error\forbidden('"USER_DISABLED"');
    }

    if ($user->should_change_password) {
        include_once __DIR__.'/Error/forbidden.php';
        Error\forbidden('"USER_PASSWORD_RESET"');
    }

    return $user;

}
