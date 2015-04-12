<?php

function session_start_custom (&$new) {
    $lifetime = session_get_cookie_params()['lifetime'];
    include_once __DIR__.'/SiteBase/get.php';
    session_set_cookie_params($lifetime, SiteBase\get());
    session_name('zsid');
    session_start();
    $new = !array_key_exists('restored', $_SESSION);
    $_SESSION['restored'] = true;
}
