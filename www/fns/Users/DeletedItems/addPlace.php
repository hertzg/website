<?php

namespace Users\DeletedItems;

function addPlace ($mysqli, $place, $apiKey) {
    include_once __DIR__.'/add.php';
    add($mysqli, $place->id_users, 'place', [
        'id' => $place->id,
        'latitude' => $place->latitude,
        'longitude' => $place->longitude,
        'altitude' => $place->altitude,
        'name' => $place->name,
        'tags' => $place->tags,
        'insert_api_key_id' => $place->insert_api_key_id,
        'insert_time' => $place->insert_time,
        'update_api_key_id' => $place->update_api_key_id,
        'update_time' => $place->update_time,
        'revision' => $place->revision,
    ], $apiKey);
}
