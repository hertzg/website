<?php

namespace Users\DeletedItems;

function addCalculation ($mysqli, $calculation, $apiKey) {
    include_once __DIR__.'/add.php';
    add($mysqli, $calculation->id_users, 'calculation', [
        'id' => $calculation->id,
        'url' => $calculation->url,
        'title' => $calculation->title,
        'tags' => $calculation->tags,
        'insert_api_key_id' => $calculation->insert_api_key_id,
        'insert_time' => $calculation->insert_time,
        'update_api_key_id' => $calculation->update_api_key_id,
        'update_time' => $calculation->update_time,
        'revision' => $calculation->revision,
    ], $apiKey);
}
