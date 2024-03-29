<?php

function to_client_json ($place) {
    $altitude = $place->altitude;
    return [
        'id' => (int)$place->id,
        'latitude' => (float)$place->latitude,
        'longitude' => (float)$place->longitude,
        'altitude' => $altitude === null ? null : (float)$altitude,
        'name' => $place->name,
        'description' => $place->description,
        'tags' => $place->tags,
        'insert_time' => (int)$place->insert_time,
        'update_time' => (int)$place->update_time,
    ];
}
