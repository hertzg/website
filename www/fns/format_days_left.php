<?php

function format_days_left ($user, $days_left) {

    if ($days_left == 0) return 'Today';

    if ($days_left == 1) return 'Tomorrow';

    include_once __DIR__.'/user_time_today.php';
    $time = user_time_today($user) + $days_left * 60 * 60 * 24;

    return date('l, F j', $time)." ($days_left days left)";

}
