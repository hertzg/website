<?php

function to_client_json ($point) {
    $altitude = $point->altitude;
    return [
        'id' => (int)$point->id,
        'latitude' => (float)$point->latitude,
        'longitude' => (float)$point->longitude,
        'altitude' => $altitude === null ? null : (float)$altitude,
        'insert_time' => (int)$point->insert_time,
    ];
}
