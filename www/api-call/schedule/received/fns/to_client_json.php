<?php

function to_client_json ($receivedSchedule) {
    return [
        'id' => (int)$receivedSchedule->id,
        'sender_username' => $receivedSchedule->sender_username,
        'text' => $receivedSchedule->text,
        'interval' => (int)$receivedSchedule->interval,
        'offset' => (int)$receivedSchedule->offset,
        'tags' => $receivedSchedule->tags,
        'insert_time' => (int)$receivedSchedule->insert_time,
    ];
}
