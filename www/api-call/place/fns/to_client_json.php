<?php

function to_client_json ($place) {
    return [
        'id' => (int)$place->id,
        'latitude' => (float)$place->latitude,
        'longitude' => (float)$place->longitude,
        'name' => $place->name,
        'tags' => $place->tags,
        'insert_time' => (int)$place->insert_time,
        'update_time' => (int)$place->update_time,
    ];
}
