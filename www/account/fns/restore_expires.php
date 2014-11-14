<?php

function restore_expires ($user, $expire_time) {

    include_once __DIR__.'/../../fns/user_time_today.php';
    $time_today = user_time_today($user);

    if ($expire_time === null || $expire_time < $time_today) return 'never';
    return (string)floor(($expire_time - $time_today) / (60 * 60 * 24));

}
