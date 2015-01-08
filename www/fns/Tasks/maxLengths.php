<?php

namespace Tasks;

function maxLengths () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ApiKeyName/maxLength.php";
    $apiKeyNameMaxLength = \ApiKeyName\maxLength();

    include_once "$fnsDir/Tags/maxLength.php";
    include_once "$fnsDir/TagsJson/maxLength.php";
    return [
        'insert_api_key_name' => $apiKeyNameMaxLength,
        'tags' => \Tags\maxLength(),
        'tags_json' => \TagsJson\maxLength(),
        'title' => 128,
        'text' => 128,
        'update_api_key_name' => $apiKeyNameMaxLength,
    ];

}
