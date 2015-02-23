<?php

namespace PlacePoints;

function maxLengths () {
    include_once __DIR__.'/../ApiKeyName/maxLength.php';
    return ['insert_api_key_name' => \ApiKeyName\maxLength()];
}
