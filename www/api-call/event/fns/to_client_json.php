<?php

function to_client_json ($event) {
    return [
        'id' => (int)$event->id,
        'text' => $event->text,
        'event_time' => (int)$event->event_time,
        'insert_time' => (int)$event->insert_time,
        'update_time' => (int)$event->update_time,
    ];
}
