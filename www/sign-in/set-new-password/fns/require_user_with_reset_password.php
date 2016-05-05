<?php

function require_user_with_reset_password () {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/signed_user.php";
    $user = signed_user('../');

    if (!$user) {

        unset(
            $_SESSION['sign-in/errors'],
            $_SESSION['sign-in/messages']
        );

        include_once "$fnsDir/redirect.php";
        redirect('../sign-in/');

    }

    if (!$user->should_change_password) {

        include_once "$fnsDir/request_strings.php";
        list($return) = request_strings('return');

        include_once __DIR__.'/redirect_back.php';
        redirect_back($return);

    }

    return $user;

}
