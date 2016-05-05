<?php

function require_user ($base = '') {

    include_once __DIR__.'/signed_user.php';
    $user = signed_user();

    if (!$user) {

        unset(
            $_SESSION['sign-in/errors'],
            $_SESSION['sign-in/messages']
        );

        $return = rawurlencode($_SERVER['REQUEST_URI']);
        include_once __DIR__.'/redirect.php';
        redirect("{$base}sign-in/?return=$return");

    }

    if ($user->disabled) {
        include_once __DIR__.'/redirect.php';
        redirect("{$base}account-disabled/");
    }

    if ($user->should_change_password) {
        $return = rawurlencode($_SERVER['REQUEST_URI']);
        include_once __DIR__.'/redirect.php';
        redirect("{$base}sign-in/set-new-password/?return=$return");
    }

    return $user;

}
