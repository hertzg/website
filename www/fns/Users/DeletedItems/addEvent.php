<?php

namespace Users\DeletedItems;

function addEvent ($mysqli, $event, $apiKey) {
    include_once __DIR__.'/add.php';
    add($mysqli, $event->id_users, 'event', [
        'id' => $event->id,
        'event_time' => $event->event_time,
        'text' => $event->text,
        'insert_api_key_id' => $event->insert_api_key_id,
        'insert_time' => $event->insert_time,
        'update_api_key_id' => $event->update_api_key_id,
        'update_time' => $event->update_time,
        'revision' => $event->revision,
    ], $apiKey);
}
