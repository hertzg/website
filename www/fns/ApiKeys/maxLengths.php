<?php

namespace ApiKeys;

function maxLengths () {
    include_once __DIR__.'/../ApiKeyName/maxLength.php';
    return [
        'key' => 64,
        'name' => \ApiKeyName\maxLength(),
    ];
}
