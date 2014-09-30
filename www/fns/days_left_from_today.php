<?php

function days_left_from_today ($user, $interval, $offset) {
    include_once __DIR__.'/user_day.php';
    include_once __DIR__.'/days_left.php';
    return days_left($interval, $offset, user_day($user));
}
