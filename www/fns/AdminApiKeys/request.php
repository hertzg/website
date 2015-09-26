<?php

namespace AdminApiKeys;

function request () {

    include_once __DIR__.'/../ApiKeyName/request.php';
    $name = \ApiKeyName\request();

    return [$name];

}
