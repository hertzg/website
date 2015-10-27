<?php

function to_client_json ($event) {

    $start_hour = $event->start_hour;
    if ($start_hour !== null) $start_hour = (int)$start_hour;

    $start_minute = $event->start_minute;
    if ($start_minute !== null) $start_minute = (int)$start_minute;

    return [
        'id' => (int)$event->id,
        'text' => $event->text,
        'event_time' => (int)$event->event_time,
        'start_hour' => $start_hour,
        'start_minute' => $start_minute,
        'insert_time' => (int)$event->insert_time,
        'update_time' => (int)$event->update_time,
    ];
}
