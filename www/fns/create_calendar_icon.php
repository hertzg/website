<?php

function create_calendar_icon ($user) {
    include_once __DIR__.'/user_time_today.php';
    return
        '<div class="icon calendar">'
            .'<span class="calendarIcon-day">'
                .date('j', user_time_today($user))
            .'</span>'
        .'</div>';
}
