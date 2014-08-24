<?php

function parse_expire_time (&$expires, &$expire_time) {
    if ($expires !== 'never') {

        include_once __DIR__.'/../../../fns/time_today.php';
        $time_today = time_today();

        $expires = (string)abs((int)$expires);
        $expire_time = $time_today + 60 * 60 * 24 * $expires;

    }
}
