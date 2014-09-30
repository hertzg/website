<?php

function user_time_today ($user) {
    include_once __DIR__.'/daytime.php';
    return daytime(time() + $user->timezone * 60);
}
