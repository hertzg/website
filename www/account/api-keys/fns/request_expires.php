<?php

function request_expires (&$expires, &$expire_time) {

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($expires) = request_strings('expires');

    if ($expires !== 'never') {

        include_once __DIR__.'/../../../fns/time_today.php';
        $time_today = time_today();

        $expires = (string)abs((int)$expires);
        $expire_time = $time_today + 60 * 60 * 24 * $expires;

    }

}
