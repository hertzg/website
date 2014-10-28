<?php

namespace Files;

function maxLengths () {

    include_once __DIR__.'/../ApiKeyName/maxLength.php';
    $apiKeyNameMaxLength = \ApiKeyName\maxLength();

    return [
        'content_type' => 32,
        'insert_api_key_name' => $apiKeyNameMaxLength,
        'name' => 256,
        'rename_api_key_name' => $apiKeyNameMaxLength,
    ];

}
