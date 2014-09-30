<?php

function user_time_today ($user) {
    include_once __DIR__.'/time_today.php';
    return time_today(time() + $user->timezone * 60);
}
