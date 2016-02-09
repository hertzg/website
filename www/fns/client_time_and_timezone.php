<?php

function client_time_and_timezone ($user, &$time, &$timezone) {
    $time = floor(microtime(true) * 1000);
    $timezone = $user ? $user->timezone : 0;
}
