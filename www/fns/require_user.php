<?php

function require_user ($base = '') {
    include_once __DIR__.'/signed_user.php';
    $user = signed_user();
    if (!$user) {
        $return = rawurlencode($_SERVER['REQUEST_URI']);
        include_once __DIR__.'/redirect.php';
        redirect("{$base}sign-in/?return=$return");
    }
    return $user;
}
