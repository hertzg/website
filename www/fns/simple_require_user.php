<?php

function simple_require_user ($base = '') {
    include_once __DIR__.'/signed_user.php';
    $user = signed_user();
    if (!$user) {
        include_once __DIR__.'/redirect.php';
        redirect("{$base}sign-in/");
    }
    return $user;
}