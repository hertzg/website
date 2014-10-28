<?php

namespace ApiKeys;

function maxLengths () {
    include_once __DIR__.'/../ApiKeyName/maxLength.php';
    return [
        'key' => 32,
        'name' => \ApiKeyName\maxLength(),
    ];
}
