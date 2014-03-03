<?php

function require_guest_user ($base = '') {
    global $user;
    if ($user) {
        include_once __DIR__.'/redirect.php';
        redirect("{$base}home/");
    }
}

include_once __DIR__.'/../lib/user.php';
