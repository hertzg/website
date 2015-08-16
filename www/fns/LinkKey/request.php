<?php

namespace LinkKey;

function request () {

    include_once __DIR__.'/../request_strings.php';
    list($key) = request_strings('key');

    $key = @hex2bin($key);
    if ($key === false) return '';

    return $key;

}
