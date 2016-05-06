<?php

function to_client_json ($invitation) {
    return [
        'id' => (int)$invitation->id,
        'key' => $invitation->key,
        'note' => $invitation->note,
        'insert_time' => (int)$invitation->insert_time,
        'update_time' => (int)$invitation->update_time,
    ];
}
