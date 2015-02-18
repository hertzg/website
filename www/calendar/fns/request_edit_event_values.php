<?php

function request_edit_event_values ($event, $key) {
    if (array_key_exists($key, $_SESSION)) {
        $values = $_SESSION[$key];
    } else {
        $event_time = $event->event_time;
        $values = [
            'event_day' => date('j', $event_time),
            'event_month' => date('n', $event_time),
            'event_year' => date('Y', $event_time),
            'text' => $event->text,
        ];
    }
    return $values;
}
