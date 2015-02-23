<?php

namespace PlacePoints;

function maxLengths () {

    include_once __DIR__.'/../ApiKeyName/maxLength.php';
    $apiKeyNameMaxLength = \ApiKeyName\maxLength();

    return [
        'insert_api_key_name' => $apiKeyNameMaxLength,
        'update_api_key_name' => $apiKeyNameMaxLength,
    ];

}
