<?php

function client_time_and_timezone ($user, &$time, &$timezone) {
    $time = (int)floor(microtime(true) * 1000);
    $timezone = $user ? (int)$user->timezone : 0;
}
