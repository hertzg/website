<?php

function request_edit_event_values ($event, $key) {

    if (array_key_exists($key, $_SESSION)) return $_SESSION[$key];

    $event_time = $event->event_time;

    return [
        'event_day' => date('j', $event_time),
        'event_month' => date('n', $event_time),
        'event_year' => date('Y', $event_time),
        'text' => $event->text,
    ];

}
