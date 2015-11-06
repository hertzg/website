<?php

function request_new_event_values ($key, $user) {

    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/Events/request.php";
    list($event_time, $start_hour, $start_minute,
        $text, $raw_event_time) = Events\request();

    if ($raw_event_time === '') {
        include_once "$fnsDir/user_time_today.php";
        $event_time = user_time_today($user);
    }

    return [
        'focus' => 'text',
        'event_day' => (int)date('j', $event_time),
        'event_month' => (int)date('n', $event_time),
        'event_year' => (int)date('Y', $event_time),
        'start_hour' => $start_hour,
        'start_minute' => $start_minute,
        'text' => $text,
    ];

}
