<?php

function request_edit_event_values ($event, $key) {

    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    $event_time = $event->event_time;

    $start_hour = $event->start_hour;
    if ($start_hour !== null) $start_hour = (int)$start_hour;

    $start_minute = $event->start_minute;
    if ($start_minute !== null) $start_minute = (int)$start_minute;

    return [
        'event_day' => date('j', $event_time),
        'event_month' => date('n', $event_time),
        'event_year' => date('Y', $event_time),
        'start_hour' => $start_hour,
        'start_minute' => $start_minute,
        'text' => $event->text,
    ];

}
