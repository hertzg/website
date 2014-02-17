<?php

function require_user ($base = '') {
    global $user;
    if (!$user) {
        include_once __DIR__.'/redirect.php';
        redirect("{$base}sign-in/");
    }
    return $user;
}

include_once __DIR__.'/../lib/user.php';
