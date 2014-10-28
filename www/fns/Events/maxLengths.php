<?php

namespace Events;

function maxLengths () {

    include_once __DIR__.'/../ApiKeyName/maxLength.php';
    $apiKeyNameMaxLength = \ApiKeyName\maxLength();

    return [
        'insert_api_key_name' => $apiKeyNameMaxLength,
        'text' => 1024,
        'update_api_key_name' => $apiKeyNameMaxLength,
    ];

}
