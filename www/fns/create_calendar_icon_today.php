<?php

function create_calendar_icon_today ($user) {
    include_once __DIR__.'/user_time_today.php';
    include_once __DIR__.'/create_calendar_icon.php';
    return create_calendar_icon(date('j', user_time_today($user)));
}
