<?php

function request_expires (&$expires, &$expire_time) {

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($expires) = request_strings('expires');

    include_once __DIR__.'/../../../fns/time_today.php';
    $time_today = time_today();

    $day = 60 * 60 * 24;
    if ($expires === '7') $expire_time = $time_today + $day * 7;
    elseif ($expires === '30') $expire_time = $time_today + $day * 30;
    elseif ($expires === '360') $expire_time = $time_today + $day * 360;
    else $expires = '';

}
