<?php

function require_bar ($mysqli, $base = '') {

    include_once __DIR__.'/request_bar.php';
    list($bar, $id, $user) = request_bar($mysqli, $base);

    if (!$bar) {
        $_SESSION['bar-charts/errors'] = ['The bar no longer exists.'];
        unset($_SESSION['bar-charts/messages']);
        include_once __DIR__.'/../../fns/redirect.php';
        redirect("$base..");
    }

    return [$bar, $id, $user];

}
