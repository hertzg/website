<?php

function client_time_and_timezone ($user, &$time, &$timezone) {
    $time = floor(microtime(true) * 1000);
    if ($user) {
        $timezone = $user->timezone;
        $time += $timezone * 60 * 1000;
    } else {
        $timezone = 0;
    }
}
